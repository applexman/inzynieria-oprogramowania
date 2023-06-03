<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Najlepszy sklep</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.reflowhq.com/v2/toolkit.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&amp;display=swap">
</head>

<body>
    <?php
    include 'navbar.php';
    require_once "database_connect.php";
    require_once "review_rating_script.php";
    ?>

    <section class="py-5">
        <div class="container py-5">
            <div class="row mb-4 mb-lg-5">
                <div class="col-md-8 col-xl-3">
                    <h2 class="fw-bold">Kategorie</h2>
                    <ul class="list-group">
                        <?php

                        $categories = array();
                        $sql_categories = "SELECT * FROM categories";
                        $result_categories = $connection->query($sql_categories);
                        if ($result_categories->num_rows > 0) {
                            echo
                            '<li class="list-group-item selected-category">
                                <a href="products_page.php">Wszystkie książki</a>
                            </li>';
                            while ($row_categories = $result_categories->fetch_assoc()) {
                                $categories[] = $row_categories;
                            }
                        }
                        foreach ($categories as $category) {
                            echo '<li class="list-group-item">
                                <a href="products_page.php?category=' . $category['id'] . '">' . $category['name'] . '</a>
                              </li>';
                        }
                        ?>
                    </ul>
                </div>
                <div class="col-md-8 col-xl-9">
                    <h2 class="fw-bold">
                        <?php

                        $selectedCategory = null;
                        if (isset($_GET['category']) && $_GET['category'] != '') {
                            $selectedCategory = $_GET['category'];
                        }
                        if ($selectedCategory) {
                            foreach ($categories as $category) {
                                if ($category['id'] == $selectedCategory) {
                                    echo $category['name'];
                                    break;
                                }
                            }
                        } else {
                            echo "Wszystkie produkty";
                        }
                        ?>
                    </h2>
                    <div class="row row-cols-1 row-cols-md-3 mx-auto" style="max-width: 900px;">
                        <?php
                        $selectedCategory = null;
                        if (isset($_GET['category']) && $_GET['category'] != '') {
                            $selectedCategory = $_GET['category'];
                        }

                        $products = array();
                        $sql_products = "SELECT * FROM products";
                        if ($selectedCategory) {
                            $sql_products .= " WHERE categoryId = $selectedCategory";
                        }
                        $result_products = $connection->query($sql_products);
                        if ($result_products->num_rows > 0) {
                            while ($row_products = $result_products->fetch_assoc()) {
                                $products[] = $row_products;
                            }
                        }

                        foreach ($products as $product) {
                            $average_rating = calculateAverageRating($connection, $product['id']);
                            echo '
                        <div class="col mb-4">
                            <div class="text-center">
                                <img class="rounded mb-3 fit-cover" width="200" height="200" src="assets/img/products/' . $product['img'] . '">
                                <h5 class="fw-bold mb-0"><strong>' . $product['name'] . '</strong></h5>
                                <p class="lead">Średnia ocena: <b>' . $average_rating . '</b></p>
                                <a class="btn btn-primary shadow" role="button" href="product_page.php?id=' . $product['id'] . '">
                                    ' . $product['price'] . ' zł
                                </a>
                            </div>
                        </div>';
                        }

                        $connection->close();
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include 'footer.php'; ?>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="assets/js/bold-and-bright.js"></script>
</body>

</html>