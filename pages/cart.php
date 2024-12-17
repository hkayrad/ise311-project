<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../assets/brand/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../styles/header/cart/header.css">
    <link rel="stylesheet" href="../index.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Host+Grotesk:ital,wght@0,300..800;1,300..800&display=swap"
        rel="stylesheet">
    <title>Sepetim</title>
</head>

<body style="background-color: rgb(245, 245, 245);">
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

        <?php

        include '../config.php';

        $query = "SELECT product_id FROM cart";
        $result = mysqli_query($conn, $query);

        if (!$result) {
            die("Query error! " . mysqli_error($conn));
        }

        $totalItems = mysqli_num_rows($result);



        if (mysqli_num_rows($result) > 0) {
            echo "<div style='background-color: white; width: 100%; text-align: left; padding: 10px;'>
            <h1 style='margin: 0;'>Sepetim ($totalItems ürün)</h1> </div> <br>";

            echo "<table border='1' cellpadding='5' width='50%' style='margin: auto; transform: translateX(-50px);'>";  // hafif solda, sağa ödeme
            //    yap butonu çıkacak
            echo "<tr style='background-color: white;'><th>Product ID</th></tr>"; // *** TABLE HEADER KISMINI SİLMEYİ UNUTMA

            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr style='background-color: white;'> <td>" . $row['product_id'] . "</td> </tr>";
            }

            echo "</table>";
        } else {
            echo "<div style='background-color: white; text-align: center; padding: 20px; margin: 0 auto; width: 60%;'>
            <p style='font-size: 24px; font-weight: bold; margin: 0;'>Sepetin şu an boş</p>
            <p style='font-size: 16px; margin-top: 10px;'>
            Sepetini Hepsiburada’nın fırsatlarla dolu dünyasından doldurmak için <br>
            aşağıdaki ürünleri incelemeye başlayabilirsin. </p> </div>";
        }



        /*while ($row = mysqli_fetch_assoc($result)) **tablosuz
        {
                echo "Ürün: " . $row['product_name'] . "<br>";
        }*/

        ?>
    </div>



</body>

</html>