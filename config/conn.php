<?php
     $server = "localhost";
     $user = "root";
     $pw = "";
     $db = "barang_ok";

     $conn = new mysqli($server,$user,$pw, $db);
	
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	  }
	  echo "Connected successfully";


