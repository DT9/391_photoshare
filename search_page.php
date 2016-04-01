
<?php
function rebuild($conn) {
$a = "alter index SUBJECT_INDEX rebuild ";
$b = "alter index DESC_INDEX rebuild ";
$c = "alter index PLACE_INDEX rebuild ";
$stid = oci_parse($conn, $a);	    
$res=oci_execute($stid);
$stid = oci_parse($conn, $b);	    
$res=oci_execute($stid);
$stid = oci_parse($conn, $c);	    
$res=oci_execute($stid);
}
//GG
//http://stackoverflow.com/questions/24895170/multiple-image-upload-php-form-with-one-input

//http://php.net/manual/en/function.oci-connect.
include("connection_database.php");
include("scaleimage.php");
echo "<center>Hello World!</center><br/>";
session_start();

$from = $_REQUEST['from'];
$to = $_REQUEST['to'];
$keysearch = $_REQUEST['keysearch'];
$orderbytime= $_REQUEST['c'];
//get single word for keysearch
echo $keysearch;
$arr=str_replace(' ', '&', $keysearch);




echo "from date = $from";
echo "to date = $to";
echo "Keyword = $arr ";
echo "orderbytime is = $orderbytime ";


$querie_true='True'; 

//if all empty, no search
if (empty($arr)&&empty($from)&&empty($to)){
	echo "empty";
	$querie_true='False'; 


	//redirect back
	}
	
