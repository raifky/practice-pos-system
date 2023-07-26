<!-- insert -->
<?php
include 'configdua.php';

if(isset($_POST['masuk'])) {

$nama_penjaga = $_POST['penjaga'];
$barang = $_POST['country'];
$harga = $_POST['harga'];
// $data_barang = $_POST['data'];
$j_terjual = $_POST['terjual'];

$results = mysqli_query($con, "INSERT INTO data_transaksi(penjaga, country, harga, terjual) VALUES('$nama_penjaga', '$barang', '$harga', '$j_terjual')");

if($results) {

    // $sukses;
    $_SESSION['success'] = "Berhasil";
   // echo "user added successfully";
   header("Location: transaksi.php?msg= Data Update successfully");
}
else{
    echo "Failed " . mysqli_error($connection);
}
}

?>

<!-- select country -->
$sql = "SELECT data_transaksi.*, data_barang.*
         FROM data_transaksi
         JOIN data_barang ON data_transaksi.country = data_barang.id
         ORDER BY data_transaksi.tanggal DESC;
         ";
      $transaksi = $connection->query($sql);