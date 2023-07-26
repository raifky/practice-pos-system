<?php
     $server = "localhost";
     $user = "root";
     $pw = "";
     $db = "koperasi";
     $konek = new mysqli($server,$user,$pw, $db);
	
     

	if ($konek->connect_error) {
		die("Connection failed: " . $konek->connect_error);
	  }
	  //echo "Connected successfully";