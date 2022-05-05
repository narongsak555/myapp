<?php

session_start();
require_once 'config/db.php';

if (!isset($_SESSION['user_login'])) {
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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="css/style.css">

  <!-- Data Table -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

  <!-- FlatPickr -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  
  <title>Inventory Management</title>


  



</head>


<body>

    
    <?php
    
      if (isset($_SESSION['user_login'])){

          $user_id = $_SESSION['user_login'];
          $stmt = $conn->query("SELECT * FROM users WHERE id = $user_id");
          $stmt->execute();
          $row = $stmt->fetch(PDO::FETCH_ASSOC);

      }
    
    ?>

      


  
    
    

  <div class="container">

    <hr>
    <?php if (isset($_SESSION['success'])) {?>
      <div class="alert alert-success">
        <?php 
          echo $_SESSION['success'];
          unset($_SESSION['success']);
        ?>
      </div>
    <?php } ?>
    <?php if (isset($_SESSION['error'])) {?>
      <div class="alert alert-danger">
        <?php 
          echo $_SESSION['error'];
          unset($_SESSION['error']);
        ?>
      </div>
    <?php } ?>




    <div class="header">
    
      <div id="user-container">
        

        <div id="main">
          <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; Menu</span>
          
        </div>

        <div id="sub">
          <p>นาย <?php echo $row['firstname'] . ' ' . $row['lastname']?> [พนักงาน]</p>
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

          
      </div>

      <h1 class="text-header" id="text-header">จัดการทะเบียนสินค้า</h1>

        
    
    </div>

    
    <!-- Modal Add Product -->
    <div class="modal fade" id="myinventory" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">เพิ่มสินค้า</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            

          </div>
          
        </div>
      </div>
    </div>
    <!-- END MODAL Add Product -->


    <!-- Modal Edit Product -->
    <div class="modal fade" id="editproduct" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">แก้ไขข้อมูลสินค้า</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <!-- FORM -->
            <form action="insert.php" method="post" enctype="multipart/form-data"> <!-- enctype เอาไว้ใช้ insert image -->
              <div class="mb-3">
                <label for="pd_name" class="col-form-label">ชื่อ</label>
                <input type="text" required class="form-control" name="edit_pd_name">
              </div>
              <div class="mb-3">
                <label for="pd_quantity" class="col-form-label">จำนวน</label>
                <input type="text" required class="form-control" name="pd_quantity">
              </div>

              <div class="mb-3">
                <label for="pd_price" class="col-form-label">ราคา</label>
                <input type="text" required class="form-control" name="pd_price">
              </div>

              <div class="mb-3">
                <label for="pd_status" class="col-form-label">สถานะ</label>
                <input type="text" required class="form-control" name="pd_status">
              </div>


              <div class="mb-3">
                <label for="pd_datein" class="col-form-label" disabled="disabled">วันรับสินค้า</label>
                <input type="datetime-local" class="form-control"  name="datein" id="datein">
              </div>

              <div class="mb-3">
              <label for="pd_exp" class="col-form-label">วันหมดอายุ</label>
                <input type="datetime-local" class="form-control" placeholder="วันหมดอายุ" name="exp" id="exp">
              </div>

              <div class="mb-3">
                <label for="img" class="col-form-label">รูปสินค้า</label>
                <input type="file" required class="form-control" id="imgInput" name="img">
                <img id="previewImg" alt="insert_pd_image">
              </div>

              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" name="submit" class="btn btn-success">Submit</button>
              </div>

            </form>
            <!-- END FORM -->

          </div>
          
        </div>
      </div>
    </div>
    <!-- END MODAL Edit Product -->
    


    <table class="table table-sm table-hover" id="myTable">
      <thead class="table table-dark">
        <th scope="col">รายการ</th>
        <th scope="col">ชื่อสินค้า</th>
        <th scope="col">จำนวน</th>
        <th scope="col">ราคา/บาท</th>
        <th scope="col">สถานะ</th>
        <th scope="col">วันรับสินค้า</th>
        <th scope="col">วันหมดอายุ</th>
        <th scope="col">รูปสินค้า</th>
        <th scope="col"></th>
        <th scope="col"></th>

      </thead>

      <tbody>
        
    
      <?php

        $servername = "localhost";
        $username = "root";
        $password = "";

        try {
          $conn = new PDO("mysql:host=$servername;dbname=db", $username, $password);
          // set the PDO error mode to exception
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          // echo "Connected successfully";
        } catch(PDOException $e) {
          echo "Connection failed: " . $e->getMessage();
        }



      ?> 

      

    <?php
    
      $stmt = $conn->query("SELECT * FROM myinventory");
      $stmt->execute();

      $products = $stmt->fetchAll();
      foreach($products as $product){
    ?>
      <tr>

      
        <td><?php echo $product['id'] ?></td>
        <td><?php echo $product['name'] ?></td>
        <td><?php echo $product['quantity'] ?></td>
        <td><?php echo $product['price'] ?></td>
        <td><?php echo $product['status'] ?></td>
        <td><?php echo $product['datein'] ?></td>
        <td><?php echo $product['exp'] ?></td>
        <td width="100px" height="100px"><img width="100%" src="uploads/<?= $product['img']; ?>" class="rounded" alt="No Picture"></td>
        <td><a href="edit_invent.php?id=<?= $product['id']; ?>" class="btn btn-warning">แก้ไข</a></td>
        <td><a href="?delete=<?= $product['id']; ?>" class="btn btn-danger" onclick="return confirm('ยืนยันการลบสินค้า')">ลบ</a></td>

        

          
      </tr>
      

      
      
      
    <?php
    
      }
    
    ?>
    

      </tbody>
    </table>  
  <!-- End of Table -->

  

  
  







    <div class="d-grid gap-2 d-md-block" id="btn-area">
      <button type="button" class="btn btn-primary"  data-bs-toggle="modal" data-bs-target="#myinventory">เพิ่มสินค้า</button>
      <!-- <button class="btn btn-secondary btn-lg" type="button">ประวัติ</button> -->
    </div>





    







  </div>


  
  <!-- Bootstrap -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>    

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

  <!-- FlatPickr -->
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

  <script src="js/script.js"></script>
  
<script>
  $(document).ready( function () {
      $('#myTable').DataTable();
  });
</script>



<script>

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

</script>

<script>
  // FlatPickr
  $datein = document.getElementById('datein');
  $exp = document.getElementById('exp');

  config_datein ={
    altInput: true,
    altFormat: "j F Y (h:S K)",

    enableTime: true,
    dateFormat: "Y-m-d H:i",
    

    minDate: "today",
    maxDate: "today",
    defaultDate: "today"

    

  }

  config_exp ={
    altInput: true,
    altFormat: "j F Y (h:S K)",
    
    enableTime: true,
    dateFormat: "Y-m-d H:i",
    // minDate: "today" * 60Days, 
    maxDate: new Date().fp_incr(60), // 14 days from now

  }
  
  flatpickr("input[name=datein]", config_datein);
  flatpickr("input[name=exp]", config_exp);


  console.log($datein.value)
  console.log($exp)

</script>

<!-- Insert product -->
<script>

  let imgInput = document.getElementById('imgInput')
  let previewImg = document.getElementById('previewImg')

  imgInput.onchange = evt => {
    const [file] = imgInput.files;
    if (file) {
      previewImg.src = URL.createObjectURL(file);
    }
  }

</script>



</body>
</html>
