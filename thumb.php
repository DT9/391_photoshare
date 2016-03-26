<?php
//http://stackoverflow.com/questions/7793009/how-to-retrieve-images-from-mysql-database-and-display-in-an-html-tag
//Make sure there is no whitespace before <?php and no echo statements in the script, because otherwise the wrong HTTP header will be sent and the browser won't display the image properly. If you have problems, comment out the header() function call and see what is displayed.

//how to use <img src="pullimage.php?id=1&type=thumbnail" width="175" height="200" />

// do some validation here to ensure id is safe
	$freq = $_GET['freq'];;
	include("connection_database.php");
	$conn=connect();
	
	$query = "SELECT photo_id FROM images";

	$stmt = oci_parse ($conn, $query);
	oci_execute($stmt);
	while ($arr = oci_fetch_array($stmt, OCI_ASSOC)){
		$myimgtype = strtoupper($myimgtype);
		$id = $arr['PHOTO_ID'];
		header("Content-type: image/JPEG");
		echo '<a href=""><img src="pullimage.php?id='.$id.'&type=thumbnail" width="175" height="200" /></a>';
		}
	oci_close($conn);

//freq recent oldest
?>
