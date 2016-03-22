<!DOCTYPE html>
<html>
<head><!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

<!-- http://bootsnipp.com/snippets/featured/social-login-page-with-css-background-->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</head>
<style type="text/css">@charset "UTF-8";
/* CSS Document */

body {
    width:100px;
	height:100px;
  background: -webkit-linear-gradient(90deg, #16222A 10%, #3A6073 90%); /* Chrome 10+, Saf5.1+ */
  background:    -moz-linear-gradient(90deg, #16222A 10%, #3A6073 90%); /* FF3.6+ */
  background:     -ms-linear-gradient(90deg, #16222A 10%, #3A6073 90%); /* IE10 */
  background:      -o-linear-gradient(90deg, #16222A 10%, #3A6073 90%); /* Opera 11.10+ */
  background:         linear-gradient(90deg, #16222A 10%, #3A6073 90%); /* W3C */
font-family: 'Raleway', sans-serif;
}

p {
	color:#CCC;
}

.spacing {
	padding-top:7px;
	padding-bottom:7px;
}
.middlePage {
	width: 680px;
    height: 500px;
    position: absolute;
    top:0;
    bottom: 0;
    left: 0;
    right: 0;
    margin: auto;
}

.logo {
	color:#CCC;
}</style>
<body>
<link href='http://fonts.googleapis.com/css?family=Raleway:500' rel='stylesheet' type='text/css'>

<div class="middlePage">
<div class="page-header">
  <h1 class="logo">Photoshare <small>Welcome to our the flickr clone!</small></h1>
</div>

<div class="panel panel-info">
  <div class="panel-heading">
    <h3 class="panel-title">Please Sign In</h3>
  </div>
  <div class="panel-body">
  
  <div class="row">
  
<div class="col-md-5" >
<form class="form-horizontal">
<fieldset>
<!-- login username and password start-->  
        <form name="registration" method="post" action="index.php">
            CCID : <input type="text" name="jianletang"/> <br/><!-- not name=null value --> 
            Name : <input type="text" name="jianletang"/><br/>
            <input type="submit" name="validate" value="OK"/>
        </form>






<form name="login_table" action="index.php">

  <input id="textinput" name="textinput" type="text" placeholder="Enter User Name"><br>
  <input id="textinput" name="textinput" type="text" placeholder="Enter Password" class="form-control input-md">
  <button id="singlebutton" type="submit">Sign In</button>

</form>
<!-- login username and password end-->  
</fieldset>
</form>
</div>

    <div class="col-md-7" style="border-left:1px solid #ccc;height:160px">
<form class="form-horizontal">
<fieldset>

  <!--<input id="textinput" name="textinput" type="text" placeholder="Enter User Name" class="form-control input-md">
  <div class="spacing"><input type="checkbox" name="checkboxes" id="checkboxes-0" value="1"><small> Remember me</small></div>
  <input id="textinput" name="textinput" type="text" placeholder="Enter Password" class="form-control input-md">
  <div class="spacing"><a href="#"><small> Create New Account?</small></a><br/></div>
  <button id="singlebutton" name="singlebutton" class="btn btn-info btn-sm pull-right">Sign In</button> -->
  <a href="http://consort.cs.ualberta.ca/~jianle/database_site/391_photoshare/signup.php">Create New Account?</a>


</fieldset>
</form>
</div>
    
</div>
    
</div>
</div>

<p><a href="https://github.com/dt9/391_photoshare">About</a> Jian</p>

</div>
</body>
</html>
