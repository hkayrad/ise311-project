<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hepsiburada</title>
    <link rel="stylesheet" href="./index.css"> <!-- Page styles -->
    <link rel="stylesheet" href="./styles/index/index.css"> <!-- Page styles -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Host+Grotesk:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
</head>

<body>
    <?php

    include './components/header.php'; //? Put header to index.php

    ?>
    <div id="categories">
        <a href="./main.php">Elektronik</a>
        <a href="">Moda</a>
        <a href="">Ev, Yaşam, Kırtasiye, Ofis</a>
        <a href="">Oto, Bahçe, Yapı Market</a>
        <a href="">Anne, Bebek, Oyuncak</a>
        <a href="">Spor, Outdoor</a>
        <a href="">Kozmetik, Kişisel Bakım</a>
        <a href="">Süpermarket, Pet Shop</a>
        <a href="">Kitap, Müzik, Film, Hobi</a>
    </div>
    <div id="discounts">
        <img src="https://images.hepsiburada.net/banners/s/1/180-180/yilbasi-pazari-jenerik-tr_(1)133790920557427705.png" alt="">
        <img src="https://images.hepsiburada.net/banners/s/1/180-180/supermarket-tr-25133789235050640589.png" alt="">
        <img src="https://images.hepsiburada.net/banners/s/1/180-180/premium-tr133788033170446931.png" alt="">
        <img src="https://images.hepsiburada.net/banners/s/1/180-180/gra-186725-hepsipay-36-ay-tr-1_(1)133794056978271084.png" alt="">
        <img src="https://images.hepsiburada.net/banners/s/1/180-180/dort_dortluk-jenerik-tr133785712967254852.png" alt="">
        <img src="https://images.hepsiburada.net/banners/s/1/180-180/sarj_urunleri-tr-2133788986261587072.png" alt="">
        <img src="https://images.hepsiburada.net/banners/s/1/180-180/gra-187020-honor_magic_v3-takas-tr133794273954791777.png" alt="">
        <img src="https://images.hepsiburada.net/banners/s/1/180-180/hepsi_gamer-tr133794346492661999.png" alt="">
        <img src="https://images.hepsiburada.net/banners/s/1/180-180/gra-187007-kozmetik-25-tr-1_(1)_(1)133794438740810468.png" alt="">
        <img src="https://images.hepsiburada.net/banners/s/1/180-180/elektronik-jenerik-tr133785710311348038.png" alt="">
        <img src="https://images.hepsiburada.net/banners/s/1/180-180/skechers-tr133785698789675862.png" alt="">
        <img src="https://images.hepsiburada.net/banners/s/1/180-180/kucuk_ev_aletleri-firsat-saatleri-tr133794293779481340.png" alt="">
    </div>
    <div id="banners">
        <img src="https://images.hepsiburada.net/banners/s/1/819-357/164546_app133543713539247699133775976383458133.png" alt="">
        <img src="./assets/brand/banner.png" alt="">
    </div>
    <div id="recommended">
        <h1>Size Önerilenler</h1>
        <div id="products">
            <?php

            for ($i = 0; $i < 16; $i++) {
                echo "<div id='product'>
                <img src='https://placehold.co/200x200' alt=''>
                <h2>Product Name</h2>
                <p>Price</p>
            </div>";
            }
            ?>
        </div>
    </div>
</body>

</html>