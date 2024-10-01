<?php
require_once("Admin/config.php");

$select = "SELECT * FROM `produit`";
$data = mysqli_query($con,$select);


if(isset($_POST['add-to-cart'])){
  $name = $_POST['name'];
  $price = $_POST['price'];
  $image = $_POST['image'];
  $quantity = 1;

  $select_car = mysqli_query($con,"SELECT * FROM `cart` WHERE name='$name'");
  if (mysqli_num_rows($select_car)>0) {
    $message[]='product already added in your cart';
  }else {
    $query = "INSERT INTO `cart`(`name`, `price`, `image`, `quantity`) VALUES ('$name','$price','$image','$quantity')";
    $insert_query = mysqli_query($con,$query);
    $message[]='product added in your cart';

  }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Electronic Shop</title>
    <link rel="stylesheet" href="CSS/style1.css">
    <link rel="stylesheet" href="CSS/styleCart.css">
    <link rel="stylesheet" href="CSS/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
      #inplog{
    border: none;
    outline: none;
}
    </style>
</head>
<body>
    <!-- star navbar -->
    <nav class="navbar navbar-expand-lg fixed-">
        <div class="container">
          <a class="navbar-brand" href="#"><span class="spElectronic"><span class="spE">E</span>lectronic</span><span class="spShop"> Shop</span></a>
          <!-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button> -->
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav m-auto px-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link " aria-current="page" href="index.php">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="products.php">Product</a>
              </li>
              <li class="nav-item ">
                <a class="nav-link" href="about.php" >
                  About
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="contact.php" >Contact</a>
              </li>
            </ul>
            <form  class="d-flex gap-1" role="search">
                <a class="btn btn-outline-info" href="login.php">login</a>
                <a class="btn btn-outline-info" href="incription.php">inscription</a>
              <input id="forminput" class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
              <button id="formbtn"  class="btn btn-outline-warning" type="submit">Search</button>
              
            </form>
          </div>

          <?php
          $select_rows = mysqli_query($con,"SELECT * FROM `cart`") or die('query failed');
          $rows_count = mysqli_num_rows($select_rows);
          ?>

      <div class="d-flex align-items-center gap-4">

        <div class="cart-icon-container">
        <a href="cart.php" class="cart-icon">
              <i class="fas fa-shopping-cart"></i>
         </a>
       <span class="cart-count"><?php echo $rows_count; ?></span>
       </div>

       <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
      </button>
</div>

      </div>
      </nav>
    <!-- end navbar -->
   

    <div class="container" id="login">
      <div class="row">
          <div class="col-md-5 " id="side1">
              <h3 class="Welcome">Welcome Back!</h3>
          </div>
          <div class="col-md-7 py-3 py-md-0" id="side2">
              <h3 class="text-center">Account login</h3>
              <p class="text-center">Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, sequi.</p>
              <div class="input2 text-center">
              <form action="">
                <input type="name" placeholder="User Name">
                <input type="password" placeholder="Password"> 
                <input id="inplog" type="submit" class="btn btn-warning" value="LOG IN">
                <p class="text-center">Forgot Password<a href="#">Click</a></p>

              </form>
            </div>
          </div>
  
      </div>
     </div>
     <script src="bootstrap.bundle.min.js"></script>
</body>
</html>