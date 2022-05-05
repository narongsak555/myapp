<?php

  $servername = "localhost";
  $username = "root";
  $password = "";
  // $dbname = "CS403";

  try {
    

    $conn = new PDO("mysql:host=$servername;dbname=db", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connection successfull: ";

  } catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
  }

?> 

