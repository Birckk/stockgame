<?php 
 /*
min connect
*/
$host = "localhost";
$username = "root";
$password = "";
$dbname = "stock";
 
// lav connection
$connect = new mysqli($host, $username, $password, $dbname);
 
// check connection
if($connect->connect_error) {
    die("Connection Failed : " . $connect->error);
} else {
    // echo "Successfully Connected";   
}
 
?>