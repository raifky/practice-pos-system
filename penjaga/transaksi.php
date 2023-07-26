<?php
include '../log/konek.php';

require '../log/auth.php';
checkLoginSessionValidity();



?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css"
    href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.13.1/af-2.5.1/b-2.3.3/b-colvis-2.3.3/b-html5-2.3.3/b-print-2.3.3/cr-1.6.1/date-1.2.0/fc-4.2.1/fh-3.3.1/kt-2.8.0/r-2.4.0/rg-1.3.0/rr-1.3.1/sc-2.0.7/sb-1.4.0/sp-2.1.0/sl-1.5.0/sr-1.2.0/datatables.min.css" />

    <link rel="stylesheet" type="text/css" href="../public/css/admin.css">
    <script src="https://kit.fontawesome.com/e168c97215.js" crossorigin="anonymous"></script>
    <!-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    
    <title>Data Transaksi</title>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-warning fixed-top">
        <a class="navbar-brand" href="../public/dashboard.php">HELLO ADMIN | <b></b></a>
          <form class="form-inline my-2 my-lg-0 ml-auto">
            <!-- <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button> -->
          </form>
          <div class="icon ml-4">
            <h5>
              <!-- <i class="fas fa-envelope mr-3" data-toggle="tooltip" title="Inbox"></i>
              <i class="fas fa-bell mr-3" data-toggle="tooltip" title="Notification"></i> -->
              <a href="../log/logout.php"><i class="fas fa-sign-out-alt mr-3" data-toggle="tooltip" title="Log Out"></i></a>
            </h5>

          </div>
        </div>
      </nav>

      <div class="row mt-5">
        <div class="col-md-2,5 bg-dark mt-2 pr-3 pt-4">
          <ul class="nav flex-column ml-3 mb-5">
            <li class="nav-item">
              <a class="nav-link active text-white" href="../public/dashboard.php"><i class="fas fa-tachometer-alt mr-2"></i>Dashboard</a><hr class="bg-secondary">
            </li>
            <?php 
            $level = $_SESSION['level'] == 'admin';
            if ($level){
             ?>
            <li class="nav-item">
              <a class="nav-link text-white" href="../public/listroom.php"><i class="fas fa-money-check mr-2"></i>Data Koperasi</a><hr class="bg-secondary">
            </li>
            <?php } ?>
            <li class="nav-item">
              <a class="nav-link active text-white" href="transaksi.php"><i class="fas fa-money-check mr-2"></i>Transaksi Koperasi</a><hr class="bg-secondary">
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
        <h3><i class="fas fa-money-check mr-2"></i></i>Data Transaksi</h3><hr>
        <a href="dropdown.php" class="btn btn-primary mb-3"><i class="fas fa-plus-square mr-3"></i>Tambah Data</a>

        <?php
include 'configtr.php';

$sql = "SELECT * FROM data_transaksi ORDER BY tanggal DESC";
$transaksi = $connection->query($sql);

?>
<style>
  #table_id{
    width: 1078px;
  }
  #btn-apus{
    margin-left: 45px;
    margin-top: -59px;
    margin-right: -30px;
  }
</style>
<a target="_blank" href="transaksi_excel.php" class="btn btn-success mb-3"><i class="bi bi-file-earmark-spreadsheet"></i>EXPORT KE EXCEL</a>
<table id="table_id" class='table table-bordered'>
    <thead>
        <tr>
            <th class="text-center" scope="col">NO</th>
            <th class="text-center" scope="col">Tanggal Transaksi</th>
            <th class="text-center" scope="col">Tanggal Di Ubah</th>
            <th class="text-center" scope="col">Nama Penjaga</th>
            <th class="text-center" scope="col">Nama Barang</th>
            <th class="text-center" scope="col">Harga</th>
            <th class="text-center" scope="col">Jumlah Terjual</th>
            <th class="text-center" scope="col">Opsi</th>
        </tr>
    </thead>
    <tbody>

        <?php
        $no = 1;
        while ($row = $transaksi->fetch_assoc()) {
            $barang_id = $row['country'];
            $sql_barang = "SELECT * FROM data_barang WHERE id = $barang_id";
            $result_barang = $connection->query($sql_barang);
            $row_barang = $result_barang->fetch_assoc();
        ?>

            <tr>
                <td class="text-center"><?php echo $no++ ?></td>
                <td class="text-center"><?php echo date('d F Y H:i', strtotime($row['tanggal'])); ?></td>
                <td class="text-center">
                  <?php
                  if ($row['modified'] !== null) {
                      echo date('d F Y H:i', strtotime($row['modified']));
                  } else {
                      echo "<b>Tidak Ada Perubahan</b>";
                  }
                  ?>
                </td>
                <td class="text-center"><?php echo $row['penjaga']; ?></td>
                <td class="text-center"><?php echo $row_barang['country']; ?></td>
                <td class="text-center">Rp.<?php echo $row_barang['harga']; ?></td>
                <td class="text-center"><?php echo $row['terjual']; ?></td>

                <td>
                    <a href="edittr.php?id=<?php echo $row['id']; ?>" class='btn btn-primary btn-sm'>Edit</a>
                    <a href="#" class='btn btn-danger btn-sm delete' data-id="<?php echo $row['id']; ?>" id="btn-apus">Delete</a>
                </td>

            </tr>

        <?php
        }
        ?>

    </tbody>

<?php
mysqli_close($connection);
?>




    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script> -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script type="text/javascript" src="../public/js/admin.js"></script>

    <!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script> -->
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.13.1/af-2.5.1/b-2.3.3/b-colvis-2.3.3/b-html5-2.3.3/b-print-2.3.3/cr-1.6.1/date-1.2.0/fc-4.2.1/fh-3.3.1/kt-2.8.0/r-2.4.0/rg-1.3.0/rr-1.3.1/sc-2.0.7/sb-1.4.0/sp-2.1.0/sl-1.5.0/sr-1.2.0/datatables.min.js"></script>


    <?php
    if(isset($_SESSION['success'])):
      ?>

    <script>
      Swal.fire(
        'Data Transaksi Berhasil Di Tambahkan',
        'Klik OK Untuk Lanjut',
        'success'
   )
    </script>
    <?php
   unset($_SESSION['success']);
     ?>

    <?php
    elseif (isset($_SESSION['edit'])): 
      ?>
    <script>
      Swal.fire(
         'Data Berhasil Di Edit',
         'Klik OK Untuk Lanjut',
         'success'
   )
    </script>
    <?php
   unset($_SESSION['edit']);
    ?>

   <?php
   endif
   ?>
   <script>
    $('.delete').click(function(){
      var transaksi_id = $(this).attr('data-id');
      Swal.fire({
        title: 'Apakah Kamu Yakin?',
        text: "Ingin Menghapus data ini?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Hapus!'
      }).then((result) => {
        if (result.isConfirmed) {
          window.location = "deletetr.php?id=" + transaksi_id + "";
          Swal.fire(
            'Sukses!',
            'Data barang mu terhapus.',
            'berhasil'
          )
        }
      });
    });
    
   </script>

   


    
    <script>$(document).ready( function () {
     $('#table_id').DataTable();
      } );</script>               

</body>