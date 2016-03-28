<!DOCTYPE html>
<html lang="en">

<head>

    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="st1.css">
    <link rel="stylesheet" type="text/css" href="lightview.css">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <style></style>

</head>
<style type="text/css">
    #chickenbutt {}
</style>

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
            <div id="search_form">
                <form action="search.php" method="get"><input name="s" type="text" size="9" maxlength="30">
                </form>
            </div>
        </div>
  <script>
  $(function() {
    $( "#datepicker" ).datepicker();
  });
  </script>
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
                xmlhttp.open("GET", "thumb.php?freq=" + str, true);
                xmlhttp.send();
            };
        </script>


        <div id="chickenbutt" class="text-center"><br>
          <?php
					$id = $_GET['id'];
					include("connection_database.php");
					$conn=connect();

          if (isset($_POST['action'])) {
            if (isset($_POST['delete'])) {
              $query = "delete FROM images where photo_id = $id";
              $stmt = oci_parse ($conn, $query);
              oci_execute($stmt);
              header("Location: mainpage.html?delete=true");
            }
            elseif (isset($_POST['edit'])) {
              $query = "UPDATE images SET ";
              if (isset($_POST['subj'])) $query.= " subject = '$_POST['subj']'";
              if (isset($_POST['date'])) $query.= " timing = '$_POST['date']'";
              if (isset($_POST['place'])) $query.= " place = '$_POST['place']'";
              if (isset($_POST['desc'])) $query.= " description = '$_POST['desc']'";
              if (isset($_POST['group'])) $query.= " permitted = '$_POST['group']'";
              $query.=" WHERE photo_id='$id' ";
              $stmt = oci_parse ($conn, $query);
              oci_execute($stmt);
              echo "UPDATED";
            }
          }


					$query = "SELECT * FROM images where photo_id = $id";
					$stmt = oci_parse ($conn, $query);
					oci_execute($stmt);
					$arr = oci_fetch_array($stmt, OCI_ASSOC);
					echo '<img src="pullimage.php?id='.$id.'&type=photo" />';
					//oci_close($conn);
                    $sql = "select * from group_lists g,images i,groups s where i.photo_id = ".$id." and g.friend_id = i.owner_name and s.group_id = g.group_id and g.group_id != 1 and g.group_id != 2";
                    $fin  = "";
				    $stid = oci_parse($conn,$sql);
				    $res = oci_execute($stid);
				    while (($row = oci_fetch_array($stid, OCI_ASSOC))) {
                        $selected = "";
                        if ($arr[$id] == $res['GROUP_ID']) {$selected = "selected";}
				        $fin.='<option value="'.$row['GROUP_ID'].'" '.$selected.'>'.$row['GROUP_NAME'].'</option>';
				    }

				?>
        </div>
        <div id="update">
            <form action="">
				<fieldset class="form-group" >
                <label for="exampleTextarea">Subject</label>
                <textarea class="form-control" name="subj" rows="1"
                    placeholder='<?php echo $arr["SUBJECT"];?>'></textarea>
                </fieldset>
               	<fieldset class="form-group" >
                <label for="exampleTextarea">Place</label>
                <textarea class="form-control" name="place" rows="1"
                    placeholder='<?php echo $arr["PLACE"];?>'></textarea>
                </fieldset>
               	<fieldset class="form-group" >
                <label for="exampleTextarea">Timing/When</label>
                <input class="form-control date" name="date" rows="1"
                    placeholder='<?php echo $arr["TIMING"];?>'></input>
                </fieldset>

                <fieldset class="form-group" >
                <label for="exampleTextarea">Description</label>
                <textarea class="form-control" name="desc" rows="3"
                    placeholder='<?php echo $arr["DESCRIPTION"];?>'></textarea>
                </fieldset>
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <div class="">
                    <label>
				      Permitted
				    </label>
				    <select class="c-select" name="group">
                        <option value="1">Public</option>
                        <option value="2">Private</option>
				        <?php echo $fin; ?>
					</select>
                </div>
                <button type="submit" name="edit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        <form action="">
          <button type="submit" name="delete" class="btn btn-primary">Delete Photo</button>
        </form>


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
