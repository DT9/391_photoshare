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
    

   $groupid = rand();
	$groupname=$_POST['groupname'];  
	 
	echo"$username";
	echo"   ------$groupname-------";	 
	 
	 
	$check = 'declare
					l_is_matching_row int;
				begin
						select count (*)
						into l_is_matching_row 
						from groups 
						where group_name = :groupname
						;
						
						if (l_is_matching_row = 0)
						then insert into groups 
										(group_id, user_name, group_name, date_created)
						values (:groupid, :username, :groupname, sysdate)
						;
						commit;
					end if;
					
				exception 
					when DUP_VAL_ON_INDEX
					then ROLLBACK;
				end;';
	

		$count = 'select count (*) as totalnum from groups where group_name = :groupit';

		$stid = oci_parse($conn,$check);
		$stmt = oci_parse($conn, $count);
		
		
		oci_bind_by_name($stmt, ':groupit', $groupname);
		oci_define_by_name($stmt, 'TOTALNUM', $result);

      oci_bind_by_name($stid, ':groupid', $groupid);
      oci_bind_by_name($stid, ':username', $username);
      oci_bind_by_name($stid, ':groupname', $groupname);
	
	oci_execute($stmt, OCI_DEFAULT);
	oci_execute($stid, OCI_DEFAULT);
	
	oci_fetch($stmt);
	
	echo "  result is ==  $result  -----";
			
	
	if ($result != 0){
		echo "<table align='center'> <tr><td>Couldn't create group. </td></tr> <tr><td> Group alreay exist.</td></tr> </table><br/>";
	}else {
		oci_commit($conn);
		echo "<table align='center'> <tr><td>Group created! </td></tr> </table><br/>";	
	}

	   oci_free_statement($stid);
	   oci_free_statement($stmt);
      oci_close($conn);
      echo '<center><form method="post" action ="manageGroup.php"><input type="submit" name="submit" value="continue" /> </form></center>';


?>
