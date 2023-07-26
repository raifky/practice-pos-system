<?php
  include 'configtr.php';
  session_start();
  
  $id = $_GET['id'];

  if (isset($_POST['submit'])) {
      // Inisialisasi variabel untuk mendapatkan nilai dari elemen input
      $nama_penjaga = $_POST['penjaga'];
      $nama_country = $_POST['country'];
      $harga = $_POST['harga'];
      $jumlah_terjual = $_POST['terjual'];
  
      // Update data_transaksi
      $sql = "UPDATE data_transaksi
               SET penjaga = '$nama_penjaga', country = '$nama_country', harga = '$harga', terjual = '$jumlah_terjual'
               WHERE id = $id";
      $result = mysqli_query($connection, $sql);
      if ($result) {
          $_SESSION['edit'] = "Berhasil";
          header("Location: transaksi.php?msg=Data successfully updated");
          exit;
      } else {
          echo mysqli_error($connection);
      }
  }
  
  





  
  
  
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- <link rel="stylesheet" type="text/css" href="admin.css"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!-- <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script> -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://kit.fontawesome.com/e168c97215.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/form.css">
    <title>Data Koperasi</title>
  </head>
  <body>
       <nav class="navbar navbar-expand-lg navbar-light bg-warning fixed-top">
        <a class="navbar-brand" href="../dashboard.php">HELLO ADMIN | <b></b></a>
          
      </nav>

      <?php
      $sql1 = "SELECT * FROM data_transaksi WHERE id = $id;";
      $resultss = mysqli_query($connection, $sql1);
      $row = mysqli_fetch_assoc($resultss);
      ?>

      <?php
      $sql2 = "SELECT * FROM data_transaksi WHERE id = $id";
      $results = mysqli_query($connection, $sql2);
      $rows = mysqli_fetch_assoc($results);
      ?>

      <form method="POST" action="" id="square-form">
      <!-- <input name="data" type="text" class="store_value form-control" hidden  /> -->


        
        <div class="mb-3">
          <label class="form-label">penjaga:</label>
          <input name="penjaga" min="" type="" class="form-control" id="exampleInputjumlah" value="<?php echo $row['penjaga'] ?>" Required>
          <div id="emailHelp" class="form-text"></div>
        </div>
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">barang:</label>
          <?php /*var_dump($rows)*/ ?>
        
          <select name="country" class="form-select" id="country" Required>
              <option selected disabled>Pilih Barang</option>
              <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                <option value="<?php echo $row['id'];?>"><?php echo $row['country'];?></option Required>
            <?php endwhile;?>
    </select>
    </div>
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Harga:</label>
            <select name="harga" class="form-select" id="harga" Required>
            <option selected disabled>Harga</option>
    </select>
    </div>
        <div class="mb-3">
          <label for="exampleInputJumlah1" class="form-label">Terjual:</label>
          <input name="terjual" type="" class="form-control" id="exampleInputjumlah" value="<?php echo $rows['terjual'] ?>" >
          <div id="emailHelp" class="form-text"></div>
        </div>
        <button name="submit" type="submit" class="btn btn-primary">Edit</button>
        <a href="transaksi.php" name="" type="submit" class="btn btn-danger" >Cancel</button>     
    </form>

  </body>
  <script>

    $('#country').on('change', function(){
        var country_id = this.value;
        let data;
        console.log(country_id);
        $.ajax({
            url: "ajaxp.php",
            type: "POST",
            data: {
                harga: country_id
              },
            success: function(result) {
                data = JSON.parse(result)
                $('#harga').html(data.data_html);
                $('.store_value').val(data.barang);
                console.log(data.barang);
            }
        })
    });
</script>
