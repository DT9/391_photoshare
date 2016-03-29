<?php 
	session_start();
	include("connection_database.php");
	$conn=connect();
	$user = $_SESSION['user-name'];
	$freq = $_GET['freq'];
	$from = $_GET['from'];
	$to = $_GET['to'];
	$search = $_GET['search'];
	$group = $_GET['group'];
	$profile = $_GET['profile'];
	$mainpage = $_GET['main'];
	//print_r($user);
	$user = 'john';
	$query = "select group_id from group_lists where friend_id = '$user' union select group_id from groups where user_name = '$user' ";
	$stmt = oci_parse ($conn, $query);
	oci_execute($stmt);
	while($arr = oci_fetch_array($stmt, OCI_ASSOC)) {
	$group = $arr['GROUP_ID'];
	print_r($group);
}
	print_r($query);
?>
