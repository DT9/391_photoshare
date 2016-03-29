
<?php
//GG
//http://stackoverflow.com/questions/24895170/multiple-image-upload-php-form-with-one-input

//http://php.net/manual/en/function.oci-connect.
include("connection_database.php");
include("scaleimage.php");
echo "<center>Hello World!</center><br/>";

$from = $_REQUEST['from'];
$to = $_REQUEST['to'];
$keysearch = $_REQUEST['keysearch'];

//get single word for keysearch
echo $keysearch;
$arr=str_replace(' ', '&', $keysearch);
//$arr = explode(' ', trim($keysearch));
//$arrfrom = explode(' ', trim($from));


echo "from date = $from";
echo "to date = $to";
echo "Keyword = $arr ";




//if all empty, no search
if (empty($arr[0])&&empty($from)&&empty($to)){
	echo "empty";
	//redirect back
	}
	
	
//else if date part empty
elseif (!empty($arr[0])){
	//all parts 
	if(!empty($from)&&!empty($to)){
		$sql='select photo_id from images where CONTAINS(subject, \''.$arr.'\', 1)>0 and timing between \''.$from.'\' and \''.$to.'\'';	
		echo "all parts";
	}
	
	//only subject
	elseif(empty($from)&&empty($to)){
		$sql='select photo_id from images where CONTAINS(subject, \''.$arr.'\', 1)>0';
		echo "only subject";
		}
		
	//subject and to only	
	elseif (empty($from)){
		$sql='select photo_id from images where CONTAINS(subject, \''.$arr.'\', 1)>0 and timing between (select min(timing) from images) and \''.$to.'\'';
		echo "subject and to only";
			
	}
	//subject and from only
	else{ 
		$sql='select photo_id from images where CONTAINS(subject, \''.$arr.'\', 1)>0 and timing between \''.$from.'\' and sysdate';	
		echo "subject and from only";}
}

//else if all date part no subject
elseif (!empty($from)&&!empty($to)){
	$sql='select photo_id from images where timing between \''.$from.'\' and \''.$to.'\'';	
	$sql1='select count(photo_id) from images where timing between \''.$from.'\' and \''.$to.'\'';	
	echo "all date no subject";
	}
	
//else if from date entered only
elseif (empty($to)){
	
	$sql=	'select photo_id from images where timing between \''.$from.'\' and sysdate';	
	echo "date from only";
	}
	
//else, if to date empty 
else {
	$sql= 'select photo_id from images where timing between (select min(timing) from images) and \''.$to.'\'';	
	echo "date to only";}


echo $sql;
echo "number of pics: $sql1";

     $conn = connect();   

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
	    
	    
	    oci_free_statement($stid);
	    oci_close($conn);


?>
