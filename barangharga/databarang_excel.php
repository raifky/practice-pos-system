<?php
include '../log/konek.php';



?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="../public/css/admin.css">
  <script src="https://kit.fontawesome.com/e168c97215.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" type="text/css"
    href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.13.1/af-2.5.1/b-2.3.3/b-colvis-2.3.3/b-html5-2.3.3/b-print-2.3.3/cr-1.6.1/date-1.2.0/fc-4.2.1/fh-3.3.1/kt-2.8.0/r-2.4.0/rg-1.3.0/rr-1.3.1/sc-2.0.7/sb-1.4.0/sp-2.1.0/sl-1.5.0/sr-1.2.0/datatables.min.css" />
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



</head>

<body>
  

      <?php
      include 'config.php';
      $sql = "SELECT * FROM data_barang";
      $barang = $con->query($sql);
      ?>
       <style>
        #table_id{
          width: 1078px;
        }
       </style>
      <table id="table_id" class='table table-bordered'>
        <thead>
          <tr>
            <th class="text-center" scope="col">NO</th>
            <th class="text-center" scope="col">Tanggal</th>
            <th class="text-center" colspan="" scope="col">pemilik</th>
            <th class="text-center" scope="col">Nama Barang</th>
            <th class="text-center" scope="col">Stock Awal</th>
            <th class="text-center" scope="col">Harga</th>
            <th class="text-center" scope="col">potongan</th>

          </tr>
        </thead>
        <?php
            header("Content-type: application/vnd-ms-excel");
            header("Content-Disposition: attachment; filename=Data Barang.xls");
         ?>
        <tbody>
          <?php
          $no = 1;
          while ($row = $barang->fetch_assoc()) {
            ?>
            <tr>
              <td class="text-center"><?php echo $no++ ?></td>
              <td class=""><?php echo date('d F Y H:i', strtotime($row['tanggal']));  ?></td>
              <td class="text-center"><?php echo $row['pemilik'] ?></td>
              <td class="text-center"><?php echo $row['country'] ?></td>
              <td class="text-center"><?php echo $row['stock_awal'] ?></td>
              <td class="text-center">Rp.<?php echo $row['harga'] ?></td>
              <td class="text-center"><?php echo $row['potongan'] ?></td>

              

              
            </tr>

            <?php
          }
          ?>
        <?php mysqli_close($con); ?>

        </tbody>

        <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
        <script type="text/javascript" src="../public/js/admin.js"></script>

<!-- 
        <script type="text/javascript"
          src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script> -->
        <!-- <script type="text/javascript"
          src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script> -->
        <script type="text/javascript"
          src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.13.1/af-2.5.1/b-2.3.3/b-colvis-2.3.3/b-html5-2.3.3/b-print-2.3.3/cr-1.6.1/date-1.2.0/fc-4.2.1/fh-3.3.1/kt-2.8.0/r-2.4.0/rg-1.3.0/rr-1.3.1/sc-2.0.7/sb-1.4.0/sp-2.1.0/sl-1.5.0/sr-1.2.0/datatables.min.js"></script>
          
        <script>$(document).ready(function () {
            $('#table_id').DataTable();
          });</script>

</html>