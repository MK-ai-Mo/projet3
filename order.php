<?php
require_once("Admin/config.php");

$select_cart = "SELECT * FROM `cart`";
$data_cart = mysqli_query($con, $select_cart);

$total = 0;
$total_products = '';
$cart_items = []; 
while ($row = mysqli_fetch_array($data_cart)) {
    $total += $row['price'] * $row['quantity'];
    $total_products .= $row['name'] . ' (' . $row['quantity'] . '), ';
    $cart_items[] = $row; 
}
$total_products = rtrim($total_products, ', ');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            color: #333;
        }

        .container {
            margin: 20px auto;
            background-color: #ffffff;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            max-width: 500px;
        }

        h1 {
            color: #007bff;
            font-size: 1.5em;
            margin-bottom: 15px;
            text-align: center;
        }

        .form-group label {
            font-weight: bold;
        }

        .form-control {
            border-radius: 4px;
            padding: 8px;
            border: 1px solid #ced4da;
            font-size: 0.9em;
        }

        .form-control:focus {
            border-color: #007bff;
            box-shadow: none;
        }

        .btn-success {
            background-color: #28a745;
            border: none;
            padding: 10px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            font-size: 0.9em;
        }

        .btn-success:hover {
            background-color: #218838;
        }

        .total {
            font-size: 1.2em;
            font-weight: bold;
            margin-top: 15px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Order</h1>
        
        <form method="POST" action="order_confirmation.php">
            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="number">Phone Number</label>
                <input type="text" name="number" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="flat">Flat Number</label>
                <input type="text" name="flat" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="street">Street Name</label>
                <input type="text" name="street" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="city">City</label>
                <input type="text" name="city" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="state">State</label>
                <input type="text" name="state" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="country">Country</label>
                <input type="text" name="country" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="pin">PIN Code</label>
                <input type="text" name="pin" class="form-control" required>
            </div>
            <input type="hidden" name="total_products" value="<?php echo htmlspecialchars($total_products); ?>">
            <input type="hidden" name="total_price" value="<?php echo htmlspecialchars($total); ?>">
            <div class="total">Total: <?php echo htmlspecialchars($total); ?> $</div>
            <button type="submit" class="btn btn-success btn-block mt-3">Place Order</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
