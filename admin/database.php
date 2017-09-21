<?php
/**
 * Created by PhpStorm.
 * User: Gino
 * Date: 19-12-2016
 * Time: 13:44
 */
//database opvragen
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "ankerstuy_test";//verf_test
$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

if(mysqli_connect_errno()) {
    die("database query failed: " .
        mysqli_connect_error() .
        " (" . mysqli_connect_errno() . ")"
    );
}
?>