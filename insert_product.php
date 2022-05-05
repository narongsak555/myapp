<?php

  session_start();
  require_once "config/db_invent.php";

 

  if (isset($_POST['submit'])){
    $name = $_POST['pd_name'];
    $quantity = $_POST['pd_quantity'];
    $price = $_POST['pd_price'];
    $status = $_POST['pd_status'];
    $datein = $_POST['datein'];
    $exp = $_POST['exp'];
    $img = $_FILES['img'];


    $allow = array('jpg', 'jpeg', 'png');
    $extension = explode(".", $img['name']);
    $fileActExt = strtolower(end($extension));
    $fileNew = rand() . "." . $fileActExt;
    $filePath = "uploads/".$fileNew;

    if (in_array($fileActExt, $allow)) {
      if ($img['size'] > 0 && $img['error'] == 0) {
        if (move_uploaded_file($img['tmp_name'], $filePath)) {
          $sql = $conn->prepare("INSERT INTO myinventory(name,quantity,price,status,datein,exp,img) VALUES (:name,:quantity,:price,:status,:datein,:exp,:img)");
          $sql->bindParam(":name", $name);
          $sql->bindParam(":quantity", $quantity);
          $sql->bindParam(":price", $price);
          $sql->bindParam(":status", $status);
          $sql->bindParam(":datein", $datein);
          $sql->bindParam(":exp", $exp);
          $sql->bindParam(":img", $fileNew);
          $sql->execute();

          if ($sql) {
            $_SESSION['success'] = "Data has been inserted successfully";
            header("location: inventoryPage.php");
          } else {
            $_SESSION['error'] = "Data has not been inserted successfully";
            header("location: inventoryPage.php");
          }
        
        }
      }
    }

  }


?>



