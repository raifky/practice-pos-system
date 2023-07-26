

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
    <title>LIST DATA</title>
  </head>
  <body>
      <div class="row mt-5">
        <?php 
                            include '../config/configurasi.php';

                            if(isset($_POST['button_search'])) {
                              $variable = $_POST['search_bar'] ? $_POST['search_bar'] : '';

                              echo $variable;
                              $sql = "SELECT data_transaksi.*, data_barang.*,
                              SUM(data_transaksi.terjual) AS total_terjual, data_barang.stock_awal - SUM(data_transaksi.terjual) AS sisa_stock,
                              data_barang.potongan, data_transaksi.harga, 
                              SUM(data_barang.harga * data_transaksi.terjual) AS total,
                              SUM(data_barang.harga * data_transaksi.terjual DIV data_barang.potongan) AS Revenue,
                              SUM(data_barang.harga * data_transaksi.terjual - data_barang.harga * data_transaksi.terjual DIV data_barang.potongan) AS 'Total Diterima'
                              FROM data_transaksi
                              INNER JOIN data_barang ON data_transaksi.country = data_barang.id
                              GROUP BY data_barang.tanggal, data_barang.pemilik, data_transaksi.country, data_barang.stock_awal, data_barang.potongan, data_transaksi.harga
                              ORDER BY data_barang.tanggal DESC; '%$variable%'";
                              $barang = $configurasi->query($sql);
                            } else {
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
                            }
                      
        ?>    
          <?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Data koperasi.xls");
?>
 
        <table class='table table-bordered'>
        <thead>
            <tr>
            <th scope="col">NO</th>
              <th colspan="" scope="col">Tanggal</th>
              <th scope="col">Pemilik</th>
              <th colspan="" scope="col">Barang</th>
              <th scope="col">Stock Awal</th>
              <th scope="col">Jumlah Terjual</th>
              <th scope="col">Sisa Stock</th>
              <th scope="col">Harga</th>
              <th scope="col">Potongan</th>
              <th scope="col">Total</th>
              <th scope="col">Revenue</th>
              <th scope="col">total diterima</th>
              

            </tr>
          </thead>
                <tbody>
                  <?php
                  $no = 1;
                  while ($row =$barang->fetch_assoc()) {
                    ?>
                    
                    
                     <tr>
                     <td><?php echo $no++ ?></td>
                     <td class="text-center"><?php echo date('d F Y H:i', strtotime($row['tanggal']));?></td>
                     <td><?php echo $row['pemilik']?></td>
                     <td><?php echo $row['country']?></td>
                     <td><?php echo $row['stock_awal']?></td>
                     <td><?php echo $row['total_terjual']?></td>
                     <td><?php echo $row['sisa_stock']?></td>
                     <td>Rp.<?php echo $row['harga']?></td>
                     <td><?php echo $row['potongan']?></td>
                     <td>Rp.<?php echo $row['total']?></td>
                     <td>Rp.<?php echo $row['Revenue']?></td>
                     <td><?php echo $row['Total Diterima']?></td>
                    </tr>
                    <?php
                  }
                  
                  
                  ?>
                  </tbody>
                  <tfoot>
            <?php
              $sql = 'SELECT data_transaksi.*, data_barang.*, 
              SUM(data_barang.harga * data_transaksi.terjual - data_barang.harga * data_transaksi.terjual DIV data_barang.potongan) AS sum
              FROM data_barang 
              INNER JOIN data_transaksi ON data_barang.id =data_transaksi.country';
             $sum = $configurasi->query($sql);
             $summing = $sum->fetch_assoc();
             
             
             
            ?>
                  <tr>
                    <th>Total:</th>
                    <th>Rp.<?php echo $summing['sum'];?></th>
                    <th></th>
                    <th></th>
                    <th></th>
                  </tr>
                
            </tfoot>
                
          </table>
          <?php mysqli_close($configurasi); ?>
        </div>
        </div>
      </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script type="text/javascript" src="admin.js"></script>
  </body>

  
</html>