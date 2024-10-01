<?php
require_once("Admin/config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
    $name = htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8');
    $number = htmlspecialchars($_POST['number'], ENT_QUOTES, 'UTF-8');
    $email = htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');
    // $method = htmlspecialchars($_POST['method'], ENT_QUOTES, 'UTF-8');
    $flat = htmlspecialchars($_POST['flat'], ENT_QUOTES, 'UTF-8');
    $street = htmlspecialchars($_POST['street'], ENT_QUOTES, 'UTF-8');
    $city = htmlspecialchars($_POST['city'], ENT_QUOTES, 'UTF-8');
    $state = htmlspecialchars($_POST['state'], ENT_QUOTES, 'UTF-8');
    $country = htmlspecialchars($_POST['country'], ENT_QUOTES, 'UTF-8');
    $pin = htmlspecialchars($_POST['pin'], ENT_QUOTES, 'UTF-8');
    $total_products = htmlspecialchars($_POST['total_products'], ENT_QUOTES, 'UTF-8');
    $total_price = htmlspecialchars($_POST['total_price'], ENT_QUOTES, 'UTF-8');

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "البريد الإلكتروني غير صحيح.";
        exit();
    }

   
    $stmt = $con->prepare("INSERT INTO `orders` (name, number, email, flat, street, city, state, country, pin, total_products, total_price) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    if ($stmt === false) {
        echo "حدث خطأ أثناء إعداد الاستعلام.";
        exit();
    }

    $stmt->bind_param("ssssssssssd", $name, $number, $email, $flat, $street, $city, $state, $country, $pin, $total_products, $total_price);
    
    if ($stmt->execute()) {
        if (!$con->query("DELETE FROM `cart`")) {
            echo "حدث خطأ أثناء مسح السلة.";
            exit();
        }
    } else {
        echo "حدث خطأ أثناء تقديم الطلب.";
        exit();
    }

    $stmt->close();
} else {
    echo "تم الوصول إلى هذه الصفحة بطريقة غير صحيحة.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            color: #333;
        }

        .container {
            margin: 20px auto;
            background-color: #ffffff;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            max-width: 600px;
        }

        h1 {
            color: #4CAF50;
            font-size: 1.8em;
            margin-bottom: 15px;
            text-align: center;
        }

        .order-details {
            margin-bottom: 20px;
        }

        .order-details p {
            margin: 8px 0;
            font-size: 1em;
        }

        .order-details strong {
            color: #555;
        }

        .total {
            font-size: 1.2em;
            font-weight: bold;
            color: #4CAF50;
            margin-top: 15px;
            text-align: center;
        }

        .redirect-message {
            text-align: center;
            margin-top: 20px;
        }

        .redirect-message a {
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
        }

        .redirect-message a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Order Confirmation</h1>

        <div class="order-details">
            <h2>Thank You for Your Order!</h2>
            <p><strong>Full Name:</strong> <?php echo htmlspecialchars($name, ENT_QUOTES, 'UTF-8'); ?></p>
            <p><strong>Phone Number:</strong> <?php echo htmlspecialchars($number, ENT_QUOTES, 'UTF-8'); ?></p>
            <p><strong>Email Address:</strong> <?php echo htmlspecialchars($email, ENT_QUOTES, 'UTF-8'); ?></p>
            <p><strong>Address:</strong> <?php echo htmlspecialchars($flat . ', ' . $street . ', ' . $city . ', ' . $state . ', ' . $country . ', ' . $pin, ENT_QUOTES, 'UTF-8'); ?></p>
        </div>

        <div class="products-list">
            <h3>Order Details:</h3>
            <?php
          
            $products = explode(', ', $total_products);
            foreach ($products as $product) {
                list($name, $quantity) = explode(' (', rtrim($product, ')'));
                echo "<p>" . htmlspecialchars($name, ENT_QUOTES, 'UTF-8') . ": " . htmlspecialchars($quantity, ENT_QUOTES, 'UTF-8') . "</p>";
            }
            ?>
        </div>

        <div class="total">
            Total Price: <?php echo htmlspecialchars($total_price, ENT_QUOTES, 'UTF-8'); ?> $
        </div>

        <p class="redirect-message">We appreciate your business and hope to see you again soon! One of our team members will contact you shortly to confirm your order. You will be redirected to the homepage shortly. If not, <a href="index.php">here</a>.</p>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
