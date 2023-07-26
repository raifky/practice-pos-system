<?php
include 'config.php';
session_start();

$country_id = $_POST['harga'];

$total = "SELECT * FROM data_barang WHERE id= $country_id";

$total_query = mysqli_query($configurasi, $total);

$result = [
    'barang' => '',
    'data_html' => '',
];

//$output = '<option value="">harga</option>';

while ($total_row = mysqli_fetch_assoc($total_query)) {
    
    $output = '<option value="'.$total_row['harga'].'">'. $total_row['harga'].'</option>';

    $result['barang'] = $total_row['country'];
    $result['data_html'] = $output;
    

    $_SESSION['harga_data'] = $total_row['harga'];

}



echo json_encode($result);


?>