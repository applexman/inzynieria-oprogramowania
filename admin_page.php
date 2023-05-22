<?php
session_start();
if ((!isset($_SESSION['permissions'])) || ($_SESSION['permissions'] != 1)) {
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
            <div class="col col-md-5">
                <h2>Products</h2>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">id#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Description</th>
                            <th scope="col">Img</th>
                            <th scope="col">Price</th>
                            <th scope="col">Edit</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        require_once "database_connect.php";


                        function getProducts($connection)
                        {
                            $products = array();
                            $sql = "SELECT * FROM products";
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
                                    <td>' . $product['price'] . '</td>
                                    <td><a class="btn btn-outline-danger shadow btn-sm" role="button" href="edit_product.php?id=' . $product['id'] . '">Edit</a>
                                </tr>';
                        }

                        ?>
                        <tr><a class="btn" href="add_product.php">Dodaj produkt</a></tr>
                    </tbody>
                </table>
            </div>
            <div class="col col-md-5">
                <h2>Orders</h2>
                <table class="table table-striped table-hover table-sm">
                    <thead>
                        <tr>
                            <th scope="col">id#</th>
                            <th scope="col">User ID</th>
                            <th scope="col">Total</th>
                            <th scope="col">Name | Quantity</th>
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
                            $sql = "SELECT products.name AS productName, orderdetail.quantity AS quantity, orderdetail.idOrder FROM `products`, `orderdetail` WHERE products.id=orderdetail.idProduct";
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
                            </tr>';
                        }
                        
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="col col-md-2">
                <h2>Users</h2>
                <table class="table table-striped table-hover table-sm">
                    <thead>
                        <tr>
                            <th scope="col">id#</th>
                            <th scope="col">Email</th>
                            <th scope="col">Stopień uprawnień</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        require_once "database_connect.php";

                        function getUsers($connection)
                        {
                            $products = array();
                            $sql = "SELECT * FROM users";
                            $result = $connection->query($sql);
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $products[] = $row;
                                }
                            }
                            return $products;
                        }


                        foreach (getUsers($connection) as $user) {
                            echo
                            '<tr>
                                    <th scope="row">' . $user['id'] . '</th>
                                    <td>' . $user['email'] . '</td>
                                    <td>' . $user['permissions'] . '</td>
                                </tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>







    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="assets/js/bold-and-bright.js"></script>
</body>

</html>