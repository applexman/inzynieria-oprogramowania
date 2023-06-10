<?php
session_start();
require_once "database_connect.php";

if (!isset($_SESSION['logged_flag'])) {
    header('Location: index.php');
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $surname = $_POST["surname"];
    $city = $_POST["city"];
    $street = $_POST["street"];
    $post = $_POST["post"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $user = $_SESSION['id'];

    $sql = "SELECT * FROM shipping WHERE userID = $user";
    $result = $connection->query($sql);

    if ($result->num_rows > 0) {

        $sql = "UPDATE shipping
                SET name = '$name', surname = '$surname', city = '$city', street = '$street', post = '$post', email = '$email', phone = '$phone'
                WHERE userID = $user";

        if ($connection->query($sql) === TRUE) {
            header('Location: customer_page.php');
        } else {
            echo "Błąd: " . $sql . "<br>" . $connection->error;
        }
    } else {
        $sql = "INSERT INTO shipping
                VALUES (NULL, '$name', '$surname', '$city', '$street', '$post', '$email', '$phone', $user)";

        if ($connection->query($sql) === TRUE) {
            header('Location: customer_page.php');
        } else {
            echo "Błąd: " . $sql . "<br>" . $connection->error;
        }
    }

    $connection->close();
}
?>
