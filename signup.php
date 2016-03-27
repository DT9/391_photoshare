<?php
include("connection_database.php");
?>
<html>
    <body>
       <?php
        
        if (isset ($_POST['validate'])){
            //get the input
            $user=$_POST['username'];
            $pswd=$_POST['password'];
            $fn=$_POST['firstname'];
            $ln=$_POST['lastname'];
            $address=$_POST['address'];
            $email=$_POST['email'];
            $phone=$_POST['phonenumber'];
            /*
            //if not all parts are filled, unsuccessful 
				if ($user==''or $pswd=='' or $fn=='' or $ln=='' or $address=='' or $email=='' or $phone==''){
				header("location:http://consort.cs.ualberta.ca/~jianle/database_site/391_photoshare/signup.html");	    
	    		exit;				
				}
				*/
	    ini_set('display_errors', 1);
	    error_reporting(E_ALL);
	    
            //establish connection
            $conn=connect();
	    if (!$conn) {
    		$e = oci_error();
    		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	    }
 	///////////////////////////////////////////////////////////////////////////////////
 	//checking if username and password in system 
 		 $sql='select count(*) from Users where user_name=\''.$user.'\' or password=\''.$pswd.'\'';
 		 $sql.='insert into Users (user_name, password) values (\''.$user.'\',\''.$pswd.'\')';
 		 $sql.='insert into persons (user_name, first_name, last_name, address, email, phone) values (\''.$user.'\',\''.$pswd.'\',\''.$fn.'\',\''.$ln.'\',\''.$address.'\',\''.$email.'\',\''.$phone.'\')';
 		 $sql.='insert into persons (user_name, first_name, last_name, address, email, phone) values (\''.$user.'\',\''.$pswd.'\',\''.$fn.'\',\''.$ln.'\',\''.$address.'\',\''.$email.'\',\''.$phone.'\')';
 		 $sql.='insert into persons (user_name, first_name, last_name, address, email, phone) values (\''.$user.'\',\''.$pswd.'\',\''.$fn.'\',\''.$ln.'\',\''.$address.'\',\''.$email.'\',\''.$phone.'\')';
	    echo $sql;
	    //Prepare sql using conn and returns the statement identifier
	    $stid = oci_parse($conn, $sql);
	    
	    //Execute a statement returned from oci_parse()
	    $res=oci_execute($stid);
	    //$r='1';
	    while ($row=oci_fetch_array($stid,OCI_BOTH)){$r= $row[0];}
	    //$row=oci_fetch_array($stid,OCI_BOTH)
	    echo $r;
	    oci_free_statement($stid);
	    oci_close($conn);
       /*
	    $result=FALSE;
	    if ($r!='0'){ $result=TRUE;}
	    echo $result;
	    if ($result){
	    	header("location:http://consort.cs.ualberta.ca/~jianle/database_site/391_photoshare/signup.html");
		 	echo "error";	    
	    	exit;
	    }
	    */
	    echo "good good";
	    
	    
	    
	    //if error, retrieve the error using the oci_error() function & output an error message
/*
	    if (!$res) {
		$err = oci_error($stid); 
		echo htmlentities($err['message']);
	    }
	    else{
		echo 'Row inserted';
	    }
*/ 
	    // Free the statement identifier when closing the connection


	}
	?>


	</body>

</html>

