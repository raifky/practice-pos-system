<?php
include "config.php";
$id = $_GET['id'];

$sql = "DELETE FROM data_transaksi WHERE country = (SELECT id FROM data_barang WHERE id = $id)";
$sql5 = "DELETE FROM data_barang WHERE id = $id";

$result = mysqli_query($con, $sql);
$results = mysqli_query($con, $sql5);
if (!$result || !$results) {
    echo "Failed: " . mysqli_error($con);
} else {
    echo "Data deleted successfully.";
}

header('Location: databarang.php');
exit;
?>
