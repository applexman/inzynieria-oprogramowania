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
    <title>Dreaming Book</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&amp;display=swap">
</head>

<body>
    <?php
    require_once 'navbar.php';

    require_once "database_connect.php";

    $id = $_GET['id'];
    $sql = "SELECT * FROM categories WHERE id = $id";
    $result = $connection->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $category[] = $row;
        }
        echo
        '<section>
            <div class="container py-5">
                <div class="mx-auto" style="max-width: 900px;">
                    <form method="POST">
                        <div class="mb-3"><input class="form-control" type="text" name="name" value="' . $category[0]['name'] . '"></div>
                        <div class="m-3"><button class="btn btn-danger shadow d-block w-10 mx-auto d-flex" type="submit" name="delete">Usuń</button></div>
                        <div class="m-3"><button class="btn btn-outline-danger shadow d-block w-10 mx-auto d-flex" type="submit" name="confirm">Zatwierdź</button></div>
                    </form>
                </div>
            </div>
        </section>';
    }
    if (isset($_POST['delete'])) {
        $sql = "DELETE FROM categories WHERE id = $id";
        $connection->query($sql);
        if($_SESSION['permissions'] == 2){
            header('Location: employee_page.php');
        }
        else{
            header('Location: admin_page.php');
        }
    }
    if (isset($_POST['confirm'])) {
        $name = $_POST['name'];
        $price = $_POST['price'];
        $description = $_POST['description'];
        $categoryId = $_POST['category'];
        $sql = "UPDATE categories SET name = '$name' WHERE id = $id";
        $result = $connection->query($sql);
        if ($result) {
            if($_SESSION['permissions'] == 2){
                header('Location: employee_page.php');
            }
            else{
                header('Location: admin_page.php');
            }
        }
    }
    $connection->close();
    ?>



    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="assets/js/bold-and-bright.js"></script>
</body>

</html>