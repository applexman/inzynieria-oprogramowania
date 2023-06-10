<?php
session_start();
if (!isset($_SESSION['logged_flag'])) {
    header('Location: index.php');
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Najlepszy sklep</title>
    <link type="image/png" sizes="32x32" rel="icon" href=".../icons8-shopping-cart-32.png">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&amp;display=swap">
</head>

<body>
    <?php require 'navbar.php'; ?>

    <header class="bg-primary-gradient vh-100">
        <div class="container pt-4 pt-xl-5">
            <div class="row pt-5">
                <div class="col-md-8 col-xl-6 text-center text-md-start mx-auto">
                    <div class="text-center">
                        <?php
                        if (isset($_GET['payment']) && isset($_GET['id']) && isset($_GET['total'])) {
                            $payment = $_GET['payment'];
                            $orderId = $_GET['id'];
                            $total = $_GET['total'];

                            echo '<h2>Twoje zamówienie zostało złożone</h2>';
                            echo '<p>Numer zamówienia: ' . $orderId . '</p>';


                            if ($payment == 'przelew') {
                                echo '<p>Suma do zapłaty: ' . $total . 'zł</p>';
                                echo '<h2>Dane do przelewu</h2>';
                                echo '<p>
                                Odbiorca: Księgarnia internetowa<br>
                                Numer rachunku bankowego: 12345678901234567890<br>
                                Bank: Najlepszy Bank<br>
                                Adres banku: ul. Bankowa 1, 00-000 Poznań</p>';
                            } else if ($payment == 'inny') {
                                echo '<p>Suma do zapłaty u kuriera: ' . $total . 'zł</p>';
                            }
                        } else {
                            echo '<h1>Błąd: Brak wystarczających informacji o zamówieniu</h1>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <?php include 'newsletter.php'; ?>
    </header>

    <?php
    include 'footer.php';
    ?>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="assets/js/bold-and-bright.js"></script>
</body>

</html>