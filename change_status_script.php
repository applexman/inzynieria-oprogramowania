<?php
session_start();
require_once "database_connect.php";

if (isset($_GET['id'])) {
    $orderId = $_GET['id'];

    $sql = "SELECT status FROM orders WHERE id = $orderId";
    $result = $connection->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $currentStatus = $row['status'];
        $newStatus = ($currentStatus == 'Paid') ? 'Sent' : 'Paid';

        $updateSql = "UPDATE orders SET status = '$newStatus' WHERE id = $orderId";
        
        if ($connection->query($updateSql) === TRUE) {
            header('Location: employee_page.php');
        } else {
            echo "Wystąpił błąd podczas zmiany statusu zamówienia: " . $connection->error;
        }
    } else {
        echo "Nie znaleziono zamówienia o podanym identyfikatorze.";
    }
} else {
    echo "Nieprawidłowy identyfikator zamówienia.";
}

$connection->close();
?>
