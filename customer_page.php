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
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&amp;display=swap">
</head>

<body>
    <?php require_once 'navbar.php'; ?>

    <div class="container text-center">
        <div class="row">
            <div class="col col-md-14">
                <h2>Twoje zamówienia</h2>

                <tbody>
                    <?php
                    require_once "database_connect.php";

                    function getOrders($connection)
                    {
                        $orders = array();
                        $user = $_SESSION['id'];
                        $sql = "SELECT * FROM orders WHERE $user = idUser";
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

                    $orders = getOrders($connection);
                    if (empty($orders)) {
                        echo '<tr><h3>Nic jeszcze nie zamówiłeś.</h3></tr>';
                    } else {
                        echo '<table class="table table-striped table-hover table-sm">
                            <thead>
                                <tr>
                                    <th scope="col">Nazwa | Ilość</th>
                                    <th scope="col">Suma</th>
                                    <th scope="col">Adres dostawy</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>';
                        foreach ($orders as $order) {
                            echo '
                                <tr>
                                <td>';

                            foreach (getOrdersDetail($connection) as $orderD) {
                                if ($order['id'] == $orderD['idOrder']) {
                                    echo '
                                    <p>' . $orderD['productName'] . ' | ' . $orderD['quantity'] . '</p>';
                                }
                            }

                            echo '
                            </td>
                            <td>' . $order['total'] . 'zł</td>
                            <td>' . $order['name'] .' '. $order['surname'] . '<br>' . $order['city'] . ' ' . $order['post'] . '<br>' . $order['street'] .' </td>
                            <td>' . $order['status'] . '</td>
                            </tr>';
                        }
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