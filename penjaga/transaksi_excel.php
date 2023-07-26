<?php
include '../log/konek.php';

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

    
  </head>
  <body>
    


        <?php
include 'configtr.php';

$sql = "SELECT * FROM data_transaksi ORDER BY tanggal";
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
<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Data Transaksi.xls");
?>
<table id="table_id" class='table table-bordered'>
    <thead>
        <tr>
            <th class="text-center" scope="col">NO</th>
            <th class="text-center" colspan="" scope="col">Tanggal Transaksi</th>
            <th class="text-center" colspan="" scope="col">Tanggal Di Ubah</th>
            <th class="text-center" scope="col">Nama Penjaga</th>
            <th class="text-center" colspan="" scope="col">Nama Barang</th>
            <th class="text-center" scope="col">Harga</th>
            <th class="text-center" scope="col">Jumlah Terjual</th>
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


            </tr>

        <?php
        }
        ?>

    </tbody>
</table>

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

   


    
    <script>$(document).ready( function () {
     $('#table_id').DataTable();
      } );</script>               

</body>