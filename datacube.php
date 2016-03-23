<?php
include("connection_database.php");
$conn=connect();

// get the q parameter from URL
$user = $_REQUEST["user"];
$subj = $_REQUEST["subj"];
$date = $_REQUEST["date"];
$sql = "select ";
$select = " ";
$from = " ";
$where = " ";
$group = " ";
//User
if ($user == "All") {
	$sql.=" owner_name ";
}
else {
	$sql.="";
}
//Subject
if ($subj == "All") {
	$sql.="subject";
}
else{
	$sql.="";
}
//Date
if ($date == "Year") {
	$sql.="";
}
elseif ($date == "Month") {
	$sql.="";
}
elseif ($date == "Day") {
	$sql.="";
}
else {}

$sql.=" from images where ";


$sql.=" group by ";

$stp = "select owner_name,subject,timing,count(*) from images group by cube(owner_name,subject,timing)";

$stid = oci_parse($conn,$stp);
$res = oci_execute($stid);
while (($row = oci_fetch_array($stid, OCI_ASSOC))) {
	echo "<tr>";
	foreach($row as$item) 	{
		echo "<td>".$item."</td>";
	}
	echo "</tr>";
}

/*
   photo_id    int,
   owner_name  varchar(24),
   permitted   int,
   subject     varchar(128),
   place       varchar(128),
   timing      date,
   description varchar(2048),
   thumbnail   blob,
   photo       blob,
*/
?> 