



<?php
//GG
//http://stackoverflow.com/questions/24895170/multiple-image-upload-php-form-with-one-input
//http://php.net/manual/en/function.oci-connect.php
    
    
    
$username = "chengyao";
$password = "chengyao00308900";
// Connects to the XE service (i.e. database) on the "localhost" machine
$conn = oci_connect($username,$password);
    
if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

        
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
