<!--<!DOCTYPE html>-->

<?php
      //////////////////////get user's information///////////////////////////
			include("connection_database.php");
			session_start();
	      $conn=connect();
	      
	      
	      if (!$conn) {
    		$e = oci_error();
    		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	    }
			$user=$_SESSION['user-name'];
			//echo "hello $user";
			
			$sql='select * from Persons where user_name=\''.$user.'\'';
			//echo $sql;
	    //Prepare sql using conn and returns the statement identifier
	    $stid = oci_parse($conn, $sql);
	    
	    //Execute a statement returned from oci_parse()
	    $res=oci_execute($stid);
	    
	    while ($row=oci_fetch_array($stid,OCI_BOTH)){
	    	//echo "good";
	    	$username= $row[0]; 
	    	$firstname=$row[1];
	    	$lastname=$row[2];
	    	$address=$row[3];
	    	$email=$row[4];
	    	$phone=$row[5];
	    	}
	    //$row=oci_fetch_array($stid,OCI_BOTH)
	    oci_free_statement($stid);
	    oci_close($conn);			
	    /////////////////////end get user's info///////////////////////////////
?>

<html lang="en">
    <head>

            <link rel="stylesheet" type="text/css" href="st1.css">    <link rel="stylesheet" type="text/css" href="lightview.css">
                    
                    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
                <style></style>
                        
    </head>
    
    <body>
    

			
        <div id="contenedor">
            
            
            
            <div id="cabecera">
                <div id="logo">
                    
                    <h1><a id="top" href="mainpage.html">PHOTOSHARE</a></h1>
                </div>
                <div id="nav">
                    <ul>
                        <li><a href="mainpage.html">HOME</a></li>
                        <li><a href="profilepage.html">PROFILE</a></li>
                        <li><a href="search.html">SEARCH</a></li>
                        <li><a href="new_index.html">LOGOUT</a></li>
                    </ul>
                </div>
                <div id="search_form"><form action="/search.php" method="get"><input name="s" type="text" size="9" maxlength="30">
                    </form>
                </div>           
                </div>
            
            
                <div id="cuerpo">
                <div id="profile-info"> 
               <h3> 
       			<?php echo "Username: $username"; ?><br>
                <?php echo "First name: $firstname"; ?> <br>
                <?php echo "Last name: $lastname"; ?>   <br>         
                <?php echo "Address: $address"; ?>  <br>             
                <?php echo "Email: $email"; ?>  <br> 
                <?php echo "Phone: $phone"; ?>   <br> 
                </h3>           
                 </div>
                
                
                    <div id="up_izq"><h3>GALLERY</h3></div>
                    
                    
                    <div id="nav">
                        <ul>
                            <li><a href="javascript:void(0);"
                                NAME="My Window Name"  title=" My title here "
                                onClick=window.open("uploadwindow.html","Ratting","width=550,height=700,0,status=0,scrollbars=1");>--UPLOAD--</a></li>
                            
                        </ul>
                    </div>
                    
                    <div id="up_der"><form id="gform" action="/search.html/" method="get" name="jumpto"><select name="c" onchange="javascript: submit();"><option value="0">Frequent</option><option value="1">Most Recent</option><option value="2">Oldest</option></select></form></div>
                </div>
                




                <div>
                    <img src="getImage.php?id=1" width="175" height="200" />
                </div>
                
             
             
             
                
                
                
                
                <div id="pie">
                    
                    <div id="pie_l">
                        <ul>
                            <li><a href="mainpage.html">HOME</a></li>
                        </ul>
                    </div>
                    <div id="pie_r">
                        <a href="#">UP <span class="up">↑</span></a>
                    </div>
                </div>
                
                
                
                
            </div>
        
    </body>
</html>