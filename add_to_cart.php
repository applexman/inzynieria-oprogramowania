<?php

// Rozpoczynamy nową sesję, jednocześnie zachowując istniejącą sesję
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

// Sprawdzamy, czy produkt o takim samym ID już istnieje w koszyku
$existingProductKey = null;
foreach ($_SESSION['cart'] as $key => $item) {
    if ($item['id'] == $product) {
        $existingProductKey = $key;
        break;
    }
}



if ($existingProductKey !== null) {
    // Produkt o takim samym ID już istnieje w koszyku, aktualizujemy tylko ilość
    $_SESSION['cart'][$existingProductKey]['quantity'] += $quantity;
} else {
    // Produkt nie istnieje w koszyku, dodajemy go wraz z ilością
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
?>