<?php

  session_start();
  require_once 'config/db.php';

  if (!isset($_SESSION['admin_login'])) {
      $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ !!!';
      header('location: signin.php');
  }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <title>CS403</title>

    
    

 

</head>


<body>

    <div class="container">

        <?php
          
          if (isset($_SESSION['admin_login'])){

              $admin_id = $_SESSION['admin_login'];
              $stmt = $conn->query("SELECT * FROM users WHERE id = $admin_id");
              $stmt->execute();
              $row = $stmt->fetch(PDO::FETCH_ASSOC);

          }
        
        ?>


        <div class="header">
        
          <div id="user-container">
            

            <div id="main">
              <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; Menu</span>
              
            </div>

            <div id="sub">
              <h2>[เจ้าของธุรกิจ]</h2>
              <h3>นาย <?php echo $row['firstname'] . ' ' . $row['lastname']?></h3>
              <a href="logout.php" class="btn btn-light" id="btn-logout">Logout</a>
            </div>

            
          </div>
          

          <div id="mySidenav" class="sidenav">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
            <a href="user.php">หน้าหลัก</a>
            <a href="salePage.php">ขายสินค้า</a>
            <a href="#">ค้นหาสินค้า</a>
            <a href="inventoryPage.php">จัดการทะเบียนสินค้า</a>
            <a href="accountPage.php">จัดการบัญชี</a>

            <a href="signin.php"><button class="btn btn-dark">เข้าสู่ระบบ</button></a>
            <a href="signup.php"><button class="btn btn-dark">สมัครสมาชิค</button></a>
            
          </div>

          <h1 class="text-header" id="text-header">หน้าหลัก</h1>

        
    
        </div>



      


    </div>
    

    <!-- Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <script src="js/script.js"></script>
    
    <script>
      $(document).ready( function () {
          $('#myTable').DataTable();
      });




      // NavSide
      function openNav() {
        document.getElementById("mySidenav").style.width = "300px";
        document.getElementById("main").style.marginLeft = "300px";
        document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
      }

      function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
        document.getElementById("main").style.marginLeft= "0";
        document.body.style.backgroundColor = "white";
      }

      // End nav

      

    </script>


    
</body>
</html>
