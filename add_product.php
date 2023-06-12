<?php
session_start();
if ((!isset($_SESSION['permissions'])) || ($_SESSION['permissions'] != 1 && $_SESSION['permissions'] != 2)) {
    header('Location: login_page.php');
    exit();
}
ob_start();
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
    ?>
    <section>
        <div class="container py-5">
            <div class="mx-auto" style="max-width: 900px;">
                <h2 class="text-center"><b><label for="title">Dodaj produkt</label></b></h2>
                <?php
                if (isset($_GET['error']) && $_GET['error'] === 'quantity') {
                            echo '<div class="alert alert-danger" role="alert">Musisz wpisać dane ponownie, ponieważ nie wybrałeś żadnej kategorii!</div>';
                        }
                ?>
                <div class="col-md-3 mb-4 mx-auto d-flex"><img class="rounded card-img-top mb-5 mb-md-0 " src="assets/img/products/default.png" alt="default image" /></div>
                <form method="post">
                    <div class="mb-3"><label for="title">Tytuł</label><input class="form-control" type="text" id="title" name="name" placeholder="Tytuł" required></div>
                    <div class="mb-3"><label for="price">Cena</label><input class="form-control" type="number" id="price" name="price" min=1 placeholder="Cena" required></div>
                    <label for="description">Opis</label><textarea class="form-control" aria-label="With textarea" id="description" name="description" placeholder="Opis" required></textarea>
                    <div class="mb-3">
                        <label for="category" class="form-label">Kategorie</label>
                        <?php

                        $sql = "SELECT * FROM categories";
                        $result = $connection->query($sql);
                        $categories = array();

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $categories[] = $row;
                            }
                        }

                        foreach ($categories as $category) {
                            echo '<div class="form-check"><input type="checkbox" class="form-check-input" id="c' . $category['id'] . '" name="categories[]" value="' . $category['id'] . '"><label for="c' . $category['id'] . '" requ>' . $category['name'] . '</label></div>';
                        }
                        ?>
                    </div>
                    <div class="mb-3"><label for="quantity">Ilość</label><input class="form-control" type="number" id="quantity" name="quantity" min=1 placeholder="Ilość" required></div>
                    <div class="m-3"><button class="btn btn-danger shadow d-block w-10 mx-auto d-flex" type="submit" name="confirm">Zatwierdź</button></div>
                </form>
            </div>
        </div>
    </section>
    <?php

    if (isset($_POST['confirm'])) {
        $name = $_POST['name'];
        $price = $_POST['price'];
        $description = $_POST['description'];
        $category = $_POST['categories'];
        $quantity = $_POST['quantity'];
        if (!empty($category)) {
            $sql = "INSERT INTO products (name, price, img, description, quantity) VALUES ('$name', '$price', 'default.png', '$description', '$quantity')";
            $result = $connection->query($sql);
            if ($result) {
                $id = mysqli_insert_id($connection);
                foreach ($category as $categoryID) {
                    $sql = "INSERT INTO product_categories (productID, categoryID) VALUES ($id, $categoryID)";
                    $connection->query($sql);
                }
                if ($_SESSION['permissions'] == 2) {
                    $output = ob_get_clean();
                    header('Location: employee_page.php');
                } else {
                    $output = ob_get_clean();
                    header('Location: admin_page.php');
                }
            }
        } else {
            $output = ob_get_clean();
            header('Location:add_product.php?&error=quantity');
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