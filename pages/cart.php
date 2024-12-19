<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../assets/brand/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../styles/header/cart/header.css">
    <link rel="stylesheet" href="../index.css">
    <link rel="stylesheet" href="../styles/cart/cart.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Host+Grotesk:ital,wght@0,300..800;1,300..800&display=swap"
        rel="stylesheet">
    <title>Sepetim</title>

    <script>
        if (sessionStorage.getItem('user_id') == null) {
            document.cookie = "";
            window.location.href = "../pages/login.php";
        }

        const removeFromCart = (productId) => {
            var theForm, newInput1, newInput2;
            theForm = document.createElement('form');

            theForm = document.createElement('form');
            theForm.action = '../components/handleRemoveFromCart.php';
            theForm.method = 'POST';

            newInput1 = document.createElement('input');
            newInput1.type = 'hidden';
            newInput1.name = 'user_id';
            newInput1.value = sessionStorage.getItem('user_id');

            newInput2 = document.createElement('input');
            newInput2.type = 'hidden';
            newInput2.name = 'product_id';
            newInput2.value = productId;

            theForm.appendChild(newInput1);
            theForm.appendChild(newInput2);

            document.getElementById('hidden_form_container').appendChild(theForm);

            theForm.submit();
        }
    </script>
</head>

<body style="background-color: rgb(245, 245, 245);">
    <div id="hidden_form_container" style="display:none;"></div>
    <div class="header" style="background-color: white">
        <div class="logo-container">
            <a href="../">
                <img src="../assets/brand/logo.svg" alt="">
            </a>
            <p><span>Premium'u</span> keşfet</p>
        </div>
        <a href="" id="links">
            <div>
                <img src="../assets/icons/categories.svg">
            </div>
            <p>Kategoriler</p>
        </a>

        <form class="search" action="../" method="GET"> <!-- Search function -->
            <img src="../assets/icons/search.svg">
            <input type="search" name="s" placeholder="Ürün, kategori veya marka ara" />
        </form>
        <a href="" id="links">
            <div>
                <img src="../assets/icons/orders.svg">
                <p id="outlier">Siparişlerim</p>
            </div>
        </a>
        <a href="" id="profile">Profil</a>
    </div>

    <div class="body" style="margin:0px; width: 100%;">

        <div class="cart">
            <?php

            include '../config.php';


            $query = "SELECT * FROM cart WHERE user_id = " . $_COOKIE['user_id'] . ";";
            $result = mysqli_query($conn, $query);

            if (!$result) {
                die("Query error! " . mysqli_error($conn));
            }

            $totalItems = mysqli_num_rows($result);

            $total = 0;


            if (mysqli_num_rows($result) > 0) {

                echo "<div class='products'>";

                while ($row = mysqli_fetch_assoc($result)) {
                    $q = "SELECT * FROM products WHERE id = " . $row['product_id'] . ";";
                    $r = mysqli_query($conn, $q);

                    if (!$r) {
                        die("Query error! " . mysqli_error($conn));
                    }

                    $product = mysqli_fetch_assoc($r);
                    $total += $product['price'];

                    echo "<div id='product'>
                <img src='" . $product['image'] . "' />
                <div>
                    <h1>" . $product['brand'] . " " . $product['model'] . "</h1>
                    <p>" . $product['price'] . " ₺</p>
                </div>
                <button onclick='removeFromCart(" . $product['id'] . ")'>
                    <img src='data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIyNCIgaGVpZ2h0PSIyNCIgdmlld0JveD0iMCAwIDI0IDI0IiBmaWxsPSJub25lIiBzdHJva2U9IiNmZjYwMDAiIHN0cm9rZS13aWR0aD0iMiIgc3Ryb2tlLWxpbmVjYXA9InJvdW5kIiBzdHJva2UtbGluZWpvaW49InJvdW5kIiBjbGFzcz0ibHVjaWRlIGx1Y2lkZS10cmFzaC0yIj48cGF0aCBkPSJNMyA2aDE4Ii8+PHBhdGggZD0iTTE5IDZ2MTRjMCAxLTEgMi0yIDJIN2MtMSAwLTItMS0yLTJWNiIvPjxwYXRoIGQ9Ik04IDZWNGMwLTEgMS0yIDItMmg0YzEgMCAyIDEgMiAydjIiLz48bGluZSB4MT0iMTAiIHgyPSIxMCIgeTE9IjExIiB5Mj0iMTciLz48bGluZSB4MT0iMTQiIHgyPSIxNCIgeTE9IjExIiB5Mj0iMTciLz48L3N2Zz4=' />
                </button>
                </div>";
                }
            } else {
                echo "<div style='text-align: center; padding: 20px; margin: auto auto; width: 60%;'>
            <p style='font-size: 24px; font-weight: bold; margin: 0;'>Sepetin şu an boş</p>
            <p style='font-size: 16px; margin-top: 10px;'>
            Sepetini Hepsiburada’nın fırsatlarla dolu dünyasından doldurmak için <br>
            aşağıdaki ürünleri incelemeye başlayabilirsin. </p>";
            }

            ?>
        </div>

        <div id='aside'>
            <div id='total'>
                <h1>Toplam</h1>
                <p><?php echo $total?> ₺</p>
            </div>
            <button id='checkout'>Ödeme Yap</button>
        </div>
    </div>

</body>

</html>