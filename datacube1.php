<?php
include("connection_database.php");
$conn=connect();

// get the q parameter from URL
$user = $_REQUEST["user"];
$subj = $_REQUEST["subj"];
$date = $_REQUEST["date"];
$tdate = $date;
$s = " select ";
$g = " group by ";
$w = " where ";

//User
if ($user == "All") {
	$s.= " i.owner_name, ";
	$g.= " i.owner_name, ";
}
elseif ($user == "None"){

}
else {
	$s.= " i.owner_name, ";
	$g.= " i.owner_name, ";
	$w.= " i.owner_name = '".$user."' and ";
}
//Subject
if ($subj == "All") {
	$s.= " i.subject, ";
	$g.= " i.subject, ";
}
elseif ($subj == "None"){

}
else {
	$s.= " i.subject, ";
	$g.= " i.subject, ";
	$w.= " i.subject = '".$subj."' and";
}
//Date
if ($date == "Year") {
	$s .= ' EXTRACT(YEAR from i.timing) as tyear,';
	$g .= ' EXTRACT(YEAR from i.timing) ,';
}
elseif ($date == "Month") {
	$s .= ' to_char(i.timing,\'MON\') as tmonth,';
	$g .= ' to_char(i.timing,\'MON\') ,';	
}
elseif ($date == "Week") {
	$s .= ' to_char(i.timing,\'IW\') as tweek,';
	$g .= ' to_char(i.timing,\'IW\') ,';	
}
else {

}

$g = rtrim($g," ,");
$w = rtrim($w," and");
$w = rtrim($w," where");

$stp.= $s.' count(i.photo_id) as image_count ';
$stp.= " from images i ";
$stp.= $w;
$stp.= $g;

print_r($stp."<br>");

$stid = oci_parse($conn,$stp);
$res = oci_execute($stid);

echo '<TABLE class="table table-bordered"><TR valign=top align=left>
		<td>Owner Name </td><td>Subject</td><td>Period '.$tdate."</td><td>Image Count</td>
	</tr>";

while (($row = oci_fetch_array($stid, OCI_ASSOC))) {
	echo "<TR valign=top align=left>";
	if (isset($row["OWNER_NAME"])) {
		echo "<td>".$row["OWNER_NAME"]."</td>";
	}
	else {
		echo "<td> NONE </td>";
	}
	if (isset($row["SUBJECT"])) {
		echo "<td>".$row["SUBJECT"]."</td>";
	}
	else {
		echo "<td> NONE </td>";
	}
	if (isset($row["TYEAR"])) {
		echo "<td>".$row["TYEAR"]."</td>";
	}
	if (isset($row["TMONTH"])) {
		echo "<td>".$row["TMONTH"]."</td>";
	}
	if (isset($row["TWEEK"])) {
		echo "<td>".$row["TWEEK"]."</td>";
	}
	if ($tdate == "None" ) {
		echo "<td> NONE </td>";
	}

	echo "<td>".$row["IMAGE_COUNT"]."</td>";
	echo "</tr>";

}
echo "</TABLE>";
?>
