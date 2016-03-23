<?php
include("connection_database.php");
$conn=connect();

function getres($sql,$conn) {
    $stid = oci_parse($conn,$sql);
    $res = oci_execute($stid);
    while (($row = oci_fetch_array($stid, OCI_ASSOC))) {
        foreach($row as $item)   {
            echo '<option>'.$item.'</option>';
        }
    }
}

 
getres("select * from images",$conn);
                                 

?>