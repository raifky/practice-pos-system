<?php
     $server = "localhost";
     $user = "root";
     $pw = "";
     $db = "barang_ok";

     $connt = new mysqli($server,$user,$pw, $db);
	
	if ($connt->connect_error) {
		die("Connection failed: " . $connt->connect_error);
	  }
	  echo "Connected successfully";


