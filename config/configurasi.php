<?php
     $server = "localhost";
     $user = "root";
     $pw = "";
     $db = "koperasi";

     $configurasi = new mysqli($server,$user,$pw, $db);
	
	if ($configurasi->connect_error) {
		die("Connection failed: " . $configurasi->connect_error);
	  }
	  //echo "Connected successfully";