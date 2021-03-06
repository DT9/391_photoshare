<?php
session_start();
$username = $_SESSION['user-name'];

	$groupname = $_POST['group'];
	$friend = $_POST['user'];
	$desc = $_POST['desc'];

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



	if (!$result){
		oci_free_statement($stmt);
		oci_close($conn);
		
		
		echo "<table align='center'> <tr><td>No such group/Not you group! Check input! </td></tr> </table><br/>";	
		echo '<center><form method="post" action ="manageGroup.php"><input type="submit" name="submit" value="continue" /> </form></center>';	
	}else{
	

	//check if friend exist as other user.
	$check = 'declare
					l_is_matching_row int;
				begin
						select count (*)
						into l_is_matching_row 
						from users 
						where user_name <> :user and 
						user_name = :friend
						;
						
						if (l_is_matching_row != 0)
						then insert into group_lists 
										(group_id, friend_id, date_added, notice)
						values (:groupid, :friend, sysdate, :desc)
						;
						commit;
					end if;
					
				exception 
					when DUP_VAL_ON_INDEX
					then ROLLBACK;
				end;';



	$done = oci_parse ($conn, $check);
	
	oci_bind_by_name($done, ':user', $username);
	oci_bind_by_name($done, ':groupid', $result);
   oci_bind_by_name($done, ':friend', $friend);
   oci_bind_by_name($done, ':desc', $desc);
	
	oci_execute($done, OCI_DEFAULT);

	
	
//freq recent oldest
	oci_free_statement($stmt);
	oci_free_statement($done);
	oci_close($conn);

	echo "<table align='center'> <tr><td> Friend added! </td></tr> </table><br/>";	
	echo '<center><form method="post" action ="manageGroup.php"><input type="submit" name="submit" value="continue" /> </form></center>';	
}
?>
