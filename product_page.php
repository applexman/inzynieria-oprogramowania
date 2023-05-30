<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Najlepszy sklep</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.reflowhq.com/v2/toolkit.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&amp;display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <?php include 'navbar.php'; ?>

    <?php
    require_once "database_connect.php";
    require_once "review_rating_script.php";

    $id = $_GET['id'];
    $sql = "SELECT * FROM products WHERE id = $id";
    $result = $connection->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $product[] = $row;
        }
    ?>
        <section class="py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="row gx-4 gx-lg-5 align-items-center">
                    <div class="col-md-6"><img class="rounded card-img-top mb-5 mb-md-0" src="assets/img/products/<?php echo $product[0]['img']; ?>" alt="<?php echo $product[0]['name']; ?>" /></div>
                    <div class="col-md-6">
                        <h1 class="display-5 fw-bolder"><?php echo $product[0]['name']; ?></h1>
                        <div class="fs-5 mb-5">
                            <span><?php echo $product[0]['price']; ?> zł</span>
                        </div>
                        <p class="lead"><?php echo $product[0]['description']; ?></p>
                        <?php $average_rating = calculateAverageRating($connection, $product[0]['id']); ?>
                        <p class="lead"><?php echo "Średnia ocena:<b> " . $average_rating ."</b>"; ?></p>
                        <div class="d-flex">
                            <form action="add_to_cart.php" method="POST">
                                <input type="hidden" name="id" value="<?php echo $product[0]['id']; ?>">
                                <fieldset>
                                    <input class="form-control text-center me-3" id="inputQuantity" name="quantity" type="number" value="1" max="10" min="1" style="max-width: 5rem" />
                                </fieldset>
                                <button class="btn btn-outline-dark flex-shrink-0" type="submit">
                                    <i class="bi-cart-fill me-1"></i>
                                    Dodaj do koszyka
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="row gx-4 gx-lg-5 align-items-center mt-4">
                    <div class="col-md-6">
                        <p class="lead" style="font-weight: bold;">Dodaj opinię o produkcie:</p>
                        <form action="add_review.php" method="POST">
                            <input type="hidden" name="id" value="<?php echo $product[0]['id']; ?>">
                            <div class="form-group">
                                <label>Ocena:</label><br>
                                <div class="rating">
                                    <input type="radio" id="star5" name="rating" value="5" required><label for="star5"><i class="fas fa-star"></i></label>
                                    <input type="radio" id="star4" name="rating" value="4" required><label for="star4"><i class="fas fa-star"></i></label>
                                    <input type="radio" id="star3" name="rating" value="3" required><label for="star3"><i class="fas fa-star"></i></label>
                                    <input type="radio" id="star2" name="rating" value="2" required><label for="star2"><i class="fas fa-star"></i></label>
                                    <input type="radio" id="star1" name="rating" value="1" required><label for="star1"><i class="fas fa-star"></i></label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="comment">Komentarz:</label>
                                <textarea class="form-control" name="comment" id="comment" rows="3" required></textarea>
                            </div>
                            <button class="btn btn-outline-dark flex-shrink-0" type="submit">
                                <i class="bi-cart-fill me-1"></i>
                                Dodaj opinię
                            </button>
                        </form>
                    </div>
                </div>
                <div class="row gx-4 gx-lg-5 align-items-center mt-4">
                    <div class="col-md-6">
                        <h3>Recenzje:</h3>
                        <?php
                        $product_id = $product[0]['id'];
                        $sql_reviews = "SELECT * FROM reviews WHERE idProduct = $product_id";
                        $result_reviews = $connection->query($sql_reviews);
                        if ($result_reviews->num_rows > 0) {
                            while ($row_reviews = $result_reviews->fetch_assoc()) {
                                echo "<div class='review-box'>";
                                echo "<p>Ocena: " . $row_reviews['stars'] . "</p>";
                                echo "<p>Komentarz: " . $row_reviews['review_text'] . "</p>";
                                echo "</div>";
                            }
                        } else {
                            echo "Brak recenzji";
                        }
                        ?>
                    </div>
                </div>
        </section>
    <?php
    }
    $connection->close();
    ?>

    <?php include 'footer.php'; ?>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="assets/js/bold-and-bright.js"></script>
</body>

</html>