<?php
session_start();
$username = $_SESSION['user-name'];

//http://stackoverflow.com/questions/24895170/multiple-image-upload-php-form-with-one-input

//http://php.net/manual/en/function.oci-connect.

include("connection_database.php");
$conn = connect(); 

if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}
    
	$groupname=$_POST['group'];  
	 
	 
	 
	echo"$username";
	echo"   ------$groupname-------";	 
	
	$count = 'select group_id from groups where group_name = :groupit';
	
	$stmt = oci_parse($conn, $count);
	
	oci_bind_by_name($stmt, ':groupit', $groupname);
	oci_define_by_name($stmt, 'GROUP_ID', $result);	
	oci_execute($stmt, OCI_DEFAULT);
	oci_fetch($stmt);	
	
	echo "  result is ==  $result  -----";	
	
	
	
	
	$sat = 'delete from group_lists where group_id = :result';
	
	$stid = oci_parse($conn, $sat);	
	oci_bind_by_name($stid, ':result', $result);
	@oci_execute($stid, OCI_DEFAULT);
	
	
	$final = 'delete from groups where group_id = :group_id';
	$done = oci_parse($conn, $final);
	oci_bind_by_name($done,':group_id', $result);
	oci_execute($done, OCI_DEFAULT);
	
	
	
	
	
	
	oci_commit($conn);
		echo "<table align='center'> <tr><td>Group deleted. </td></tr> </table><br/>";	

	   oci_free_statement($stid);
	   oci_free_statement($stmt);
	   oci_free_statement($done);
      oci_close($conn);
      echo '<center><form method="post" action ="manageGroup.php"><input type="submit" name="submit" value="continue" /> </form></center>';


?>



