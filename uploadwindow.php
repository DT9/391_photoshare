<!DOCTYPE html>
<!-- picture upload is from http://bootsnipp.com/snippets/featured/bootstrap-drag-and-drop-upload-->

<html>
    <head>
       <link rel="stylesheet" type="text/css" href="st1.css">    <link rel="stylesheet" type="text/css" href="lightview.css">
                    
       <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
       <style></style>
       
       <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  		<script src="//code.jquery.com/jquery-1.10.2.js"></script>
 	 	<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  		<link rel="stylesheet" href="/resources/demos/style.css">
  		<script>
  		$(function() {
    		$( "#datepicker" ).datepicker();
  		});
  		</script>
                

                        
    </head>

    <?php 
    session_start();
    $user = $_SESSION['user-name'];
include("connection_database.php");
$conn=connect();

function getres($sql,$conn) {
    $stid = oci_parse($conn,$sql);
    $res = oci_execute($stid);
    while (($row = oci_fetch_array($stid, OCI_ASSOC))) {      
      echo '<option value="'.$row['GROUP_ID'].'">'.$row['GROUP_NAME'].'</option>';        
    }
}?>

    <body>
    
    
    	<div id="cabecera">
    		<div id="logo">
                    
         	<h1>Upload Your Image: <?php echo $user; ?></h1>
      	</div>
    	</div>

		
    
    	
    
          <form action="upload_photos.php" method="post" enctype="multipart/form-data">
            	
					<p>Date: <input type="text" id="datepicker" name="datepicker" placeholder="MM/DD/YYYY"></p>
           
            	<p>
            	Place:<input type ="search" id = "keysearch" name= "keysearch" placeholder="Location"></p>
            	
            	<p>Tag:<input type="search" id="tag" name="tag"placeholder="Split tags with spacebar"></p>
            	<p>Privacy:</p>
                          <select name="privacy" class="form-control">
                                  <?php
                                      getres("select s.group_id, s.group_name from group_lists g,groups s where g.friend_id = '".$user."' and s.group_id = g.group_id union select group_id, group_name from groups where group_id = 1 or group_id = 2",$conn);

                                  ?>
                              </select>
    			<p>Comments:</p>

					<div>
					<textarea name="comments" id="comments" style="font-family:sans-serif;font-size:1.2em;" placeholder="Extra Notes"></textarea>
					</div>

    
    
    
    
    
    	<div class="container">
      <div class="panel panel-default">
        <div class="panel-body">

          <!-- Standar Form -->
          <h4>Select files from your computer</h4>

            <div class="form-inline">
              <div class="form-group">
                <input type="file" name="image[]" id="image[]" multiple="multiple"/>
              </div>
              <button type="submit" class="btn btn-sm btn-primary" id="js-upload-submit"/> Upload files</button>
            </div>




        </div>
      </div>
    </div> <!-- /container -->
    
    
    </form>
    
    		
        <center>
            <input type="button" onclick="self.close();" value="close this window">
        </center>

    </body>
</html>