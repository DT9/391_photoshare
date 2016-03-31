<!--<!DOCTYPE html>-->

<?php
      //////////////////////get user's information///////////////////////////
			include("connection_database.php");
			session_start();
	      $conn=connect();
           $user=$_SESSION['user-name'];
          $up = $_POST['update'];
          $a = $_POST['first'];
          $b = $_POST['last'];
          $c = $_POST['addr'];
          $d = $_POST['email'];
          $e = $_POST['phone'];
          if ($up) {
            $sql = "update persons set first_name = '$a', last_name = '$b', address = '$c', email = '$d',phone  = '$e' 
            where user_name = '$user' ";
            $stid = oci_parse($conn, $sql);        
            //Execute a statement returned from oci_parse()
            $res=oci_execute($stid);

          }
	      
	      if (!$conn) {
    		$e = oci_error();
    		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	    }
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
                        <script src="https://code.jquery.com/jquery-2.2.2.min.js"></script>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

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
                    <li><a href="profilepage.php">PROFILE</a></li>
                   <li><a href="documentation/documentation_sample.html">HELP</a></li>
                    <li><a href="logout.php">LOGOUT</a></li>
                    </ul>
                </div>
                <!--<div id="search_form"><form action="search.php" method="get"><input name="s" type="text" size="9" maxlength="30">-->
                    </form>
                </div>           




<!----------------------- search form ------------------------------------- -->

					 <form name="seach-form" method="post" action="search_page.php">
            	Search Gallery:
            	<p>
            	<!-- search by date -->
            	<label for="from">From (DD-MM-YY)</label>
					<input type="text" id="from" name="from">
					<label for="to">to (DD-MM-YY)</label>
					<input type="text" id="to" name="to">
					<br>
            	<!-- search by subject -->
            	Enter Key Word:<input type ="search" id = "keysearch" name= "keysearch">
            	
            	
            	<!-- frequency ascending or descending order-->
            	<select name="c"><option value="0">Frequent</option><option value="1">Most Recent</option><option value="2">Oldest</option></select>
					<br>					
					<input type="submit">            	
            	</p>
            	
           		 </form>
			
      
            
            
              <div id="cuerpo">
                <div id="cuerpo">

                <div id="profile-info"> 
               <h3> <form method="post">
                <?php echo "Username: $username"; ?><br>
                <?php echo "First name: <input name='first'>$firstname</input>"; ?> <br>
                <?php echo "Last name: <input name='last'>$lastname</input>"; ?>   <br>         
                <?php echo "Address: <input name='addr'>$address</input>"; ?>  <br>             
                <?php echo "Email: <input name='email'>$email</input>"; ?>  <br> 
                <?php echo "Phone: <input name='phone'>$phone</input>"; ?>   <br> 
                <input type="submit" name="update" value="Update Info"> </form> <br>
                <?php echo "<a href='admin.php'>Admin</a>" ?>   <br> 
                </h3>           
                 </div>
                
                
                    <div id="up_izq"><h3>GALLERY</h3></div>
                    
                    
                    <div id="nav">
                        <ul
                            <li><a href="javascript:void(0);"
                                NAME="My Window Name"  title=" My title here "
                                onClick=window.open("uploadwindow.php","Ratting","width=550,height=700,0,status=0,scrollbars=1");>--UPLOAD--</a></li>
                            
                        </ul>
                    </div>
                    

						<div id="nav">
                 <ul>
                     <li><a href="javascript:void(0);"
                         NAME="My Window Name"  title=" My title here "
                         onClick=window.open("manageGroup.php","Ratting","width=550,height=700,0,status=0,scrollbars=1");>--Manage Groups--</a></li>
                          
                 </ul>
           		 </div>                    
                    
                    
                    
                    <div id="up_der"><form id="gform" action="/search.html/" method="get" name="jumpto"><select name="c" onchange="javascript: submit();"><option value="0">Frequent</option><option value="1">Most Recent</option><option value="2">Oldest</option></select></form></div>
                </div>           
      
                



        <div id="chickenbutt">

        </div>            
          <script type="text/javascript">
            function fivethumb(str) {
                $("#chickenbutt").html("");
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        var txt = xmlhttp.responseText;
                        $("#chickenbutt").html(txt);
                    }
                };
                var thumb = "thumb.php";
                if (location.search) thumb += location.search + "&" + str;
                else {
                    thumb += "?" + str;
                }
                xmlhttp.open("GET", thumb, true);
                xmlhttp.send();
            };
            fivethumb("profile=true");
            //popularity of an image is specified by the number of distinct users that have ever viewed the image
            $('#from').datepicker({ dateFormat: 'dd-mm-y' });
            $('#to').datepicker({ dateFormat: 'dd-mm-y' });
        </script>  
                

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