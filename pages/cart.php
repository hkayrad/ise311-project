<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../assets/brand/favicon.ico" type="image/x-icon">
    <title>Sepetim</title>
</head>
<body style="background-color: rgb(245, 245, 245);">
    <div class="header" style="background-color: white">
    <p style="padding: 10px;">
    <a href="/">
        <img src="../assets/brand/logo.svg" alt="" style="margin: 0px;">
        </a>
        <br><span>Premium'u</span> keşfet
        <span style="display: inline-block; width: 5%;"></span>   <!-- ***BURAYI EKRANIN EN ÖLÇÜSÜNE UYARLI YAPMAMIZ LAZIM DÜZELTMEYİ UNUTMA ***-->
        <a href="">Kategoriler</a>

        <input type="text" placeholder="Ürün, kategori veya marka ara" style="width: 70%; height: 30px;  border-radius: 100px ;" /> 
        <!-- ***WIDTH OLAYI PENCERE KÜÇÜLÜNCE HOŞ DURMUYOR, ÖZELLİKLE SAĞ VE SOLDAKİ BUTONLARIN YERİ. ***-->

        <a href="">Siparişlerim</a>
        <a href="">Profil</a>
    </div>

    <div class="body" style="margin:0px; width: 100%;"> 

    <?php

        include '../config.php';

        $query = "SELECT product_id FROM cart";
        $result = mysqli_query($conn, $query);

        if (!$result) 
        {
            die("Query error! " . mysqli_error($conn));
        }

        $totalItems = mysqli_num_rows($result);

        

        if (mysqli_num_rows($result) > 0) 
        {
            echo "<div style='background-color: white; width: 100%; text-align: left; padding: 10px;'>
            <h1 style='margin: 0;'>Sepetim ($totalItems ürün)</h1> </div> <br>";

            echo "<table border='1' cellpadding='5' width='50%' style='margin: auto; transform: translateX(-50px);'>";  // hafif solda, sağa ödeme
                                                                                                                        //    yap butonu çıkacak
            echo "<tr style='background-color: white;'><th>Product ID</th></tr>"; // *** TABLE HEADER KISMINI SİLMEYİ UNUTMA

            while ($row = mysqli_fetch_assoc($result)) 
            {
                echo "<tr style='background-color: white;'> <td>" . $row['product_id'] . "</td> </tr>";
            }

            echo "</table>";
            
        } 
        else 
        {
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