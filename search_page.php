
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
$arr = explode(' ', trim($keysearch));
//$arrfrom = explode(' ', trim($from));
$num=count($arr);
echo $num;

echo "from date = $from";
echo "to date = $to";
echo "Keyword = $arr[2]";




//if all empty, no search
if (empty($arr[0])&&empty($from)&&empty($to)){
	echo "empty";
	//redirect back
	}
//else if date part empty
elseif (!empty($arr[0])){
	//all parts 
	if(!empty($from)&&!empty($to)){
	$sql='select photo_id from images where timing between \''.$from.'\' and \''.$to.'\'';	
	echo "all parts";
	}
	elseif(empty($from)&&empty($to)){echo "only subject";}
	//subject and to only
	elseif (empty($from)){
	echo "subject and to only";	
	}
	//subject and from only
	else{ echo "subject and from only";}
}
//else if all date part no subject
elseif (!empty($from)&&!empty($to)){
	$sql='select photo_id from images where timing between \''.$from.'\' and \''.$to.'\'';	
	echo $sql;
	echo "all date no subject";}
//else if from date entered only
elseif (empty($to)){echo "date from only";}
//else, if to date empty 
else {echo "date to only";}




     $conn = connect();   

if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

$sql= 


      oci_close($conn);

?>
