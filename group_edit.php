<?php
session_start();
$user = $_SESSION['user-name'];

	$group = $_GET['group'];
	$friend = $_GET['user'];
	$desc = $_GET['desc'];

	include("connection_database.php");
	$conn=connect();

	$query = "select * from groups where user_name = '$user' and group_name = '$group'";
	$stmt = oci_parse ($conn, $query);
	$res2 = oci_execute($stmt);
	$arr = oci_fetch_array($stmt, OCI_ASSOC);
	$groupid = $arr['GROUP_ID'];
	if (!$arr) die();

	$time = date ("DD-MM-YY", $phptime);
	$query = "insert into group_lists ('$groupid','$friend','$time','$desc')";
	$stmt = oci_parse ($conn, $query);
	$res = oci_execute($stmt);
	$arr = oci_fetch_array($stmt, OCI_ASSOC);
	print_r($arr);
	print_r($query);

	header("Location: ./manageGroup.html");
	oci_close($conn);
//freq recent oldest
?>
