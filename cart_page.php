<?php
session_start();
$_SESSION['total'] = 0;

if (!isset($_SESSION['logged_flag'])) {
    header('Location: index.php');
    exit();
}
if (isset($_SESSION['alert_msg'])) {
    echo
    '<div class="alert alert-' . $_SESSION['alert_type'] . '" role="alert">' . $_SESSION['alert_msg'] . '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Najlepszy sklep</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&amp;display=swap">
</head>

<body>
    <?php require 'navbar.php'; ?>

    <section class="vh-auto" ;">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col">
                    <p><span class="h2 m-3">Koszyk </span>
                        <?php
                        require_once "database_connect.php";

                        if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
                            echo '<span class="h4">(Twój koszyk jest pusty)</span></p>';
                        } else {

                            $user = $_SESSION['id'];
                            $sql = "SELECT * FROM shipping WHERE userID = $user";
                            $result = $connection->query($sql);
                            $row = $result->fetch_assoc();
                            if ($result->num_rows > 0) {

                                $name = $row['name'];
                                $surname = $row['surname'];
                                $city = $row['city'];
                                $street = $row['street'];
                                $post = $row['post'];
                                $email = $row['email'];
                                $phone = $row['phone'];
                            } else {

                                $name = "";
                                $surname = "";
                                $city = "";
                                $street = "";
                                $post = "";
                                $email = "";
                                $phone = "";
                            }

                            echo '<span class="h4">(' . count($_SESSION['cart']) . ' pozycje w koszyku)</span></p>';
                            if (isset($_GET['error']) && $_GET['error'] === 'quantity') {
                                echo '<div class="alert alert-danger" role="alert">Wprowadzono maksymalną ilość danego towaru.</div>';
                            }
                            foreach ($_SESSION['cart'] as $product) {
                                $product_id = $product['id'];
                                $quantity = $product['quantity'];
                                $sql = "SELECT * FROM products WHERE id = $product_id";
                                $result = $connection->query($sql);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $_SESSION['total'] += $row['price'] * $quantity;
                                        echo
                                        '<div class="card mb-5">
                                        <div class="card-body p-5">
                
                                            <div class="row align-items-center">
                                                <div class="col-md-1">
                                                    <img src="assets/img/products/' . $row['img'] . '" class="img-fluid rounded" alt="">
                                                </div>
                                                <div class="col-md-4 d-flex">
                                                    <div>
                                                        <p class="small text-muted mb-2 pb-3">Nazwa</p>
                                                        <p class="lead fw-normal mb-2">' . $row['name'] . '</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-2 d-flex justify-content-center">
                                                    <div>
                                                        <p class="small text-muted mb-2 pb-3">Ilość</p>
                                                        <p class="lead fw-normal mb-0">' . $quantity . '</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-2 d-flex justify-content-center">
                                                <div>
                                                <p class="small text-muted mb-2 pb-3">Zmień ilość</p>
                                                    <form action="cart_change.php" method="post">
                                                        <input type="hidden" name="increase_quantity" value='. $product_id .'>
                                                        <button type="submit" class="btn btn-success">+</button>
                                                    </form>
                                                    <form action="cart_change.php" method="post">
                                                        <input type="hidden" name="decrease_quantity" value='. $product_id .'>
                                                        <button type="submit" class="btn btn-danger">-</button>
                                                    </form>
                                                </div>
                                            </div>
                                                <div class="col-md-2 d-flex justify-content-center">
                                                    <div>
                                                        <p class="small text-muted mb-2 pb-3">Cena</p>
                                                        <p class="lead fw-normal mb-0">' . $row['price'] * $quantity . ' zł</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        </div>';
                                    }
                                }
                            }
                            echo
                            '
                            <div class="d-flex justify-content-end">
                            <a class="btn btn-danger btn-lg ms-3" href="unset_cart.php" role="button">Wyczyść koszyk</a>
                            </div>
                        <h3 class="mt-5">Dane do wysyłki:</h3>
                        <form class="row g-3 needs-validation" action="order_script.php" method="POST">
                            <div class="col-md-6">
                                <label for="name" class="form-label">Imię</label>
                                <input type="text" class="form-control" id="name" name="name" value="' . $name . '" required>
                            </div>
                            <div class="col-md-6">
                                <label for="surname" class="form-label">Nazwisko</label>
                                <input type="text" class="form-control" id="surname" name="surname" value="' . $surname . '" required>
                            </div>
                            <div class="col-md-4">
                                <label for="city" class="form-label">Miejscowość</label>
                                <input type="text" class="form-control" id="city" name="city" rows="3" value="' . $city . '" required></input>
                            </div>
                            <div class="col-md-4">
                            <label for="street" class="form-label">Ulica</label>
                            <input type="text" class="form-control" id="street" name="street" rows="3" value="' . $street . '" required></input>
                        </div>
                        <div class="col-md-4">
                            <label for="post" class="form-label">Kod pocztowy</label>
                            <input type="text" class="form-control" id="post" name="post" rows="3" value="' . $post . '" required></input>
                        </div>
                        <div class="col-md-4">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="' . $email . '" required>
                        </div>
                            <div class="col-md-4">
                                <label for="phone" class="form-label">Numer telefonu</label>
                                <input type="tel" class="form-control" id="phone" name="phone" value="' . $phone . '" required>
                            </div>
                            <div class="col-md-4">
                            <label class="form-label">Sposób płatności</label>
                            <div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="cash_on_delivery" name="payment_method" value="Za pobraniem" required>
                                    <label class="form-check-label" for="cash_on_delivery">Za pobraniem</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="bank_transfer" name="payment_method" value="Przelew bankowy" required>
                                    <label class="form-check-label" for="bank_transfer">Przelew bankowy</label>
                                </div>
                            </div>
                        </div>
                            <div class="card mb-5">
                            <div class="card-body p-4">
                                <div class="float-end">
                                    <p class="mb-0 me-5 d-flex align-items-center">
                                    <b>
                                        <span class="text-muted me-2">Razem:</span> <span class="lead fw-normal">' . $_SESSION['total'] . ' zł</span>
                                    </b>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary btn-lg ms-3" value="Zapłać">Zamów</button>
                        </div>
                        </form>';
                        }
                        ?>
                </div>
            </div>
        </div>
        </div>
    </section>

    <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>