<?php
//http://stackoverflow.com/questions/7793009/how-to-retrieve-images-from-mysql-database-and-display-in-an-html-tag

  $id = $_GET['id'];
  // do some validation here to ensure id is safe
include("connection_database.php");
$conn=connect();

  $sql = "SELECT thumbnail FROM images WHERE photo_id=$id";
  $stid = oci_parse($conn,$sql);
$res = oci_execute($stid);
$row = oci_fetch_array($stid, OCI_ASSOC);

  header("Content-type: image/jpeg");
  echo $row['thumbnail'];


?>