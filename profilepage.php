<!--<!DOCTYPE html>-->

<?php
include("connection_database.php");
session_start();
	//connect();
	//echo "<h1>hello</h1>";
	$user=$_SESSION['user-name'];
	echo "hello $user";
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
            


					 <form action="search_page.php">
            	Search Gallery:
            	<p>
            	<label for="from">From</label>
					<input type="text" id="from" name="from">
					<label for="to">to</label>
					<input type="text" id="to" name="to">
					</p>
            	

            	<p>
            	Enter Key Word:<input type ="search" id = "keysearch" name= "keysearch">
            	<input type="submit"></p>
            	
           		 </form>
			
            
            
            
              <div id="cuerpo">
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