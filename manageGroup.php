<!DOCTYPE html>
<!-- picture upload is from http://bootsnipp.com/snippets/featured/bootstrap-drag-and-drop-upload-->
    
    
                                             <?php 
                                             session_start();
															include("connection_database.php");
															
															$conn=connect();
															$username = $_SESSION['user-name'];

															function getres($sql,$conn) {
													    $stid = oci_parse($conn,$sql);
														    $res = oci_execute($stid);
 													   while (($row = oci_fetch_array($stid, OCI_ASSOC))) {
 												       foreach($row as $item)   {
 											           echo '<option>'.$item.'</option>';
 													       }
															    }
																}?>
<html>
    <head>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
                           
    </head>



    <body>
    
    
    	<div id="cabecera">
    		<div id="logo">
                    
      	</div>
    	</div>
    
            	
					<div class="container-projects bg-primary">
        <div class="container">
            <h1 id="projects" class="text-center">Create a group!</h1>
            <div class="row">
                <form action="creategroup.php" method="post" enctype="multipart/form-data">
                    <div class="text-center">
                        <input class="butt form-control" id="groupname" name="groupname" /> 
                        <br><input type="submit" value="Create group!" id="selectedButton" color="black"/>
                    </div>
                </form>
            </div>
        </div>
        <div class="clearfix hidden-xs" style="width:100%; height:50px;"></div>
    </div>
    
    
    
    <div class="container-projects bg-success">
        <div class="container">
            <h1 id="projects" class="text-center">Add users to group!</h1>
            <div class="row">
                <form action="group_edit.php" method="post" enctype="multipart/form-data">
                    <div class="text-center">
                                            <label>Groups</label>
                                            <select name="group" class="form-control">
                                                <?php
                                                    getres('select group_name from groups where user_name = \''.$username.'\'',$conn);
                                                ?>
                                            </select>                                               <div>
                                            <label>Users</label>
                                            <input id="noob" name="user" multiple="" class="form-control"></input>
                                            Description
                                            <input id="noob" name="desc" multiple="" class="form-control"></input>
                                            <div>
                        <br><input type="submit" value="Update group!" id="selectedButton" color="black"/>
                    </div>
                </form>
            </div>
        </div>
        <div class="clearfix hidden-xs" style="width:100%; height:50px;"></div>
    </div>
    
    
	<div class="container-projects bg-success">
        <div class="container">
            <h1 id="projects" class="text-center"> Delete users from group!</h1>
            <div class="row">
                <form action="group_user_delete.php" method="post" enctype="multipart/form-data">
                    <div class="text-center">
                                            <label>Groups</label>
                                            <select name="group" class="form-control">
                                                <?php
                                                    getres('select group_name from groups where user_name = \''.$username.'\'',$conn);
                                                ?>
                                            </select>                                               <div>
                                            <label>User</label>
                                            <input id="noob" name="user" multiple="" class="form-control"></input>
                                          
                                            <div>
                        <br><input type="submit" value="Delete User" id="selectedButton" color="black"/>
                    </div>
                </form>
            </div>
        </div>
        <div class="clearfix hidden-xs" style="width:100%; height:50px;"></div>
    </div>    
    
    
    

                                            
    
    
    
    <div class="container-projects bg-warning">
        <div class="container">
            <h1 id="projects" class="text-center">Delete a group!</h1>
            <h3><?php echo "username is: $username";?> <br></h3>
            <div class="row">
                <form action="deletegroup.php" method="post" enctype="multipart/form-data">
                    <div class="text-center">
                                            <label>Groups</label>
                                            
                                            <select name="group" class="form-control">
                                                <?php
                                                    getres('select group_name from groups where user_name = \''.$username.'\'',$conn);
                                                ?>
                                            </select>
                                            
   
                                            
                                            
                                <br><input type="submit" value="Delete group!" id="selectedButton" color="black"/>
                    </div>
                </form>
            </div>
        </div>
        <div class="clearfix hidden-xs" style="width:100%; height:50px;"></div>
    </div>
    
    		
        <center>
            <input type="button" onclick="self.close();" value="close this window">
        </center>

    </body>
    

    
    
    
</html>