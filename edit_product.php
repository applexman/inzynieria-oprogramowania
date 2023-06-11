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
    <title>Najlepszy sklep</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&amp;display=swap">
</head>

<body>
    <?php
    require_once 'navbar.php';

    require_once "database_connect.php";

    $id = $_GET['id'];
    $sql = "SELECT * FROM products WHERE id = $id";
    $result = $connection->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $product[] = $row;
        }

        $sql = "SELECT * FROM categories";
        $result = $connection->query($sql);
        $categories = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $categories[] = $row;
            }
        }
        function getProductCategoriesIDs($connection, $productID)
        {
            $categoriesIDs = array();
            $sql = "SELECT categoryID FROM product_categories WHERE productID = $productID";
            $result = $connection->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $categoriesIDs[] = $row['categoryID'];
                }
            }
            return $categoriesIDs;
        }
        $assignedCategories = getProductCategoriesIDs($connection, $id);
        echo
        '<section>
            <div class="container py-5">
                <div class="mx-auto" style="max-width: 900px;">
                <div class="col-md-3 mb-4 mx-auto d-flex"><img class="rounded card-img-top mb-5 mb-md-0 " src="assets/img/products/' . $product[0]['img'] . '" alt="' . $product[0]['name'] . '" /></div>
                    <form method="POST">
                        <div class="mb-3"><label for="title">Tytuł</label><input class="form-control" id ="title" type="text" name="name" value="' . $product[0]['name'] . '"></div>
                        <div class="mb-3"><label for="price">Cena</label><input class="form-control" id="price" type="number" min=1 name="price" value="' . $product[0]['price'] . '"></div>
                        <div class="mb-3"><label for="des">Opis</label><textarea class="form-control" id="des" aria-label="With textarea" name="description">' . $product[0]['description'] . '</textarea></div>
                        <div class="mb-3">

                        <label for="category">
                        Kategorie:<br>
                        </label>';
                        if (isset($_GET['error']) && $_GET['error'] === 'quantity') {
                            echo '<div class="alert alert-danger" role="alert">Musisz wybrać minimum 1 kategorię!</div>';
                        }
                        foreach ($categories as $category) {
                            $checked = in_array($category['id'], $assignedCategories) ? 'checked' : '';
                            echo '<div class="form-check"><input type="checkbox" class="form-check-input" id="c' . $category['id'] . '" name="categories[]" value="' . $category['id'] . '" ' . $checked . '><label for="c' . $category['id'] . '">' . $category['name'] . '</label></div>';
                        }

                        echo
                        '
                        </div>
                        <div class="mb-3"><label for="quantity">Ilość</label><input class="form-control" type="number" min=1 id="quantity" name="quantity" value="' . $product[0]['quantity'] . '"></div>
                        <div class="m-3"><button class="btn btn-danger shadow d-block w-10 mx-auto d-flex" type="submit" name="delete">Usuń</button></div>
                        <div class="m-3"><button class="btn btn-outline-danger shadow d-block w-10 mx-auto d-flex" type="submit" name="confirm">Zatwierdź</button></div>
                        </form>
                </div>
            </div>
        </section>';
    }

    if (isset($_POST['delete'])) {
        $sql = "DELETE FROM products WHERE id = $id";
        $connection->query($sql);
        $sql = "DELETE FROM product_categories WHERE productID=$id";
        $connection->query($sql);
        if ($_SESSION['permissions'] == 2) {
            header('Location: employee_page.php');
            exit();
        } else {
            header('Location: admin_page.php');
            exit();
        }
    }

    if (isset($_POST['confirm'])) {
        $name = $_POST['name'];
        $price = $_POST['price'];
        $description = $_POST['description'];
        $category = $_POST['categories'];
        $quantity = $_POST['quantity'];
        if (!empty($category)) {
            $sql = "DELETE FROM product_categories WHERE productID=$id";
            if ($connection->query($sql)) {
                foreach ($category as $categoryID) {
                    $sql = "INSERT INTO product_categories (productID, categoryID) VALUES ($id, $categoryID)";
                    $connection->query($sql);
                }
                $sql = "UPDATE products SET name = '$name', price = '$price', description = '$description', quantity='$quantity' WHERE id = $id";
                $result = $connection->query($sql);
                if ($result) {
                    if ($_SESSION['permissions'] == 1) {
                        $output = ob_get_clean();
                        header('Location: admin_page.php');
                        exit();
                    } else {
                        $output = ob_get_clean();
                        header('Location: employee_page.php');
                        exit();
                    }
                }
            }
        }
        else{
            $output = ob_get_clean();
            header('Location:edit_product.php?id=' . $id . '&error=quantity');
            exit();
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