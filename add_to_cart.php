<?php
session_start();

if (!isset($_SESSION['email'])) {
    header('Location: login_page.php');
    exit();
}

if (empty($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

$product = $_POST['id'];
$quantity = $_POST['quantity'];

require_once "database_connect.php";
$sql = "SELECT quantity FROM products WHERE id = $product";
$result = $connection->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $availableQuantity = $row['quantity'];

    if ($quantity <= $availableQuantity) {
        $existingProductKey = null;
        foreach ($_SESSION['cart'] as $key => $item) {
            if ($item['id'] == $product) {
                $existingProductKey = $key;
                break;
            }
        }
    
        $totalQuantityInCart = $quantity;
        if ($existingProductKey !== null) {
            $totalQuantityInCart += $_SESSION['cart'][$existingProductKey]['quantity'];
        }
    
        if ($totalQuantityInCart <= $availableQuantity) {
            if ($existingProductKey !== null) {
                $_SESSION['cart'][$existingProductKey]['quantity'] += $quantity;
            } else {
                $productData = array(
                    'id' => $product,
                    'quantity' => $quantity
                );
                $_SESSION['cart'][] = $productData;
            }

        $cartIds = array_column($_SESSION['cart'], 'id');
        $cartQuantities = array_column($_SESSION['cart'], 'quantity');

        header('Location: product_page.php?id=' . $product);
        exit();
    } else {
        header('Location: product_page.php?id=' . $product . '&error=quantity');
        exit();
    }
} else {
    header('Location: product_page.php?id=' . $product . '&error=quantity');
    exit();
}
}
?>
