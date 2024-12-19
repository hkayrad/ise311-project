<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./index.css">
    <link rel="stylesheet" href="./styles/products/products.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Host+Grotesk:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
    <title>Hepsiburada</title>
</head>

<body>
    <div id="hidden_form_container" style="display:none;"></div>

    <?php
    session_start();

    include "./config.php"; //? Connect to database
    include "./components/header.php"; //? Put header to index.php

    $productId = $_GET['id'];

    $productQuery = "SELECT * FROM products WHERE id = $productId";
    $productResult = mysqli_query($conn, $productQuery);

    if (!$productResult) {
        die("Query error! " . mysqli_error($conn));
    } else {
        $product = mysqli_fetch_assoc($productResult);

        echo "<div id='product'>
        <div id='card'>
            <img id='productImg' src='" . $product["image"] . "' />
            <div id='details'>
                <h1>" . $product['brand'] . " " . $product['model'] . "</h1>
                <p id='rating'>" . str_repeat("⭐", $product['rating']) . "</p>
                <p id='price'>" . $product['price'] . " ₺</p>
                <p id='seller'>Satıcı: <span>Hepsiburada</span></p>
                <div id='cartButton'><!-- //! JS ILE EKLENIYOR -->
                </div>
            </div>
        </div>
    </div>";
    }
    ?>

    <script>
        if (sessionStorage.getItem('user_id')) {
            document.getElementById('cartButton').innerHTML = "<button id='cartButtonInner' onclick='addToCart()'><img src='./assets/icons/addCart.svg' alt='cart' /><p>Sepete Ekle</p></button>";
        } else {
            document.getElementById('cartButton').innerHTML = "<a id='cartButtonInner' href='./pages/login.php'>Giriş Yapın</a>";
        }

        const addToCart = () => {
            var theForm, newInput1, newInput2;
            theForm = document.createElement('form');

            theForm = document.createElement('form');
            theForm.action = './components/handleAddToCart.php';
            theForm.method = 'POST';

            newInput1 = document.createElement('input');
            newInput1.type = 'hidden';
            newInput1.name = 'user_id';
            newInput1.value = sessionStorage.getItem('user_id');

            newInput2 = document.createElement('input');
            newInput2.type = 'hidden';
            newInput2.name = 'product_id';
            newInput2.value = <?php echo $productId; ?>;

            theForm.appendChild(newInput1);
            theForm.appendChild(newInput2);

            document.getElementById('hidden_form_container').appendChild(theForm);

            theForm.submit();
        }
    </script>

    <?php

    ?>

</body>

</html>