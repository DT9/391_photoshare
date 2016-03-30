<?php
session_start();
$username = $_SESSION['user-name'];

	$groupname = $_POST['group'];
	$friend = $_POST['user'];

	include("connection_database.php");
	$conn=connect();

	echo"   ------user is==  $username   --------";
	echo"   ------group is==  $groupname   --------";
	echo"   ------friend is==  $friend   --------";


	$count = 'select group_id from groups where user_name = :username and group_name = :groupit ';
	
	$stmt = oci_parse($conn, $count);
	
	oci_bind_by_name($stmt, ':groupit', $groupname);
	oci_bind_by_name($stmt, ':username', $username);
	oci_define_by_name($stmt, 'GROUP_ID', $result);	
	oci_execute($stmt, OCI_DEFAULT);
	oci_fetch($stmt);	
	
	echo "  result is ==  $result  -----";	




	$count1 = 'select count (*) as totalnum from group_lists where friend_id = :friend and group_id = :result';
	
	$stmt1 = oci_parse($conn, $count1);
	
	oci_bind_by_name($stmt1, ':friend', $friend);
	oci_bind_by_name($stmt1, ':result', $result);
	oci_define_by_name($stmt1, 'TOTALNUM', $result1);	
	oci_execute($stmt1, OCI_DEFAULT);
	oci_fetch($stmt1);	
	
	echo "  result is ==  $result1  -----";	



	
	if (!$result){
		oci_free_statement($stmt);
		oci_free_statement($stmt1);
		oci_close($conn);
		
		
		echo "<table align='center'> <tr><td>No such group/Not you group! Check input! </td></tr> </table><br/>";	
		echo '<center><form method="post" action ="manageGroup.php"><input type="submit" name="submit" value="continue" /> </form></center>';	
	}elseif($result1 == 0 ) {
	oci_free_statement($stmt);
	oci_free_statement($stmt1);
		oci_close($conn);
		
		
		echo "<table align='center'> <tr><td>No such friend in group/check your friends! Check input! </td></tr> </table><br/>";	
		echo '<center><form method="post" action ="manageGroup.php"><input type="submit" name="submit" value="continue" /> </form></center>';
	//check if friend exist as other user.
	}else {
	$sat = 'delete from group_lists where friend_id = :friend';
	
	$done = oci_parse($conn, $sat);	
	oci_bind_by_name($done, ':friend', $friend);
	@oci_execute($done, OCI_DEFAULT);
	
	
	
	oci_commit($conn);
	
	oci_execute($done, OCI_DEFAULT);

	
	
//freq recent oldest
	oci_free_statement($stmt);
	oci_free_statement($stmt1);
	oci_free_statement($done);
	oci_close($conn);

	echo "<table align='center'> <tr><td> Friend removed! </td></tr> </table><br/>";	
	echo '<center><form method="post" action ="manageGroup.php"><input type="submit" name="submit" value="continue" /> </form></center>';	
}
?>