//if there is a keyword
elseif (!empty($arr)){
	//all parts 
	if(!empty($from)&&!empty($to)){
		if ($orderbytime=='1'){
			$sql='select photo_id from images where 
				(CONTAINS(subject, \''.$arr.'\', 1)>0 
				or CONTAINS(place, \''.$arr.'\', 2)>0
				or CONTAINS(description, \''.$arr.'\', 3)>0) and timing between \''.$from.'\' and \''.$to.'\' order by timing desc';}
				
		elseif($orderbytime=='2'){
			$sql='select photo_id from images where 
				(CONTAINS(subject, \''.$arr.'\', 1)>0 
				or CONTAINS(place, \''.$arr.'\', 2)>0
				or CONTAINS(description, \''.$arr.'\', 3)>0) and timing between \''.$from.'\' and \''.$to.'\' order by timing desc';}
		else{		
			$sql='select photo_id from images where 
				(CONTAINS(subject, \''.$arr.'\', 1)>0 
				or CONTAINS(place, \''.$arr.'\', 2)>0
				or CONTAINS(description, \''.$arr.'\', 3)>0) and timing between \''.$from.'\' and \''.$to.'\'
				order by (rank() over (order by(6*score(1)+3*score(2)+score(3)) desc))';}	
		echo "all parts";
	}
	
	//only subject
	else if(empty($from)&&empty($to)){
		echo "only subject";
		if ($orderbytime=='1'){	
					$sql='select photo_id from images where 
				CONTAINS(subject, \''.$arr.'\', 1)>0
				or CONTAINS(place, \''.$arr.'\', 2)>0
				or CONTAINS(description, \''.$arr.'\', 3)>0 order by timing desc';
		}
		
		elseif ($orderbytime=='2'){
			$sql='select photo_id from images where 
				CONTAINS(subject, \''.$arr.'\', 1)>0
				or CONTAINS(place, \''.$arr.'\', 2)>0
				or CONTAINS(description, \''.$arr.'\', 3)>0 order by timing asc';		
			}
		else{									
			$sql='select photo_id from images where 
				CONTAINS(subject, \''.$arr.'\', 1)>0
				or CONTAINS(place, \''.$arr.'\', 2)>0
				or CONTAINS(description, \''.$arr.'\', 3)>0
				order by (rank() over
				(order by(6*score(1)+3*score(2)+score(3)) desc))';
			}
		
		}
	
	//subject and to only	
	elseif (empty($from)){
		echo "subject and to only";	
		if ($orderbytime=='1'){
			$sql='select photo_id from images where 
				(CONTAINS(subject, \''.$arr.'\', 1)>0
				or CONTAINS(place, \''.$arr.'\', 2)>0
				or CONTAINS(description, \''.$arr.'\', 3)>0) 
				and timing between (select min(timing) from images) and \''.$to.'\' order by timing desc';
				}		
		elseif ($orderbytime=='2'){$sql='select photo_id from images where 
				(CONTAINS(subject, \''.$arr.'\', 1)>0
				or CONTAINS(place, \''.$arr.'\', 2)>0
				or CONTAINS(description, \''.$arr.'\', 3)>0) 
				and timing between (select min(timing) from images) and \''.$to.'\' order by timing asc';
				}
		else{
			$sql='select photo_id from images where 
				(CONTAINS(subject, \''.$arr.'\', 1)>0
				or CONTAINS(place, \''.$arr.'\', 2)>0
				or CONTAINS(description, \''.$arr.'\', 3)>0) 
				and timing between (select min(timing) from images) and \''.$to.'\'
				order by (rank() over (order by(6*score(1)+3*score(2)+score(3)) desc))';
				}
		
	}
	//subject and from only
	else{ 
		if ($orderbytime=='1'){
			$sql='select photo_id from images where 
				(CONTAINS(subject, \''.$arr.'\', 1)>0
				or CONTAINS(place, \''.$arr.'\', 2)>0
				or CONTAINS(description, \''.$arr.'\', 3)>0) and timing between \''.$from.'\' and sysdate order by timing desc';}
		elseif($orderbytime=='2'){
			$sql='select photo_id from images where 
				(CONTAINS(subject, \''.$arr.'\', 1)>0
				or CONTAINS(place, \''.$arr.'\', 2)>0
				or CONTAINS(description, \''.$arr.'\', 3)>0) and timing between \''.$from.'\' and sysdate order by timing asc';}
		else{
			$sql='select photo_id from images where 
				(CONTAINS(subject, \''.$arr.'\', 1)>0
				or CONTAINS(place, \''.$arr.'\', 2)>0
				or CONTAINS(description, \''.$arr.'\', 3)>0) and timing between \''.$from.'\' and sysdate
				order by (rank() over (order by(6*score(1)+3*score(2)+score(3)) desc))';}	
		echo "subject and from only";
	}
}

//else if all date part no subject
elseif (!empty($from)&&!empty($to)){
	if ($orderbytime=='1'){
		$sql='select photo_id from images where timing between \''.$from.'\' and \''.$to.'\' order by timing desc';
		}
	elseif ($orderbytime=='2'){
		$sql='select photo_id from images where timing between \''.$from.'\' and \''.$to.'\' order by timing asc';	
	}
	else{
		$sql='select photo_id from images where timing between \''.$from.'\' and \''.$to.'\'';	
	}
	//$sql1='select count(photo_id) from images where timing between \''.$from.'\' and \''.$to.'\'';	
	echo "all date no subject";
	}
	
//else if from date entered only
elseif (empty($to)){
	if ($orderbytime=='1'){
		$sql=	'select photo_id from images where timing between \''.$from.'\' and sysdate order by timing desc';	
		}
	elseif ($orderbytime=='2'){
		$sql= 'select photo_id from images where timing between \''.$from.'\' and sysdate order by timing asc';	
		}
	else {$sql=	'select photo_id from images where timing between \''.$from.'\' and sysdate';	}
	echo "date from only";
	}
	
//else, if to date empty 
else {
	if ($orderbytime=='1'){
		$sql=	'select photo_id from images where timing between (select min(timing) from images) and \''.$to.'\' order by timing desc';	
		}
	elseif ($orderbytime=='2'){
		$sql= 'select photo_id from images where timing between (select min(timing) from images) and \''.$to.'\' order by timing asc';
		}
	else {
	$sql= 'select photo_id from images where timing between (select min(timing) from images) and \''.$to.'\'';	
	}
	echo "date to only";}


echo $sql;
echo "number of pics: $sql1";

     $conn = connect();   
     rebuild($conn);
if ($querie_true=='True'){
if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

	    $stid = oci_parse($conn, $sql);
	    
	    //Execute a statement returned from oci_parse()
	    $res=oci_execute($stid);
	    
	    while ($row=oci_fetch_array($stid,OCI_BOTH)){
	    	$r= $row['PHOTO_ID'];
	    	//echo "r is $r";
	    	echo '<a href="display.php?id='.$r.'"><img src="pullimage.php?id='.$r.'&type=thumbnail" width="175" height="200" /></a>';
	    
	    
	    
	    }
	    
	    rebuild($conn);
	    oci_free_statement($stid);
	    oci_close($conn);
}

?>

<html>
<INPUT TYPE="button" VALUE="Back" onClick="history.go(-1);">

</html>