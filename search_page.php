
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

$arr = explode(' ', trim($keysearch));



echo "from date = $from";
echo "to date = $to";
echo "Keyword = $arr[3]";

     $conn = connect();   

if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

 





      oci_close($conn);

?>
