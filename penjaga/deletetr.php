<?php
include "configtr.php";
$id = $_GET['id'];
$sql = "DELETE FROM `data_transaksi` WHERE id = '$id'";
$result = mysqli_query($connection, $sql);
if (!$result) {
    echo "Failed: " . mysqli_error($connection);
}

header('Location: transaksi.php');
?>
