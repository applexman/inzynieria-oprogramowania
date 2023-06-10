<?php
session_start();




if (isset($_POST['increase_quantity'])) {
    $productId = $_POST['increase_quantity'];
    updateQuantityInCart($productId, 1);
}

if (isset($_POST['decrease_quantity'])) {
    $productId = $_POST['decrease_quantity'];
    updateQuantityInCart($productId, -1);
}

function updateQuantityInCart($productId, $change) {

    require_once "database_connect.php";
    $sql = "SELECT quantity FROM products WHERE id = $productId";
    $result = $connection->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $availableQuantity = $row['quantity'];{
            if (isset($_SESSION['cart'])) {
                foreach ($_SESSION['cart'] as $key => &$item) {
                    if ($item['id'] == $productId) {
                        $newQuantity = $item['quantity'] + $change;
                        if($newQuantity>0 && $newQuantity <=$availableQuantity){
                            $item['quantity'] = $newQuantity;
                        }
                        else{
                            if($newQuantity==0){
                                unset($_SESSION['cart'][$key]);
                            }
                            else{
                                header('Location: cart_page.php?' . $productId . '&error=quantity');
                                exit();
                            }
                            
                        }
                        break;
                    }
                }
            }
        }
    }

    header('Location: cart_page.php');
    exit();
}
?>
