<?php
if(!isset($_SESSION)) { //check if sessions has been initialized
     session_start();	//initialize session
}
if (!isset($_SESSION['user-name'])) { //checks if there's a user
	die();
}
?>
<div id="cabecera">
            <div id="logo">

                <h1><a id="top" href="mainpage.html">PHOTOSHARE</a></h1>
            </div>
            <div id="nav">
                <ul>
                    <li><a href="mainpage.php">HOME</a></li>
                    <li><a href="profilepage.php">PROFILE</a></li>
                    <li><a href="search.html">SEARCH</a></li>
                    <li><a href="manageGroup.html">GROUP</a></li>
                    <li><a href="documentation/documentation_sample.html">HELP</a></li>
                    <li><a href="logout.php">LOGOUT</a></li>
                </ul>
            </div>
            <div id="search_form">
                <form action="search.php" method="get"><input name="s" type="text" size="9" maxlength="30">
                </form>
            </div>
        </div>
