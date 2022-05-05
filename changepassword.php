<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <title>จัดการบัญชี</title>


</head>


<body>

    <div class="container">

      <div class="header">
        

      <div id="mySidenav" class="sidenav">
          <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
          <a href="index.php">หน้าหลัก</a>
          <a href="salePage.php">ขายสินค้า</a>
          <a href="#">ค้นหาสินค้า</a>
          <a href="inventoryPage.php">จัดการทะเบียนสินค้า</a>
          <a href="accountPage.php">จัดการบัญชี</a>

          <a href="signin.php"><button class="btn btn-dark">เข้าสู่ระบบ</button></a>
          
          
        </div>

        <div id="main">
          <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; Menu</span>
          
        </div>

        <h1 class="text-header" id="text-header">เปลี่ยนรหัสผ่าน</h1>
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





      // End nav

      

    </script>


    <script>

        

    </script>

</body>
</html>
