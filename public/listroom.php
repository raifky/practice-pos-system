<?php
include '../log/konek.php';

require '../log/auth.php';
checkLoginSessionValidity();



?>
<?php
include '../config/configurasi.php';
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
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="/DataTables/datatables.css" />
    <script src="/DataTables/datatables.js"></script>
    <title>Data Koperasi</title>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-warning fixed-top">
        <a class="navbar-brand" href="dashboard.php">HELLO ADMIN | <b></b></a>
          <form class="form-inline my-2 my-lg-0 ml-auto">
            
          </form>
          <div class="icon ml-4">
            <h4>
              <a href="../log/logout.php"><i class="fas fa-sign-out-alt mr-3" data-toggle="tooltip" title="Log Out"></i></a>
            </h4>

          </div>
        </div>
      </nav>

      <div class="row mt-5">
        <div class="col-md-2,5 bg-dark mt-2 pr-3 pt-4">
          <ul class="nav flex-column ml-3 mb-5">
            <li class="nav-item">
              <a class="nav-link active text-white" href="dashboard.php"><i class="fas fa-tachometer-alt mr-2"></i>Dashboard</a><hr class="bg-secondary">
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="listroom.php"><i class="fas fa-money-check mr-2"></i>Data Koperasi</a><hr class="bg-secondary">
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="../penjaga/transaksi.php"><i class="fas fa-money-check mr-2"></i>Transaksi Koperasi</a><hr class="bg-secondary">
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="../barangharga/databarang.php"><i class="fas fa-money-check mr-2"></i>Data Barang</a><hr class="bg-secondary">
            </li>
          </ul>

        </div>
        <div class="col-md-10 p-5 pt-2">
        <h3><i class="fas fa-money-check mr-2"></i></i>Data Koperasi</h3><hr>
        
      
   

        <?php 
    //        $sql = "SELECT data_barang.tanggal, data_barang.pemilik, data_transaksi.country, data_barang.stock_awal,
    //        SUM(data_transaksi.terjual) AS total_terjual, data_barang.stock_awal - SUM(data_transaksi.terjual) AS sisa_stock,
    //        data_barang.potongan, data_transaksi.harga, 
    //        SUM(data_barang.harga * data_transaksi.terjual) AS total,
    //        SUM(data_barang.harga * data_transaksi.terjual DIV data_barang.potongan) AS Revenue,
    //        SUM(data_barang.harga * data_transaksi.terjual - data_barang.harga * data_transaksi.terjual DIV data_barang.potongan) AS 'Total Diterima'
    // FROM data_barang
    // INNER JOIN data_transaksi ON data_barang.country = data_transaksi.country
    // GROUP BY data_barang.tanggal, data_barang.pemilik, data_transaksi.country, data_barang.stock_awal, data_barang.potongan, data_transaksi.harga;
    // ";

            $sql = "SELECT data_transaksi.*, data_barang.*,
            SUM(data_transaksi.terjual) AS total_terjual, data_barang.stock_awal - SUM(data_transaksi.terjual) AS sisa_stock,
            data_barang.potongan, data_transaksi.harga, 
            SUM(data_barang.harga * data_transaksi.terjual) AS total,
            SUM(data_barang.harga * data_transaksi.terjual DIV data_barang.potongan) AS Revenue,
            SUM(data_barang.harga * data_transaksi.terjual - data_barang.harga * data_transaksi.terjual DIV data_barang.potongan) AS 'Total Diterima'
            FROM data_transaksi
            INNER JOIN data_barang ON data_transaksi.country = data_barang.id
            GROUP BY data_barang.tanggal, data_barang.pemilik, data_transaksi.country, data_barang.stock_awal, data_barang.potongan, data_transaksi.harga
            ORDER BY data_barang.tanggal DESC;";

            $barang = $configurasi->query($sql);
                            

        ?>

        


	

          
          <a target="_blank" href="listroom_excel.php" class="btn btn-success mb-3">EXPORT KE EXCEL</a>
        <table id="table_" class='table table-bordered'>
        <thead>
            <tr>
              <th class="text-center" scope="col">NO</th>
              <th class="text-center" colspan="" scope="col">Tanggal</th>
              <th class="text-center" scope="col">Pemilik</th>
              <th class="text-center" colspan="" scope="col">Barang</th>
              <th class="text-center" scope="col">Stock Awal</th>
              <th class="text-center" scope="col">Jumlah Terjual</th>
              <th class="text-center" scope="col">Sisa Stock</th>
              <th class="text-center" scope="col">Harga</th>
              <th class="text-center" scope="col">Potongan</th>
              <th class="text-center" scope="col">Total</th>
              <th class="text-center" scope="col">Revenue</th>
              <th class="text-center" scope="col">total diterima</th>
            </tr>
          </thead>
                <tbody>
                  <?php
                  $no = 1;
                  while ($row =$barang->fetch_assoc()) {
                    ?> 
                    
                    
                     <tr>
                     <td class="text-center"><?php echo $no++ ?></td>
                     <td class="text-center"><?php echo date('d F Y H:i', strtotime($row['tanggal']));?></td>
                     <td class="text-center"><?php echo $row['pemilik']?></td>
                     <td class="text-center"><?php echo $row['country']?></td>
                     <td class="text-center"><?php echo $row['stock_awal']?></td>
                     <td class="text-center"><?php echo $row['total_terjual']?></td>
                     <td class="text-center"><?php echo $row['sisa_stock']?></td>
                     <td class="text-center">Rp.<?php echo $row['harga']?></td>
                     <td class="text-center"><?php echo $row['potongan']?></td>
                     <td class="text-center">Rp.<?php echo $row['total']?></td>
                     <td class="text-center">Rp.<?php echo $row['Revenue']?></td>
                     <td class="text-center"><?php echo $row['Total Diterima']?></td>
                     
                     
                     
                    </tr>
                    
                  
                    <?php
                  }

                  ?>
                  
                  
                  
              
                </tbody>

                <tfoot>
                  <tr>
                    <th colspan="11" style="text-align:right">Total:</th>
                    <th></th>
                  </tr>
                </tfoot>
          </table>
          <?php mysqli_close($configurasi);
           ?>
        

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->

    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script type="text/javascript" src="js/admin.js"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.13.1/af-2.5.1/b-2.3.3/b-colvis-2.3.3/b-html5-2.3.3/b-print-2.3.3/cr-1.6.1/date-1.2.0/fc-4.2.1/fh-3.3.1/kt-2.8.0/r-2.4.0/rg-1.3.0/rr-1.3.1/sc-2.0.7/sb-1.4.0/sp-2.1.0/sl-1.5.0/sr-1.2.0/datatables.min.js"></script>
    <script type="text/javascript" src="//cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js" ></script>
    <script>
    $(document).ready( function () {
     $('#table_').DataTable({
        footerCallback: function (row, data, start, end, display) {
            var api = this.api();
        
            // Remove the formatting to get integer data for summation
            var intVal = function (i) {
                return typeof i === 'string' ? i.replace(/[\$,]/g, '') * 1 : typeof i === 'number' ? i : 0;
            };
 
            // Total over all pages
            total = api
                .column(11)
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);
 
            // Total over this page
            pageTotal = api
                .column(11, { page: 'current' })
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);
 
            // Update footer
            $(api.column(11).footer()).html('Rp.' + pageTotal + ' ( Rp.' + total + ' total)');
        },
    });
});
    </script>
  </body>

  
</html>