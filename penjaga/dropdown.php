
<?php
include 'config.php';
session_start();

// $sukses = $_SESSION['success'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi</title>
    <!-- <link rel="stylesheet" type="text/css" href="../admin.css"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!-- <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script> -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="../css/form.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-warning fixed-top">
        <a class="navbar-brand" href="../dashboard.php">HELLO ADMIN | <b></b></a>
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
    <input name="data" type="text" class="store_value form-control" hidden  />

<div>
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Penjaga:</label>
        <input name="penjaga" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" Required>
    <div id="emailHelp" class="form-text"></div>
    </div>
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">barang:</label>
            <select name="country" class="form-select" id="country" Required>
                <option selected disabled>Pilih Barang</option>
                <?php while ($rows = mysqli_fetch_assoc($result)) : ?>
                <option value="<?php echo $rows['id'];?>"><?php echo $rows['country'];?></option>
            <?php endwhile;?>

            
    
    
    </select>
    </div>
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Harga:</label>
            <select name="harga" class="form-select" id="harga">
            <option selected disabled>Harga</option>
    </select>
    </div>
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Barang Terjual:</label>
        <input name="terjual" type="" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" Required>
    <div id="emailHelp" class="form-text">
    </div>
            <button name="masuk" type="submit"  class="btn btn-primary" >Submit</button>
            <a href="transaksi.php" name="" type="submit" class="btn btn-danger" >Cancel</a>
    </div>
   </form>
</body>

<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
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
<!-- while() {
    a
} -->

<script>

    $('#country').on('change', function(){
        var country_id = this.value;
        let data;
        //console.log(country_id);
        $.ajax({
            url: "ajax.php",
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
</html>