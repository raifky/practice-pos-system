<?php
 include 'config.php';
 session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi</title>
    <link rel="stylesheet" type="text/css" href="../admin.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/form.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-warning fixed-top">
        <a class="navbar-brand" href="../dashboard.php">HELLO ADMIN | <b></b></a>
          <form class="form-inline my-2 my-lg-0 ml-auto">
          </form>
          <div class="icon ml-4">
            <h5>
              <i class="fas fa-envelope mr-3" data-toggle="tooltip" title="Inbox"></i>
              <i class="fas fa-bell mr-3" data-toggle="tooltip" title="Notification"></i>
              <i class="fas fa-sign-out-alt mr-3" data-toggle="tooltip" title="Log Out"></i>
            </h5>

          </div>
        </div>
      </nav>
   
    <form action="" method="POST" id="square-form">

<div>
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Nama Pemilik Barang:</label>
        <input name="pemilik" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" Required>
    <div id="emailHelp" class="form-text"></div>
    </div>
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Nama Barang:</label>
        <input name="country" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" Required>
    <div id="emailHelp" class="form-text">
    </div>
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Jumlah Stock Awal:</label>
        <input name="stock_awal" type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" Required>
    <div id="emailHelp" class="form-text">
    </div>
    
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Harga:</label>
        <input name="harga" type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" Required>
    <div id="emailHelp" class="form-text">
    </div>
    <div class="mb-3">
        <input name="potongan" type="number" value="10" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" hidden>
    <div id="emailHelp" class="form-text">
    </div>
            <button name="submit" type="submit"  class="btn btn-primary" >Submit</button>
            <a href="databarang.php" name="" type="submit" class="btn btn-danger" >Cancel</a>
    </div>
   </form>
</body>

<?php
    if(isset($_POST['submit'])) {

        $pemilik = $_POST['pemilik'];
        $barang = $_POST['country'];
        $stock_awal = $_POST['stock_awal'];
        $harga = $_POST['harga'];
        $potongan = $_POST['potongan'];

        $query = mysqli_query($con, "INSERT INTO data_barang(pemilik, country, stock_awal, harga, potongan) VALUES ('$pemilik', '$barang', '$stock_awal', '$harga', '$potongan')");

        if($query) {
          $_SESSION['success'] = "Berhasil";
            header('Location: databarang.php?msg= Data Added successfully');
            exit;
        }else {
            echo "Failed" . mysqli_error($con);
        }
    }

?>