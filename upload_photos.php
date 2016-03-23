



<?php
//GG
//http://stackoverflow.com/questions/24895170/multiple-image-upload-php-form-with-one-input
//http://php.net/manual/en/function.oci-connect.php
    
    
    
$servername = "localhost";
$username = "chengyao";
$password = "chengyao00308900";
// Connects to the XE service (i.e. database) on the "localhost" machine
$conn = oci_connect($username,$password, $servername);
    
if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

$stid = oci_parse($conn, 'SELECT * FROM employees');
oci_execute($stid);

echo "<table border='1'>\n";
while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
    echo "<tr>\n";
    foreach ($row as $item) {
        echo "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
    }
    echo "</tr>\n";
}
echo "</table>\n";


    
    
extract($_POST);
    
for($i=0; $i<count($_FILES['image']['name']); $i++) {
    if(isset($_FILES["image"])) {
        @list(, , $imtype, ) = getimagesize($_FILES['image']['tmp_name'][$i]);
        // Get image type.
        // We use @ to omit errors
        if ($imtype == 3){ // cheking image type
            $ext="png";
        }
        elseif ($imtype == 2){
            $ext="jpeg";
        }
        elseif ($imtype == 1){
            $ext="gif";
        }
        else{
            $msg = 'Error: unknown file format';
            echo $msg;
            exit;
        }
        if(getimagesize($_FILES['image']['tmp_name'][$i]) == FALSE){
            echo "Please select an image.";
        }
        else{
            $image= addslashes($_FILES['image']['tmp_name'][$i]);
            $name= addslashes($_FILES['image']['name'][$i]);
            $image= file_get_contents($image);
            $image= base64_encode($image);
            $thumbnail = scaleImageFileToBlob($_FILES['image']['tmp_name']);
            $thumbnail = base64_encode($thumbnail);
            saveimage($name,$image, $thumbnail);
        }
    }
}
    
/*
    extract($_POST);
    $error=array();
    $extension=array("jpeg","jpg","png","gif");
    foreach($_FILES["files"]["tmp_name"] as $key=>$tmp_name)
    {
        $file_name=$_FILES["files"]["name"][$key];
        $file_tmp=$_FILES["files"]["tmp_name"][$key];
        $ext=pathinfo($file_name,PATHINFO_EXTENSION);
        if(in_array($ext,$extension))
        {
            if(!file_exists("photo_gallery/".$txtGalleryName."/".$file_name))
            {
                move_uploaded_file($file_tmp=$_FILES["files"]["tmp_name"][$key],"photo_gallery/".$txtGalleryName."/".$file_name);
            }
            else
            {
                $filename=basename($file_name,$ext);
                $newFileName=$filename.time().".".$ext;
                move_uploaded_file($file_tmp=$_FILES["files"]["tmp_name"][$key],"photo_gallery/".$txtGalleryName."/".$newFileName);
            }
        }
        else
        {
            array_push($error,"$file_name, ");
        }
    }

    */
    
    
    
    
function saveimage($name,$image, $thumbnail){
    
    $stmt = oci_parse($conn, "select * from image");
    oci_execute($stmt);
    oci_fetch($stmt);
    $id = oci_result($stmt, 'photo_id');
    
    
    
    
    
    //found is implemented with use of http://php.net/manual/en/function.oci-new-descriptor.php
    $lob   = oci_new_descriptor($conn, OCI_D_LOB);
    $lobimage  = oci_new_descriptor($conn, OCI_D_LOB);
    //used to save blob
    $stmt = oci_parse($conn, "insert into images (photo_id,owner_name,permitted,subject,place,when,description,thumbnail,photo) values (".$id.", ".$_POST['sid']/* owner_name */.",".$id./* permittion*/",".$id./*subject*/",".$id./* place */",to_date( TO_CHAR(SYSDATE, 'DD/MM/YYYY HH24:MI:SS') , 'DD/MM/YYYY HH24:MI:SS' ),'".$_POST['des']."',EMPTY_BLOB(), EMPTY_BLOB()) returning thumbnail, photo into :thumbnail, :photo");
      $id += 1;
      
      oci_bind_by_name($stmt, ':thumbnail', $lob, -1,  OCI_B_BLOB);
      oci_bind_by_name($stmt, ':photo', $lobimage, -1,  OCI_B_BLOB);
      @oci_execute($stmt, OCI_NO_AUTO_COMMIT);
      
      if ( @$lob->save($thumbnail) && @$lobimage->save($image)){
          oci_commit($conn);
          //update idtracker for image_id
          $stmt = oci_parse($conn, "update idtracker SET IMAGE_ID=".$id."WHERE colid=0");
          oci_execute($stmt);
          oci_commit($conn);
          echo "<center>Image successfully uploaded!</center><br/>";
      }else{
          echo "<table align='center'> <tr><td>Couldn't upload image. </td></tr> <tr><td>Please check you have correct sensor id.</td></tr> </table><br/>";
      }
      
      //continue 
      echo '<center><form method="post"><input type="submit" name="submit" value="continue" /> </form></center>';
    
      $lob->free();
      oci_free_statement($stmt);
      oci_close($conn);
    
 
}
?>
