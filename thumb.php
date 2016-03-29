<?php
//http://stackoverflow.com/questions/7793009/how-to-retrieve-images-from-mysql-database-and-display-in-an-html-tag
//Make sure there is no whitespace before <?php and no echo statements in the script, because otherwise the wrong HTTP header will be sent and the browser won't display the image properly. If you have problems, comment out the header() function call and see what is displayed.

//how to use <img src="pullimage.php?id=1&type=thumbnail" width="175" height="200" />
	session_start();
	include("connection_database.php");
	$conn=connect();
	// do some validation here to ensure id is safe
	$user = $_SESSION['user-name'];
	$freq = $_GET['freq'];
	$from = $_GET['from'];
	$to = $_GET['to'];
	$search = $_GET['search'];
	$group = $_GET['group'];
	$profile = $_GET['profile'];
	$mainpage = $_GET['main'];
	$admin = $_SESSION['admin'];

	if ($admin) {
		$query = "SELECT photo_id FROM images";	
	}
	elseif ($profile) {
		$query = "select photo_id from images where owner_name = '$user'";
	}
	elseif ($mainpage) {
		$query = "select photo_id from images where permitted = '1' or owner_name = '$user' or permitted in (select group_id from group_lists where friend_id = '$user' union select group_id from groups where user_name = '$user' )";
	}
	else {
		$query = "SELECT photo_id FROM images";
	}
	function imagequery($query,$conn) {
		$stmt = oci_parse ($conn, $query);
		oci_execute($stmt);
		while ($arr = oci_fetch_array($stmt, OCI_ASSOC)){
			$id = $arr['PHOTO_ID'];
			echo '<a href="display.php?id='.$id.'"><img src="pullimage.php?id='.$id.'&type=thumbnail" width="175" height="200" /></a>';
		}	
	}
	imagequery($query,$conn);
	oci_close($conn);

//freq recent oldest
?>
