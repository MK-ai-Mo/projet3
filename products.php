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
    <title>Electronic Shop2</title>
    <link rel="stylesheet" href="CSS/style1.css">
    <link rel="stylesheet" href="CSS/styleCart.css">
    <link rel="stylesheet" href="CSS/styleFoter.css">
    <link rel="stylesheet" href="CSS/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
      .arrow i img{
      position: fixed;
    width: 50px;
    height: 50px;
    bottom: 50px;
    right: 50px;
     text-decoration: none;
    text-align: center;
    line-height: 50px;
      }




    </style>
</head>
<body>
    <!-- star navbar -->
    <nav class="navbar navbar-expand-lg fixed-">
        <div class="container">
          <a class="navbar-brand" href="#"><span class="spElectronic"><span class="spE">E</span>lectronic</span><span class="spShop"> Shop</span></a>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav m-auto px-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link " aria-current="page" href="index.php">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="products.php">Product</a>
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

    <?php
if (isset($message)) {
    foreach ($message as $msg) {
        echo "<div class='alert alert-info'>
                <span class='closebtn'>&times;</span>
                $msg
              </div>";
    }
}
?>

    <div class="products">
      <div class="container">
        <div class="row">
          <h1 id="idproduts" class="titreh1">PRODUCTS</h1>
          <div class="cardproducts">

            <?php
         while ($row = mysqli_fetch_array($data)) {
           ?>
              <div class="card">
              <img class="product-image" src="Admin/uploads/<?php echo $row['img'];?>" alt="<?php echo $row['nom'];?>">               
                <h3 class="nomprod"><?php echo $row['nom']; ?></h3>
                <p><?php echo $row['descreption']; ?></p>
                <span>
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                </span>
                  <span class="product-price"><?php echo $row['prix']; ?><span> $</span></span>
                  <form method="POST" action="">
                    <input type="hidden" name="name" value="<?php echo $row['nom']; ?>">
                    <input type="hidden" name="price" value="<?php echo $row['prix']; ?>">
                    <input type="hidden" name="image" value="<?php echo $row['img']; ?>">
                    <button type="submit" name="add-to-cart" class="btn btn-outline-warning">Add to cart</button>
                </form>    
                </div>
            <?php   } ?>

        </div>
      </div>

    </div>
    </div>
      <br>




    <!-- footer -->
    <footer id="footer">
      <div class="footer-top">
        <div class="container">
          <div class="row">

            <div class="col-lg-3 col-md-6 footer-contact">
              <h3>Electronic Shop</h3>
              <p>
                Karachi <br>
                Sindh <br>
                Pakistan <br>
              </p>
              <strong>Phone:</strong> +000000000000000 <br>
              <strong>Email:</strong> electronicshop@.com <br>
            </div>

            <div class="col-lg-3 col-md-6 footer-links">
              <h4>Usefull Links</h4>
             <ul>
              <li><a href="#">Home</a></li>
              <li><a href="#">About Us</a></li>
              <li><a href="#">Services</a></li>
              <li><a href="#">Terms of service</a></li>
              <li><a href="#">Privacy policey</a></li>
             </ul>
            </div>



           

            <div class="col-lg-3 col-md-6 footer-links">
              <h4>Our Services</h4>

             <ul>
              <li><a href="#">PS 5</a></li>
              <li><a href="#">Computer</a></li>
              <li><a href="#">Gaming Laptop</a></li>
              <li><a href="#">Mobile Phone</a></li>
              <li><a href="#">Gaming Gadget</a></li>
             </ul>
            </div>

            <div class="col-lg-3 col-md-6 footer-links">
              <h4>Our Social Networks</h4>
              <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quia, quibusdam.</p>

              <div class="socail-links mt-3">
                <a href="#"><i class="fa-brands fa-twitter"></i></a>
                <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                <a href="#"><i class="fa-brands fa-instagram"></i></a>
                <a href="#"><i class="fa-brands fa-skype"></i></a>
                <a href="#"><i class="fa-brands fa-linkedin"></i></a>
              </div>
            
            </div>

          </div>
        </div>
      </div>
      <hr>
      <div class="container py-4">
        <div class="copyright">
          &copy; Copyright <strong><span>Electronic Shop</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
          Designed by <a href="#">SA coding</a>
        </div>
      </div>
    </footer>
    <!-- footer -->
  
  
  
  
  
  
      <a href="#" class="arrow"><i><img src="image/arrow.png" alt=""></i></a>
  
        
      
    <script src="bootstrap.bundle.min.js"></script>
    <script>
document.addEventListener('DOMContentLoaded', () => {
    const closeButtons = document.querySelectorAll('.closebtn');

    closeButtons.forEach(button => {
        button.addEventListener('click', () => {
            button.parentElement.style.display = 'none';
        });
    });
});
</script>
</body>
</html>