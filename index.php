<?php
include("connection_database.php");
?>

       <?php
        
	    
	    header("Location: mainpage.html")
	    
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
	
	?>