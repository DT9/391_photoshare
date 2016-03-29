<?php
session_start();
// do some validation here to ensure id is safe
	$user = $_SESSION['user-name'];
	$group = $_GET['group'];
	

	include("connection_database.php");
	$conn=connect();

	$query = "select * from groups where user_name = '$user' and group_name = '$group'";
	$stmt = oci_parse ($conn, $query);
	oci_execute($stmt);
	$arr = oci_fetch_array($stmt, OCI_ASSOC);
	//if (!$arr) die();

	$query = "SELECT group_id FROM groups WHERE user_name= '$user'";
	$stmt = oci_parse ($conn, $query);
	oci_execute($stmt);
	$arr = oci_fetch_array($stmt, OCI_ASSOC);
	$groupid = $arr['GROUP_ID'];

	$query = "Delete from group_lists where group_id = '".$groupid."'"; 
	$stmt = oci_parse ($conn, $query);
	oci_execute($stmt);

	$query = "Delete from groups where group_name = '".$group."'"; 
	$stmt = oci_parse ($conn, $query);
	oci_execute($stmt);

	oci_close($conn);


//freq recent oldest
?>
