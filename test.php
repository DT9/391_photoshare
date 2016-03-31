<?php 
	session_start();
	include("connection_database.php");
	$conn=connect();
	$query = "SELECT * FROM images";	

	$stmt = oci_parse ($conn, $query);
	oci_execute($stmt);
	while ($arr = oci_fetch_array($stmt, OCI_ASSOC)){
		$id = $arr['PHOTO_ID'];
		echo '<img src="pullimage.php?id='.$id.'&type=thumbnail" width=100 height=100 />';
		//echo '<a href="display.php?id='.$id.'"><img src="pullimage.php?id='.$id.'&type=thumbnail" width="175" height="200" /></a>';
	}	
	


?>
