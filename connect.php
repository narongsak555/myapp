<?php

    try {

        $host = "mysql:host=localhost; dbname=db";
        $username = "root";
        $password = "";

        $conn = new PDO($host, $username, $password);
        

    } catch(PDOException $e){
        echo $e->getMessage();
    }

?>