



<?php
//GG
//http://stackoverflow.com/questions/24895170/multiple-image-upload-php-form-with-one-input
//http://php.net/manual/en/function.oci-connect.
include("connection_database.php");
include("scaleimage.php");
echo "<center>Hello World!</center><br/>";
$check = count($_FILES['image']['name']);
    
for($i=0; $i<count($_FILES['image']['name']); $i++) {
	echo "shiiit";
    if(isset($_FILES["image"])) {
        @list($w,$h , $imtype, ) = getimagesize($_FILES['image']['tmp_name'][$i]);
        // Get image type.
        // We use @ to omit errors
        echo"image type = $imtype   ";
        echo"number of files = $i   ";
        echo"width is = $w   and height is = $h      ";
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
        		echo "<center>I'm Here!</center><br/>";
            $image= addslashes($_FILES['image']['tmp_name'][$i]);
            $image= file_get_contents($image);
            $image= base64_encode($image);
            $thumbnail = scaleImageFileToBlob($_FILES['image']['tmp_name'][$i]);
            $thumbnail = base64_encode($thumbnail);
            saveimage($image, $thumbnail);
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
    
    
    
    
function saveimage($image, $thumbnail){
    $conn = connect();
    /*
    $stmt = oci_parse($conn, "select * from images");
    oci_execute($stmt);
    oci_fetch($stmt);*/
    $id = 3;
    
    
    
    //found is implemented with use of http://php.net/manual/en/function.oci-new-descriptor.php
    $lob   = oci_new_descriptor($conn, OCI_D_LOB);
    $lobimage  = oci_new_descriptor($conn, OCI_D_LOB);
    //used to save blob
    $stmt = oci_parse($conn, "insert into images (photo_id,timing,thumbnail,photo) values 
    (".$id.",to_date( TO_CHAR(SYSDATE, 'DD/MM/YYYY HH24:MI:SS') , 'DD/MM/YYYY HH24:MI:SS' ),EMPTY_BLOB(), EMPTY_BLOB()) returning thumbnail, photo into :thumbnail, :photo");
      $id += 1;
      
      oci_bind_by_name($stmt, ':thumbnail', $lob, -1,  OCI_B_BLOB);
      oci_bind_by_name($stmt, ':photo', $lobimage, -1,  OCI_B_BLOB);
      @oci_execute($stmt, OCI_NO_AUTO_COMMIT);
      echo "<center>added to database!</center><br/>";
      oci_commit($conn);
      if ( @$lob->save($thumbnail) && @$lobimage->save($image)){
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