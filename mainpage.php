<!DOCTYPE html>

<html lang="en">

<head>

    <link rel="stylesheet" type="text/css" href="st1.css">
    <link rel="stylesheet" type="text/css" href="lightview.css">
    <script src="https://code.jquery.com/jquery-2.2.2.min.js"></script>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <style></style>  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">


</head>

<body>
    <div id="contenedor">

        <div id="cabecera">
            <div id="logo">

                <h1><a id="top" href="mainpage.php">PHOTOSHARE</a></h1>
            </div>
            <div id="nav">
                <ul>
                    <li><a href="mainpage.php">HOME</a></li>
                    <li><a href="profilepage.php">PROFILE</a></li>
                   <li><a href="documentation/documentation_sample.html">HELP</a></li>
                    <li><a href="logout.php">LOGOUT</a></li>
                </ul>
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
                <select name="c"><option value="0">Frequent</option><option value="1">Most Recent</option><option value="2">Oldest</option></select>
                <br>
            	<input type="submit"></p>
            	
     </form>


        <div id="cuerpo">
            <div id="up_izq">
                <h3>GALLERY</h3></div>
            <div id="up_der">
                <form id="gform" action="thumb.php" method="get" name="jumpto">
                    <select name="c" onchange="javascript: fivethumbs(this.value);">
                    <option value="1">Oldest</option>
                    <option value="2">Most Recent</option>
                    <option value="3">Top Five</option>
                </select></form>
            </div>
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
            fivethumb("main=true");            
            function fivethumbs(str) {
                $("#chickenbutt").html("");
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        var txt = xmlhttp.responseText;
                        $("#chickenbutt").html(txt);
                    }
                };
                var thumb = "thumb.php";
                if (location.search) thumb += location.search + "&option=" + str;
                else {
                    thumb += "?option=" + str;
                }
                xmlhttp.open("GET", thumb, true);
                xmlhttp.send();
            };
            $('#from').datepicker({ dateFormat: 'dd-M-y' });
            $('#to').datepicker({ dateFormat: 'dd-M-y' });
            //popularity of an image is specified by the number of distinct users that have ever viewed the image
        </script>


        <div id="chickenbutt">

        </div>




        <div id="pie">



            <div id="pie_l">
                <ul>
                    <li><a href="mainpage.php">HOME</a></li>
                </ul>
            </div>
            <div id="pie_r">
                <a href="#">UP <span class="up">↑</span></a>
            </div>
        </div>




    </div>

</body>

</html>
