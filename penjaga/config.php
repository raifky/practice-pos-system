<?php
     $server = "localhost";
     $user = "root";
     $pw = "";
     $db = "koperasi";
     $usertable = "data_barang";
     $tableharga = "data_barang";

     $configurasi = new mysqli($server,$user,$pw, $db);
     
	if ($configurasi->connect_error) {
		die("Connection failed: " . $configurasi->connect_error);
	  }
	  //echo "Connected successfully";
      $sql = "SELECT * FROM $usertable";
      $result = $configurasi->query($sql);

     // $sql1 = "SELECT * FROM $tableharga";
      //$result1 = $configurasi->query($sql1);
            

?>