<!DOCTYPE html>
<html lang="en">
    <head>
			<title>jQuery UI Datepicker - Select a Date Range</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script>
  $(function() {
    $( "#from" ).datepicker({
      defaultDate: "+1w",
      changeMonth: true,
      numberOfMonths: 1,
      onClose: function( selectedDate ) {
        $( "#to" ).datepicker( "option", "minDate", selectedDate );
      }
    });
    $( "#to" ).datepicker({
      defaultDate: "+1w",
      changeMonth: true,
      numberOfMonths: 1,
      onClose: function( selectedDate ) {
        $( "#from" ).datepicker( "option", "maxDate", selectedDate );
      }
    });
  });
  </script>
        <link rel="stylesheet" type="text/css" href="st1.css">    <link rel="stylesheet" type="text/css" href="lightview.css">
            
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
                <style></style>
                
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
                        <li><a href="search.php">GROUPS</a></li>

                        <li><a href="new_index.html">LOGOUT</a></li>
                    </ul>
                </div>
                <div id="search_form"><form action="/search.php" method="get"><input name="s" type="text" size="9" maxlength="30">
                    </form>
                </div>
            </div>
          
            
            
            
            
            
            
            <div id="cuerpo">
                <div id="up_izq"><h3>GALLERY</h3></div>
                
			   <div id="nav">
                 <ul>
                     <li><a href="javascript:void(0);"
                         NAME="My Window Name"  title=" My title here "
                         onClick=window.open("manageGroup.php","Ratting","width=550,height=700,0,status=0,scrollbars=1");>--Manage Groups--</a></li>
                          
                 </ul>
            </div>                
                
                
                <div id="up_der"><form id="gform" action="/search.php/" method="get" name="jumpto"><select name="c" onchange="javascript: submit();"><option value="0">Frequent</option><option value="1">Most Recent</option><option value="2">Oldest</option></select></form></div>
            </div>
            
            
            
            <div>
                <img src="getImage.php?id=1" width="175" height="200" />
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