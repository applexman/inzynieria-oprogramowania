<?php
session_start();

if (!isset($_SESSION['email'])) {
    header('Location: login_page.php');
    exit();
}

require_once "database_connect.php";

$product = $_POST['id'];
$reviewText = $_POST['comment'];
$star = $_POST['rating'];

try {
    if ($connection->connect_errno != 0) {
        throw new Exception(mysqli_connect_errno());
    } else {
        $currentDate = date('Y-m-d');
        if ($connection->query("INSERT INTO reviews VALUES (NULL, '$product','{$_SESSION['id']}', '$reviewText', $star, '$currentDate')")) {
            $_SESSION['alert_msg'] = "Dziękujemy za złożenie recenzji o produkcie!";
            $_SESSION['alert_type'] = "success";
        } else {
            throw new Exception($connection->error);
        }
        $connection->close();
    }
} catch (Exception $e) {
    echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o rejestrację w innym terminie!</span>';
    echo '<br />Informacja developerska: ' . $e;
}

header('Location: product_page.php?id=' . $product);
?>