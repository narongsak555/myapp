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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/sale.css">

    
    

    <!-- Data Table -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

    
    <title>Sale System</title>


    

 

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

    <!-- HEADER START -->
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

      <h1 class="text-header" id="text-header">ขายสินค้า</h1>

        
    
    </div>
    <!-- HEADER END -->



    <div class="container" id="container-salePage">

      


      



      


      <!-- MAIN CONTENT START -->
      <div class="main-content" id="pick-product-area">


      

          <div id="product-area">

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




            <div class="col-md-2 col-lg-2">

              <div class="card" style="width: 10rem; ">
            
                <img src="https://climate.onep.go.th/wp-content/uploads/2020/01/default-image.jpg" alt="default" class="card-img-top">
                <a class="btn btn-dark" name="btn-add" id="button-add">
                <div class="card-body">

                    
                      <h3 class="card-title"><?php echo $product['name'] ?></h3>
                      <h4 class="card-text"><?php echo $product['price'] ?></h4>
                      
                         
                </div>
                </a>
              </div>

            </div>
            <?php
          
            }
            
            ?> 
          </div> 

      
          <!-- SIDEBAR START -->
          <div class="sidebar" id="cart-area">

            <table class="table table-light" id="table-cart">
              <thead >
                <tr>
                  <th scope="col"></th>
                  <th scope="col">Item</th>
                  <th scope="col"></th>
                  <th scope="col">ราคา</th>
                  
                  <th scope="col">จำนวน</th>
                  <th scope="col">ยอดรวม</th>
                  <th scope="col"></th>
                </tr>
              </thead>
              <tbody>
                

                
                
                
              </tbody>

              <tr>

                  <td><img class="uk-preserve-width uk-border-circle" width="40" alt="รูปสินค้า"></td>
                  <td class="uk-table-link">
                    <h3 class="item-name"><strong>Total</strong></h3>
                  </td>
                  <td class="uk-text-truncate"><h3></h3></td>
                  <td class="uk-text-truncate"><h3></h3></td>
                  <td class="uk-text-truncate grand-total"><h3><strong>$0</strong></h3></td>

                </tr>

            </table>


            

          </div>
          <!-- SIDEBAR START END-->


      </div>

      <!-- MAIN CONTENT END -->






      


    </div>
    


    
<!-- Bootstrap -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<script src="js/script.js"></script>


<script>
  //DataTable Library
  $(document).ready( function () {
      $('#myTable').DataTable();
  });

  // Sale

  // salePage

let add_to_cart = document.getElementsByName('btn-add')
let main_container = document.getElementsByTagName('tbody')[0]
let quantity_fields = document.getElementsByClassName('num')

for(let i = 0; i < add_to_cart.length; i++){
  add_to_cart[i].addEventListener('click', addToCart)
}



function addToCart(event){

  let btn = event.target
  let btn_parent = btn.parentElement //div.card-body อยากไป React แต่ติดข้ออ้างอยู่
  let btn_grandparent = btn.parentElement.parentElement //div.card
  let itemName = btn_parent.children[0].innerText
  let itemPrice = btn_parent.children[1].innerText
  let itemImage = btn_grandparent.children[0].src


  let itemContainer = document.createElement('tr');
  itemContainer.innerHTML = `
                <tr id="tr-area">
                  <th scopt="row">
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <div class="input-group-text">
                          <input type="checkbox" aria-label="Checkbox for following text input">
                        </div>
                      </div>
                      
                    </div>
                  </th>
                  <td ><img class="rounded-circle" src="https://www.incathlab.com/images/products/default_product.png" alt="รูปสินค้า"></td>
                  <td class="uk-table-link">
                    <h3 class="item-name" id="text-table">${itemName}</h3>
                  </td>
                  <td class="uk-text-truncate item-price"><h3 id="text-table">${itemPrice}</h3></td>
                  <td><input type="number" id="input-num" class="num" value="1"></td>
                  <td class="uk-text-truncate total-price"><h3 id="text-table">${itemPrice}</h3></td>
                  <td><button class="btn btn-danger" type="button">Remove</button></td>
                
                </tr>
  `

  main_container.append(itemContainer)

  for(let i = 0; i < quantity_fields.length; i++){
    quantity_fields[i].addEventListener('change', updateTotal)
  }
  grandTotal()

}

function updateTotal(event){
  number_of_items = event.target
  number_of_items_parent = number_of_items.parentElement.parentElement
  price_field = number_of_items_parent.getElementsByClassName('item-price')[0]
  total_field = number_of_items_parent.getElementsByClassName('total-price')[0]
  price_field_content = price_field.children[0].innerText
  total_field.children[0].innerText = '$' + number_of_items.value * price_field_content


  if(isNaN(number_of_items.value) || number_of_items.value <= 0){
    number_of_items.value = 1
  }

  grandTotal()
  // console.log(price_field_content)
}


function grandTotal(){
  let total = 0
  let grand_total = document.getElementsByClassName('grand-total')[0]
  let total_price = document.getElementsByClassName('total-price')

  for(let i = 0; i < total_price.length; i++){
    total_price_content = Number(total_price[i].innerText.replace('$',''))
    total += total_price_content
  }
  grand_total.children[0].innerText = total

  console.log(total)
  

}

  
</script>

<script>

      // NavSide
      function openNav() {
        document.getElementById("mySidenav").style.width = "300px";
        document.getElementById("main").style.marginLeft = "300px";
        document.body.style.backgroundColor = "#DDDD";
      }

      function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
        document.getElementById("main").style.marginLeft= "0";
        document.body.style.backgroundColor = "#DDDD";
      }

    </script>

</body>
</html>
