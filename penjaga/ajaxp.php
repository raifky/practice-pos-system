<?php
include 'configtr.php';
session_start();

$country_id = $_POST['harga'];

$total = "SELECT * FROM data_barang WHERE id = ?";
$stmt = mysqli_prepare($connection, $total);
mysqli_stmt_bind_param($stmt, "i", $country_id);
mysqli_stmt_execute($stmt);
$total_query = mysqli_stmt_get_result($stmt);

$result = [
    'barang' => '',
    'data_html' => '',
];

if (mysqli_num_rows($total_query) > 0) {
    while ($total_row = mysqli_fetch_assoc($total_query)) {
        $output = '<option value="'.$total_row['harga'].'">'. $total_row['harga'].'</option>';

        $result['barang'] = $total_row['country'];
        $result['data_html'] = $output;
        
        $_SESSION['harga_data'] = $total_row['harga'];
    }
} else {
    // Handle case when no data is found
    $output = '<option value="">No data found</option>';

    $result['barang'] = '';
    $result['data_html'] = $output;
}

echo json_encode($result);
?>
