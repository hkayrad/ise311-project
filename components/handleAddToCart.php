<?php

include "../config.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $userId = $_POST['user_id'];
    $productId = $_POST['product_id'];

    $query = "INSERT INTO cart (user_id, product_id) VALUES ($userId, $productId)";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Query error! " . mysqli_error($conn));
    } else {
        echo "Ürün başarıyla sepete eklendi.";
        header("Location: ../products.php?id=$productId");
    }
}
