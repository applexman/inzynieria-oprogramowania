<?php
session_start();
if ((!isset($_SESSION['permissions'])) || ($_SESSION['permissions'] != 1 && $_SESSION['permissions'] != 2)) {
    header('Location: login_page.php');
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
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&amp;display=swap">
</head>

<body>
    <?php require_once 'navbar.php'; ?>

    <div class="container text-center">
        <div class="row">
        <div class="col col-md-12">
                <h2>Zamówienia</h2>
                <table class="table table-striped table-hover table-sm">
                    <thead>
                        <tr>
                            <th scope="col">id#</th>
                            <th scope="col">ID Użytkownika</th>
                            <th scope="col">Suma</th>
                            <th scope="col">Nazwa | Ilość</th>
                            <th scope="col">Adres dostawy
                            <th scope="col">Status</th>
                            <th scope="col">Zmień status</th>
                            <th scope="col">Anuluj zamówienie</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        require_once "database_connect.php";

                        function getOrders($connection)
                        {
                            $orders = array();
                            $sql = "SELECT * FROM orders";
                            $result = $connection->query($sql);
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $orders[] = $row;
                                }
                            }
                            return $orders;
                        }
                        function getOrdersDetail($connection)
                        {
                            $ordersD = array();
                            $sql = "SELECT products.name AS productName, orderdetail.quantity AS quantity, orderdetail.idOrder 
                            FROM `products`, `orderdetail`
                            WHERE products.id=orderdetail.idProduct";
                            $result = $connection->query($sql);
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $ordersD[] = $row;
                                }
                            }
                            return $ordersD;
                        }

                        foreach (getOrders($connection) as $order) {
                            echo '
                            <tr>
                                <th scope="row">' . $order['id'] . '</th>
                                <td>' . $order['idUser'] . '</td>
                                <td>' . $order['total'] . '</td>
                                <td>';

                            foreach (getOrdersDetail($connection) as $orderD) {
                                if ($order['id'] == $orderD['idOrder']) {
                                    echo '
                                    <p>' . $orderD['productName'] . ' | ' . $orderD['quantity'] . '</p>';
                                }
                            }

                            echo '
                                </td>
                                <td>' . $order['name'] .' '. $order['surname'] . '<br>' . $order['city'] . ' ' . $order['post'] . '<br>' . $order['street'] .' </td>
                                <td>' . $order['status'] . '</td>
                                <td><a class="btn btn-outline-danger shadow btn-sm" role="button" href="change_status_script.php?id=' . $order['id'] . '">Zmień</a></td>
                                <td><a class="btn btn-outline-danger shadow btn-sm" role="button" href="cancel_status_script.php?id=' . $order['id'] . '">Anuluj</a></td>
                            </tr>';
                        }

                        ?>
                    </tbody>
                </table>
            </div>
            <div class="col col-md-8">
                <h2>Produkty</h2>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">id#</th>
                            <th scope="col">Nazwa</th>
                            <th scope="col">Opis</th>
                            <th scope="col">Nazwa obrazka</th>
                            <th scope="col">Cena</th>
                            <th scope="col">Kategoria</th>
                            <th scope="col">Ilość</th>
                            <th scope="col">Edytuj</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        require_once "database_connect.php";


                        function getProducts($connection)
                        {
                            $products = array();
                            $sql = "SELECT products.id, products.name, products.description, products.price, products.img, products.quantity, categories.name as categories
                            FROM products, categories
                            WHERE products.categoryId= categories.id
                            ORDER BY products.id;";
                            $result = $connection->query($sql);
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $products[] = $row;
                                }
                            }
                            return $products;
                        }


                        foreach (getProducts($connection) as $product) {
                            echo
                            '<tr>
                                <th scope="row">' . $product['id'] . '</th>
                                    <td>' . $product['name'] . '</td>
                                    <td>' . $product['description'] . '</td>
                                    <td>' . $product['img'] . '</td>
                                    <td>' . $product['categories'] . '</td>
                                    <td>' . $product['price'] . '</td>
                                    <td>' . $product['quantity'] . '</td>
                                    <td><a class="btn btn-outline-danger shadow btn-sm" role="button" href="edit_product.php?id=' . $product['id'] . '">Edytuj</a><td>
                                </tr>';
                        }

                        ?>
                        <tr><a class="btn btn-outline-info btn-sm" href="add_product.php">Dodaj produkt</a></tr>
                    </tbody>
                </table>
            </div>
            <div class="col col-md-4">
                <h2>Kategorie</h2>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">id#</th>
                            <th scope="col">Nazwa</th>
                            <th scope="col">Edytuj</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        require_once "database_connect.php";
                        function getCategories($connection){
                            $sql= "SELECT * FROM categories";
                            $result = $connection->query($sql);
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $categories[] = $row;
                                }
                            }
                            return $categories;
                        }

                        foreach (getCategories($connection) as $category) {
                            echo
                            '<tr>
                                <th scope="row">' . $category['id'] . '</th>
                                    <td>' . $category['name'] . '</td>
                                    <td><a class="btn btn-outline-danger shadow btn-sm" role="button" href="edit_category.php?id=' . $category['id'] . '">Edytuj</a></td>
                                </tr>';
                        }

                        ?>
                        <tr><a class="btn btn-outline-info btn-sm" href="add_category.php">Dodaj kategorię</a></tr>
                    </tbody>
                </table>
            </div>
            
    </div>
    </div>

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="assets/js/bold-and-bright.js"></script>
</body>

</html>