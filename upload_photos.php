



<?php
session_start();
$user = $_SESSION['user-name'];
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


    
   $date = $_POST['datepicker'];
	$place = $_POST['keysearch'];
	$tag = $_POST['tag'];
	$tagarr = explode(' ', trim($tag));
	$datearr = explode('/', trim($date));
	$privacy = $_POST['privacy'];
	$comments = $_POST['comments'];


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
          $tmp_name = $_FILES['image']['tmp_name'][$i];
          list($width, $height) = getimagesize($tmp_name);
            $image= addslashes($_FILES['image']['tmp_name'][$i]);
            $image= file_get_contents($image);
            //$image= base64_encode($image);

            $thumbnail = scaleImageFileToBlob($_FILES['image']['tmp_name'][$i]);            
            
            //$thumbnail = base64_encode($thumbnail);
       
       
       echo"shiiiiiiiit";
	echo"-------------here------------";    	
		
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
    $uniqueid =rand();;

    $stmt = oci_parse($conn, 'insert into images (photo_id,owner_name,permitted,subject,place,timing,description,thumbnail,photo) values 
    (:php_id, :owner_name, :permitted, :tags, :location, TO_DATE( :time, \'mm/dd/yyyy\'), :notes, EMPTY_BLOB(), EMPTY_BLOB()) returning thumbnail, photo into :thumbnail, :photo');
      
      oci_bind_by_name($stmt, ':owner_name', $user);
      oci_bind_by_name($stmt, ':permitted', $privacy);
      oci_bind_by_name($stmt, ':php_id', $uniqueid);
      oci_bind_by_name($stmt, ':tags', $tag);
      oci_bind_by_name($stmt, ':location', $place);
      oci_bind_by_name($stmt, ':time', $date);
      oci_bind_by_name($stmt, ':notes', $comments);
      
      oci_bind_by_name($stmt, ':thumbnail', $lob, -1,  OCI_B_BLOB);
      oci_bind_by_name($stmt, ':photo', $lobimage, -1,  OCI_B_BLOB);
      
      
// http://www.php-tutorials.com/oracle-blob-insert-php-bind-variables/
      
      if(!oci_execute($stmt, OCI_DEFAULT)) {
  			$e = error_get_last();
  			$f = oci_error();
  			echo "Message: ".$e['message']."\n";
  			echo "File: ".$e['file']."\n";
 			echo "Line: ".$e['line']."\n";
 			echo "Oracle Message: ".$f['message'];
  // exit if you consider this fatal
  			echo "<table align='center'> <tr><td>Couldn't upload image. </td></tr> <tr><td>Please check you have correct sensor id.</td></tr> </table><br/>";
		} else {
 
  // save the blob data
		  $lob->save($thumbnail);
  		$lobimage->save($image);
  // commit the query
  		oci_commit($conn);
  // free up the blob descriptors
  $lob->free();
  $lobimage->free();
  echo "<center>Image successfully uploaded!</center><br/>";
}


	/*
      @oci_execute($stmt, OCI_NO_AUTO_COMMIT);
      echo "<center>Shiiiiiiiit!</center><br/>";
		
		
      if ( @$lob->save($thumbnail) && @$lobimage->save($image)){
          oci_commit($conn);
          echo "<center>Image successfully uploaded!</center><br/>";
      }else{
          echo "<table align='center'> <tr><td>Couldn't upload image. </td></tr> <tr><td>Please check you have correct sensor id.</td></tr> </table><br/>";
      }
      //continue 
      */
    
      oci_free_statement($stmt);
    }
}
        
	
 }
 
      
      oci_close($conn);
      echo '<center><form method="post" action ="uploadwindow.php"><input type="submit" name="submit" value="continue" /> </form></center>';
?>
