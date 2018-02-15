<?php
 
 function cleaning($data)
{
    $data = trim($data);
    $data = htmlentities($data);
    $data = strip_tags($data);
    return $data;
}
	$db_host = "localhost";
    $db_user = "rackatac_manage";
    $db_pass = "rat2018";
    $db_name = "rackatac_rackatack";
 /*
    $db_host = "localhost";
    $db_user = "junodr_mzr";
    $db_pass = "mzr2017";
    $db_name = "junodr_rackatack";
 */
//echo ("MySQL connect ==>" . $db_host . ", " . $db_user . ", " . $db_pass . ", " . $db_name);
 
$dbc = new mysqli($db_host, $db_user, $db_pass, $db_name);
/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
?>