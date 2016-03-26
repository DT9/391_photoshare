<?php
include("connection_database.php");
$conn=connect();

// get the q parameter from URL
$user = $_REQUEST["user"];
$subj = $_REQUEST["subj"];
$date = $_REQUEST["date"];
$tdate = $date;
//User
if ($user == "All") {
	$user = "is null";
}
elseif ($user == "None"){
	$user = "is not null";
}
//Subject
if ($subj == "All") {
	$subj = "is null";
}
elseif ($subj == "None"){
	$subj = "is not null";
}
//Date
if ($date == "Year") {
	$date = "tyear is not null and tmonth is null and tWeek is null";
}
elseif ($date == "Month") {
	$date = "tyear is null and tmonth is not null and tWeek is null";
}
elseif ($date == "Week") {
	$date = "tyear is null and tmonth is null and tWeek is not null";
}
else {
	$date = "tyear is null and tmonth is null and tWeek is null";
}

$stp = "SELECT distinct owner_name,subject,tYear,tMonth,tWeek,image_count
		FROM data_cube 
		where owner_name ".$user.
		" and subject ".$subj.
		" and ".$date;

print_r($stp."<br>");

$stid = oci_parse($conn,$stp);
$res = oci_execute($stid);

echo '<TABLE class="table table-bordered"><TR valign=top align=left>
		<td>Owner Name </td><td>Subject</td><td>Period '.$tdate."</td><td>Image Count</td>
	</tr>";

while (($row = oci_fetch_array($stid, OCI_ASSOC))) {
	print_r($row);
	print_r("<br>");
	echo "<TR valign=top align=left>";
	if (isset($row["OWNER_NAME"])) {
		echo "<td>".$row["OWNER_NAME"]."</td>";
	}
	else {
		echo "<td> ALL </td>";
	}
	if (isset($row["SUBJECT"])) {
		echo "<td>".$row["SUBJECT"]."</td>";
	}
	else {
		echo "<td> ALL </td>";
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
	if ($tdate == "None") {
		echo "<td> ALL </td>";
	}

	echo "<td>".$row["IMAGE_COUNT"]."</td>";
	echo "</tr>";
}
echo "</TABLE>";
/*
where owner_name= " + user
							+ " and subject =" + subj
							+ " and tyear is null";
   photo_id    int,
   owner_name  varchar(24),
   permitted   int,
   subject     varchar(128),
   place       varchar(128),
   timing      date,
   description varchar(2048),
   thumbnail   blob,
   photo       blob,

   while (($row = oci_fetch_array($stid, OCI_ASSOC))) {
	print_r($row);
	echo "<TR valign=top align=left>";
	if (isset($row["OWNER_NAME"])) {
		echo "<td>".$row["OWNER_NAME"]."</td>";
	}
	else {
		echo "<td> ALL </td>";
	}
	if (isset($row["SUBJECT"])) {
		echo "<td>".$row["SUBJECT"]."</td>";
	}
	else {
		echo "<td> ALL </td>";
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
	if ($tdate == "None") {
		echo "<td> ALL </td>";
	}

	echo "<td>".$row["IMAGE_COUNT"]."</td>";
	echo "</tr>";
}
echo "</TABLE>";

Morris.Area({
                element: 'morris-area-chart',
                data: [{
                    period: '2011 W1',
                    user:4
                }, {
                    period: '2010 Q2',
                    user:9
                }],
                xkey: 'period',
                ykeys: ['user'],
                labels:['name'],
                pointSize: 2,
                hideHover: 'auto',
                resize: true
            });

*/
?> 
