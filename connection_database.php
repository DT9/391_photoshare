<?php
function connect(){
	$conn = oci_connect('dtruong1', 'hunter23');
	if (!$conn) {
		$e = oci_error();
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}
	return $conn;
}
?>
