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
            
            
				if ($user==''or $pswd=='' or $fn=='' or $ln=='' or $address=='' or $email=='' or $phone==''){
				header("location:http://consort.cs.ualberta.ca/~jianle/database_site/391_photoshare/signup.html");	    
	    		exit;				
				}
				
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
 		 $sql.='insert into persons (user_name, first_name, last_name, adress, email, phone) values (\''.$user.'\',\''.$pswd.'\',\''.$fn.'\',\''.$ln.'\',\''.$adress.'\',\''.$email.'\',\''.$phone.'\'');
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
      
	    $result=FALSE;
	    if ($r!='0'){ $result=TRUE;}
	    echo $result;
	    if ($result){
	    	header("location:http://consort.cs.ualberta.ca/~jianle/database_site/391_photoshare/signup.html");
		 	echo "error";	    
	    	exit;
	    }
	    
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

<head>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</head>
<style type="text/css">

</style>
	
<body class="">
   <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
		<form role="form" action="">
			<h2>Please Sign Up</h2>
			<hr class="colorgraph">
			<div class="row">
				<div class="col-xs-12 col-sm-6 col-md-6">
					<div class="form-group">
                        <input type="text" name="first_name" id="first_name" class="form-control input-lg" placeholder="First Name" tabindex="1">
					</div>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-6">
					<div class="form-group">
						<input type="text" name="last_name" id="last_name" class="form-control input-lg" placeholder="Last Name" tabindex="2">
					</div>
				</div>
			</div>
			<div class="form-group">
				<input type="text" name="display_name" id="display_name" class="form-control input-lg" placeholder="User Name" tabindex="3">
			</div>
			<div class="form-group">
				<input type="email" name="email" id="email" class="form-control input-lg" placeholder="Email Address" tabindex="4">
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-6 col-md-6">
					<div class="form-group">
						<input type="password" name="password" id="password" class="form-control input-lg" placeholder="Password" tabindex="5">
					</div>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-6">
					<div class="form-group">
						<input type="phone" name="phone" id="phone" class="form-control input-lg" placeholder="Phone Number" tabindex="6">
					</div>
				</div>
			</div>
			
			<hr class="colorgraph">
			<div class="row">
				<div class="col-xs-12 col-md-12"><input type="submit" value="Register" class="btn btn-primary btn-block btn-lg" tabindex="7"></div>
			</div>
		</form>
</body>

</html>

