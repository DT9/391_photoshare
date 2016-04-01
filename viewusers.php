<?php
	
	session_start();
	include("connection_database.php");										
	$conn=connect();

	$username = $_SESSION['user-name'];
	$groupname = $_POST['group'];

	$stmt = oci_parse($conn,'select group_id from groups where  group_name = :groupit');

	oci_bind_by_name($stmt, ':groupit', $groupname);
	oci_define_by_name($stmt, 'GROUP_ID', $result);	
	oci_execute($stmt, OCI_DEFAULT);
	oci_fetch($stmt);	
	
	

	$sql = oci_parse($conn,'select friend_id from group_lists where  group_id = \''.$result.'\'');
	oci_execute($sql, OCI_DEFAULT);
	

	echo "<center>Users Are:</center><br/>";

	while($row = oci_fetch_array($sql)){
		 print_r($row['FRIEND_ID']);
		 echo "<br/>";
	}

	oci_free_statement($stmt);
	oci_free_statement($sql);
	oci_close($conn);




echo '<center>
            <input type="button" onclick="self.close();" value="close this window">
</center>';

?>