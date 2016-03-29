<?php
session_start();
// do some validation here to ensure id is safe
	$user = $_SESSION['user-name'];
	$group = $_GET['group'];
	$friend = $_GET['user'];

	include("connection_database.php");
	$conn=connect();

	$query = "select * from groups where user_name = '$user' and group_name = '$group'";
	$stmt = oci_parse ($conn, $query);
	$res2 = oci_execute($stmt);
	$arr = oci_fetch_array($stmt, OCI_ASSOC);
	$groupid = $arr['GROUP_ID'];
	if (!$arr) die();

	$query = "Delete from group_lists where group_id = '".$groupid."' and friend_id = '$friend'";
	$stmt = oci_parse ($conn, $query);
	$res = oci_execute($stmt);
	$arr = oci_fetch_array($stmt, OCI_ASSOC);
	print_r($arr);
	print_r($query);

	header("Location: ./manageGroup.html")

	oci_close($conn);
//freq recent oldest
?>
