
<?php
//GG
//http://stackoverflow.com/questions/24895170/multiple-image-upload-php-form-with-one-input
//http://php.net/manual/en/function.oci-connect.php
$servername = "localhost";
$username = "chengyao";
$password = "chengyao00308900";
// Connects to the XE service (i.e. database) on the "localhost" machine
$conn = oci_connect($username,$password, $servername);
if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

$stid = oci_parse($conn, 'SELECT * FROM employees');
oci_execute($stid);

echo "<table border='1'>\n";
while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
    echo "<tr>\n";
    foreach ($row as $item) {
        echo "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
    }
    echo "</tr>\n";
}
echo "</table>\n";


extract($_POST);
    $error=array();
    $extension=array("jpeg","jpg","png","gif");
    foreach($_FILES["files"]["tmp_name"] as $key=>$tmp_name)
            {
                $file_name=$_FILES["files"]["name"][$key];
                $file_tmp=$_FILES["files"]["tmp_name"][$key];
                $ext=pathinfo($file_name,PATHINFO_EXTENSION);
                if(in_array($ext,$extension))
                {
                    if(!file_exists("photo_gallery/".$txtGalleryName."/".$file_name))
                    {
                        move_uploaded_file($file_tmp=$_FILES["files"]["tmp_name"][$key],"photo_gallery/".$txtGalleryName."/".$file_name);
                    }
                    else
                    {
                        $filename=basename($file_name,$ext);
                        $newFileName=$filename.time().".".$ext;
                        move_uploaded_file($file_tmp=$_FILES["files"]["tmp_name"][$key],"photo_gallery/".$txtGalleryName."/".$newFileName);
                    }
                }
                else
                {
                    array_push($error,"$file_name, ");
                }
            }

?> 