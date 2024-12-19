<?php

include "../config.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $userId = $_POST['user_id'];
    $productId = $_POST['product_id'];

    $query = "DELETE FROM cart WHERE user_id = $userId AND product_id = $productId LIMIT 1";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Query error! " . mysqli_error($conn));
    } else {
        echo "Ürün başarıyla sepetten çıkarıldı.";
        header("Location: ../pages/cart.php");
    }
}
