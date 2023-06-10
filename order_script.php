<?php
session_start();
require_once "database_connect.php";

if (!isset($_SESSION['logged_flag'])) {
    header('Location: index.php');
    exit();
}


$name = $_POST['name'];
$surname = $_POST['surname'];
$city = $_POST['city'];
$street = $_POST['street'];
$post = $_POST['post'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$payment = $_POST['payment_method'];
print_r($_POST);
try {
    if ($connection->connect_errno != 0) {
        throw new Exception(mysqli_connect_errno());
    } else {
        $currentDate = date('Y-m-d');
        if ($connection->query("INSERT INTO orders VALUES (NULL, '{$_SESSION['id']}','{$_SESSION['total']}', '$currentDate', 'Złożone', '$name', '$surname', '$city', '$street', '$post', '$email', '$phone', '$payment')")) {
            $orderId = $connection->insert_id;
            foreach ($_SESSION['cart'] as $key => $value) {
                $product_id = $value['id'];
                $quantity = $value['quantity'];
                $connection->query("INSERT INTO orderdetail VALUES (NULL, '$orderId','$product_id', '$quantity')");
                $sql = "SELECT quantity FROM products WHERE id='$product_id'";
                $result = $connection->query($sql);
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $currentQuantity = $row['quantity'];
                    $newQuantity = $currentQuantity - $quantity;
                    $connection->query("UPDATE products SET quantity='$newQuantity' WHERE id='$product_id'");
                }
            }
            $_SESSION['alert_msg'] = "Gratulacje! Twoje zamówienie zostało złożone!";
            $_SESSION['alert_type'] = "success";
            unset($_SESSION['cart']);
            header('Location: confirm_order_page.php');
        } else {
            throw new Exception($connection->error);
        }
        $connection->close();
    }
} catch (Exception $e) {
    echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o rejestrację w innym terminie!</span>';
    echo '<br />Informacja developerska: ' . $e;
}
?>
