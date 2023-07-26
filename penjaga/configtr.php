<?php
$server = "localhost";
$user = "root";
$pw = "";
$db = "koperasi";
$usertable = "data_barang";
$tableharga = "data_barang";


$connection = new mysqli($server,$user,$pw, $db);


if ($connection->connect_error) {
   die("Connection failed: " . $connection->connect_error);
 }
 //echo "Connected successfully";
 $sql = "SELECT * FROM $usertable";
 $result = $connection->query($sql);
?>