<?php

include '../log/konek.php';

require '../log/auth.php';
checkLoginSessionValidity();



?>
<?php
  include '../config/configurasi.php';

  $total_semua_barang= "SELECT COUNT(*) AS total_rows
  FROM
  (
      SELECT data_transaksi.*, data_barang.id AS barang_id, data_barang.tanggal AS barang_tanggal, data_barang.pemilik, 
          data_barang.stock_awal, data_barang.potongan, data_barang.harga AS barang_harga,
          SUM(data_transaksi.terjual) AS total_terjual, data_barang.stock_awal - SUM(data_transaksi.terjual) AS sisa_stock,
          data_transaksi.harga AS transaksi_harga,
          SUM(data_barang.harga * data_transaksi.terjual) AS total,
          SUM(data_barang.harga * data_transaksi.terjual DIV data_barang.potongan) AS Revenue,
          SUM(data_barang.harga * data_transaksi.terjual - data_barang.harga * data_transaksi.terjual DIV data_barang.potongan) AS 'Total Diterima'
      FROM data_transaksi
      INNER JOIN data_barang ON data_transaksi.country = data_barang.id
      GROUP BY barang_tanggal, data_barang.pemilik, data_transaksi.country, data_barang.stock_awal, data_barang.potongan, transaksi_harga
  ) AS subquery;";
  $barang = $configurasi->query($total_semua_barang);
  $data_koperasi = $barang->fetch_row();
  /*$total_barang = $configurasi->query("SELECT COUNT(db.country) AS tot FROM data_barang AS db INNER JOIN data_transaksi AS dt ON db.country=dt.country");
  $barang = $total_barang->fetch_row();*/

?>
<?php
  include '../penjaga/configtr.php';
  
  $total_transaksi = $connection->query("SELECT COUNT(id) AS total FROM data_transaksi");
  $transaction = $total_transaksi->fetch_row();
?>
<?php
  include '../barangharga/config.php';

  $total_list_barang = $con->query("SELECT COUNT(id) AS total FROM data_barang");
  $barang_harga = $total_list_barang->fetch_row();
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/admin.css">
    <script src="https://kit.fontawesome.com/e168c97215.js" crossorigin="anonymous"></script>
    <title>Dashboard</title>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-warning fixed-top">
        <a class="navbar-brand" href="dashboard.php">HELLO ADMIN | <b></b></a>
          <form class="form-inline my-2 my-lg-0 ml-auto">
            <!-- <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button> -->
          </form>
          <div class="icon ml-4">
            <h5>
              <!-- <i class="fas fa-envelope mr-3" data-toggle="tooltip" title="Inbox"></i> -->
              <!-- <i class="fas fa-bell mr-3" data-toggle="tooltip" title="Notification"></i> -->
              
              <a href="../log/logout.php"><i class="fas fa-sign-out-alt mr-3" data-toggle="tooltip" title="Log Out"></i></a>
            </h5>

          </div>
        </div>
      </nav>

      <div class="row mt-5">
        <div class="col-md-2,5 bg-dark mt-2 pr-3 pt-4">
          <ul class="nav flex-column ml-3 mb-5">
            <li class="nav-item">
              <a class="nav-link active text-white" href="dashboard.php"><i class="fas fa-tachometer-alt mr-2"></i>Dashboard</a><hr class="bg-secondary">
            </li>
            <?php 
            $level = $_SESSION['level'] == 'admin';
            if ($level){
             ?>
            <li class="nav-item">
              <a class="nav-link text-white" href="listroom.php"><i class="fas fa-money-check mr-2"></i>Data Koperasi</a><hr class="bg-secondary">
            </li>
            <?php } ?>
            <li class="nav-item">
              <a class="nav-link text-white" href="../penjaga/transaksi.php"><i class="fas fa-money-check mr-2"></i>Transaksi Koperasi</a><hr class="bg-secondary">
            </li>
            <?php 
            $level = $_SESSION['level'] == 'admin';
            if ($level){
             ?>
            <li class="nav-item">
              <a class="nav-link text-white" href="../barangharga/databarang.php"><i class="fas fa-money-check mr-2"></i>Data Barang</a><hr class="bg-secondary">
            </li>
            <?php } ?>
          </ul>

        </div>
        <div class="col-md-10 p-5 pt-2">
        <h3><i class="fas fa-tachometer-alt"></i>Dashboard</h3><hr>
       
        <?php 
            $level = $_SESSION['level'] == 'admin';
            if ($level){
             ?>
        <div class="row text-white">
          <div class="card bg-info ml-5" style="width: 19rem;">
            <div class="card-body" style="width: 10rem;">
             <div class="card-body-icon">
               <i class="fas fa-money-check mr-4"></i>
              </div>
              <h5 class="card-title">Data Koperasi</h5>
              <div class="display-4">
                <?= $data_koperasi[0];?>
               </div>
              <a href="listroom.php"></a><p class="card-text text-white">Data Koperasi<i class="fas fa-angle-double-right ml-2"></i></p>
              <a href="listroom.php" class="btn btn-primary">Lihat</a>
              </div>
           </div>
           <?php } ?>
           
           <div class="row text-white">
          <div class="card bg-danger ml-5" style="width: 19rem;">
            <div class="card-body" style="width: 10rem;">
             <div class="card-body-icon">
               <i class="fas fa-money-check mr-4"></i>
              </div>
              <h5 class="card-title">Transaksi Koperasi</h5>
              <div class="display-4"><?= $transaction[0];?></div>
              <a href="../penjaga/transaksi.php"></a><p class="card-text text-white">Transaksi Koperasi<i class="fas fa-angle-double-right ml-2"></i></p>
              <a href="../penjaga/transaksi.php" class="btn btn-primary">Lihat</a>    
              </div>
           </div>
           
            
           <?php 
            $level = $_SESSION['level'] == 'admin';
            if ($level){
             ?>
           <div class="row text-white">
          <div class="card bg-success ml-5" style="width: 19rem;">
            <div class="card-body" style="width: 10rem;">
             <div class="card-body-icon">
               <i class="fas fa-money-check mr-4"></i>
              </div>
              <h5 class="card-title">Data Barang dan Harga</h5>
              <div class="display-4"><?= $barang_harga[0];?></div>
              <a href="../barangharga/databarang.php"></a><p class="card-text text-white">Data Barang dan Harga<i class="fas fa-angle-double-right ml-2"></i></p>
              <a href="../barangharga/databarang.php" class="btn btn-primary">Lihat</a>
              
              
              
              </div>
           </div>
          </div>
          <?php } ?>
        </div>
      </div>
    </div>
      

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script type="text/javascript" src="js/admin.js"></script>
  </body>
</html>