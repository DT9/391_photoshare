



<?php
//GG
//http://stackoverflow.com/questions/24895170/multiple-image-upload-php-form-with-one-input
     print_r($_FILES);
//http://php.net/manual/en/function.oci-connect.
include("connection_database.php");
include("scaleimage.php");
echo "<center>Hello World!</center><br/>";
$check = $_FILES['image']['name'][2];
    
    echo "<center>Hello World! $check</center><br/>";
    
$conn = connect(); 

$date = $_REQUEST['datepicker'];
$place = $_REQUEST['keysearch'];
$tag = $_REQUEST['tag'];
$tagarr = explode(' ', trim($tag));
$datearr = explode('/', trim($date));
$privacy = $_REQUEST['privacy'];
$comments = $_REQUEST['comments'];



echo "The date = $date";
echo "from date = $datearr[1]";
echo "to date = $datearr[0]";
echo "Keyword = $datearr[2]";
echo "comment = $comments";
echo "privacy = $privacy";
echo " connectuion is = $conn jhvkzjkvhjkzvhjkxh    00-------";




  
if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

echo"i'm here";

echo"size of image file= $check   ";



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
            saveimage($image, $thumbnail,$conn);
        }
    }
}
        
    
function saveimage($image, $thumbnail,$conn){
	echo"shiiiiiiiit";
    /*
    $stmt = oci_parse($conn, "select * from images");
    oci_execute($stmt);
    oci_fetch($stmt);
    $id = 3;
    */
    
    
    //found is implemented with use of http://php.net/manual/en/function.oci-new-descriptor.php
    $lob   = oci_new_descriptor($conn, OCI_D_LOB);
    $lobimage  = oci_new_descriptor($conn, OCI_D_LOB);
    //used to save blob
    $uniqueid = uniqid();
    
    $stmt = oci_parse($conn, "insert into images (photo_id,subject,place,timing,description,thumbnail,photo) values 
    ('".$uniqueid."','".$tag."','".$place."', TO_DATE('".$date."','mm/dd/yyyy'),'".$comments."',EMPTY_BLOB(), EMPTY_BLOB()) returning thumbnail, photo into :thumbnail, :photo");
      
      oci_bind_by_name($stmt, ':thumbnail', $lob, -1,  OCI_B_BLOB);
      oci_bind_by_name($stmt, ':photo', $lobimage, -1,  OCI_B_BLOB);
      @oci_execute($stmt, OCI_NO_AUTO_COMMIT);
      echo "<center>added to database!</center><br/>";
		oci_commit($conn);
		
		/*
      if ( @$lob->save($thumbnail) && @$lobimage->save($image)){
          oci_commit($conn);
          echo "<center>Image successfully uploaded!</center><br/>";
      }else{
          echo "<table align='center'> <tr><td>Couldn't upload image. </td></tr> <tr><td>Please check you have correct sensor id.</td></tr> </table><br/>";
      }
      */
      //continue 
      
    
      $lob->free();
      oci_free_statement($stmt);
 }
 
      
      oci_close($conn);
      echo '<center><form method="post" action ="uploadwindow.html"><input type="submit" name="submit" value="continue" /> </form></center>';
?>
