<?php
require_once("Admin/config.php");

if (isset($_POST['update-quantity'])) {
    $id = $_POST['id'];
    $quantity = $_POST['quantity'];
    mysqli_query($con, "UPDATE `cart` SET `quantity`=$quantity WHERE `id`=$id");
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($con, "DELETE FROM `cart` WHERE `id`=$id");
}

$select_cart = "SELECT * FROM `cart`";
$data_cart = mysqli_query($con, $select_cart);

$total = 0;
while ($row = mysqli_fetch_array($data_cart)) {
    $total += $row['price'] * $row['quantity'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="CSS/styleCart.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7f6;
            color: #333;
        }

        .cart-container {
            margin: 20px auto;
            background-color: #ffffff;
            border: 1px solid #e2e2e2;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 1200px;
        }

        h1 {
            color: #007bff;
            margin-bottom: 20px;
        }

        .cart-table th {
            background-color: #007bff;
            color: #ffffff;
        }

        .cart-table img {
            max-width: 100px; 
            height: auto;
            border-radius: 5px;
        }

        .cart-table td, .cart-table th {
            padding: 15px;
            text-align: left;
            vertical-align: middle;
        }

        .cart-table button {
            background-color: olive;
            color: #ffffff;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .cart-table button:hover {
            background-color: #138496;
        }

        .cart-table a {
            color: blue;
            text-decoration: none;
            font-weight: bold;
        }

        .cart-table a:hover {
            text-decoration: underline;
        }

        .cart-summary {
            margin-top: 20px;
            text-align: right;
            padding-top: 10px;
            border-top: 1px solid #e2e2e2;
        }

        .cart-summary h3 {
            margin: 0;
            font-size: 1.5em;
            color: #333;
        }

        .cart-summary button {
            background-color: #28a745;
            color: #ffffff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-top: 10px;
        }

        .cart-summary button:hover {
            background-color: #218838;
        }

        .form-control {
            width: 80px; 
            display: inline-block;
        }

        .btn-warning, .btn-danger {
            font-size: 0.9em;
            padding: 5px 10px;
        }
    </style>
</head>
<body>

    <div class="container cart-container">
        <h1 class="text-center">Shopping Cart</h1>
        <table class="table table-striped table-responsive cart-table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Image</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                mysqli_data_seek($data_cart, 0);
                while ($row = mysqli_fetch_array($data_cart)) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                        <td><img src="Admin/uploads/<?php echo htmlspecialchars($row['image']); ?>" alt="<?php echo htmlspecialchars($row['name']); ?>" class="img-fluid"></td>
                        <td><?php echo htmlspecialchars($row['price']); ?> $</td>
                        <td>
                            <form method="POST" action="">
                                <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id']); ?>">
                                <input type="number" name="quantity" value="<?php echo htmlspecialchars($row['quantity']); ?>" class="form-control" min="1">
                                <button type="submit" name="update-quantity" class="btn btn-warning btn-sm">Update</button>
                            </form>
                        </td>
                        <td><?php echo htmlspecialchars($row['price'] * $row['quantity']); ?> $</td>
                        <td><a href="cart.php?delete=<?php echo htmlspecialchars($row['id']); ?>" class="btn btn-info btn-sm">Delete</a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <div class="cart-summary">
            <h3>Total: <?php echo htmlspecialchars($total); ?> $</h3>
            <form method="POST" action="order.php">
    <button type="submit" class="btn btn-success">Checkout</button>
</form>        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
