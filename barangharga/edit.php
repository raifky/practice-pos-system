<?php
  include 'config.php';
  session_start();
  $id = $_GET['id'];

  
    if(isset($_POST['submit'])) {

      // initialize variable to get value from input element

      $nama_anggota = $_POST['pemilik'];
      $nama_barang = $_POST['country'];
      $stock_awal = $_POST['stock_awal'];
      $harga       = $_POST['harga'];
      $potongan = $_POST['potongan']; 
              
       //Insert user data into table
      $sql = "UPDATE `data_barang` SET `pemilik`='$nama_anggota',`country`='$nama_barang', `stock_awal`='$stock_awal', `harga`= '$harga', `potongan`= '$potongan' WHERE id=$id";

      $result = mysqli_query($con, $sql);

      if($result) {
        $_SESSION['edit'] = "Berhasil";
        header("Location: databarang.php?msg= Data Update successfully");
      }
      else {
        echo "Failed " . mysqli_error($con);
      }
      
       //Show message when user added
      //echo "User added successfully";
     }
  
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../public/admin.css">
    <script src="https://kit.fontawesome.com/e168c97215.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/form.css">
    <title>Data Koperasi</title>
  </head>
  <body>
  <nav class="navbar navbar-expand-lg navbar-light bg-warning fixed-top">
        <a class="navbar-brand" href="../dashboard.php">HELLO ADMIN | <b></b></a>
          <form class="form-inline my-2 my-lg-0 ml-auto">
          </form>
          <div class="icon ml-4">
            <h5>
              <!-- <i class="fas fa-envelope mr-3" data-toggle="tooltip" title="Inbox"></i>
              <i class="fas fa-bell mr-3" data-toggle="tooltip" title="Notification"></i>
              <i class="fas fa-sign-out-alt mr-3" data-toggle="tooltip" title="Log Out"></i> -->
            </h5>

          </div>
        </div>
      </nav>
       

      <?php
      $sql = "SELECT * FROM `data_barang` WHERE id = '$id'";
      $result = mysqli_query($con, $sql);
      $rows = mysqli_fetch_assoc($result);
      ?>

      <form method="POST" action="" id="square-form">
        <div class="mb-3">
          <label for="input_barang" class="form-label">pemilik:</label>
          <input name="pemilik" type="text" class="form-control" id="input_barang" value="<?php echo $rows['pemilik'] ?>" >
          <div id="emailHelp" class="form-text"></div>
        </div>
        <div class="mb-3">
          <label for="exampleInputJumlah1" class="form-label">Nama Barang:</label>
          <input name= "country" min="" type="text" class="form-control" id="exampleInputjumlah" value="<?php echo $rows['country'] ?>" >
          <div id="emailHelp" class="form-text"></div>
        </div>
        <div class="mb-3">
          <label for="exampleInputJumlah1" class="form-label">Jumlah Stock Awal:</label>
          <input name= "stock_awal" min="" type="number" class="form-control" id="exampleInputjumlah" value="<?php echo $rows['stock_awal'] ?>" >
          <div id="emailHelp" class="form-text"></div>
        </div>
        <div class="mb-3">
          <label for="exampleInputJumlah1" class="form-label">Harga:</label>
          <input name="harga" min="" type="number" class="form-control" id="exampleInputjumlah" value="<?php echo $rows['harga'] ?>" >
          <div id="emailHelp" class="form-text"></div>
        </div>
        <div class="mb-3">
          <label for="exampleInputJumlah1" class="form-label">potongan:</label>
          <input name="potongan" min="" type="number" class="form-control" id="exampleInputjumlah" value="<?php echo $rows['potongan'] ?>" >
          <div id="emailHelp" class="form-text"></div>
        </div>
        <button name="submit" type="submit" class="btn btn-primary">Edit</button>
        <a href="databarang.php" name="" type="submit" class="btn btn-danger" >Cancel</button>
    </form>
  </body>