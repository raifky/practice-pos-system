
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dropdown</title>
</head>
<body>
    <style>
        body {
            font-size:2rem;
        }
        .container {
            display:grid;
            grid-template-rows: repeat(2, 1fr);
            grid-template-columns: repeat(2, 1fr);
            grid-gap: 6rem;
            padding: 5rem;
            border: 1px solid #ccc;
            justify-content: space-evenly;
        }
        select {
            font-size: 1rem;

        }
    </style>
    <div>
    
    </div>
    <div class="container">
        <div>Selected From Array</div>
        <div>Selected From db</div>
        <div>

        
            <?php
               $selected = "Frestea Jasmine";

            define('DB_SERVER', 'localhost');
            define('DB_USERNAME', 'root');
            define('DB_PASSWORD', '');
            define('DB_NAME', 'barang ready');
            $link = mysqli_connect('localhost', 'root', '', 'barang ready');

            if($link === false){
                die("Error: Couldnt connect to db." . mysqli_connect_error());
            }

$sql = "SELECT * FROM kate";
if($result = mysqli_query($link, $sql)) {
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)) {
            echo "<select>";
            echo "<option>"; echo $row['kate']; "</option>";
        }

    }
}
echo "</select>";



              
              $options = array('Frestea Honey', 'Ayam', 'Frestea Jasmine', 'Frestea Apple');
              echo "<select>";
              foreach ($options as $option){
                if($selected == $option) {
                echo "<option selected='selected' value='$option'>$option</option>";
                }

              else {
                echo "<option value='$option'>$option</option>";
              }
              
            }
            echo "</select>";

              
              
              ?>
        </div>
        <div>
            

        
        </div>
    </div>
    
</body>
</html>