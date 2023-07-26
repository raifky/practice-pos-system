<?php
     $server = "localhost";
     $user = "root";
     $pw = "";
     $db = "koperasi";
     

     $con = new mysqli($server,$user,$pw, $db);

     
	if ($con->connect_error) {
		die("Connection failed: " . $con->connect_error);
	  }
	  //echo "Connected successfully";
?>