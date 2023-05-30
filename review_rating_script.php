<?php
function calculateAverageRating($connection, $product_id)
{
    $sql_reviews = "SELECT * FROM reviews WHERE idProduct = $product_id";
    $result_reviews = $connection->query($sql_reviews);

    if ($result_reviews->num_rows > 0) {
        $total_ratings = 0;
        $num_reviews = 0;

        while ($row_reviews = $result_reviews->fetch_assoc()) {
            $total_ratings += $row_reviews['stars'];
            $num_reviews++;
        }

        $average_rating = $total_ratings / $num_reviews;
        return round($average_rating, 2);
    } else {
        return "Brak recenzji";
    }
}
?>
