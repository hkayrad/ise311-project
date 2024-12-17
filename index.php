<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./assets/brand/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="./index.css"> <!-- Reset margin, padding and box sizing -->
    <link rel="stylesheet" href="./styles/index/index.css"> <!-- Page styles -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Host+Grotesk:ital,wght@0,300..800;1,300..800&display=swap"
        rel="stylesheet">
    <title>Hepsiburada</title>

    <script>
        const resetSearchParams = () => {
            window.location.href =  window.location.href.split("?")[0];            
        }
    </script>
</head>

<body>
    <?php
    include './components/header.php'; //? Put header to index.php
    ?>
    <div id="title">
        <h1>Bilgisayar Fiyatları ve Modelleri</h1>
    </div>
    <div id="content">
        <div id="aside">
            <div id="filterTitle">
                <h3>Filtreler</h3>
                <button onclick="resetSearchParams()">Clear</button>
            </div>
            <span></span>

            <form class="filters" action="./" method="GET">
                <h4>Tür</h4>
                <?php 
                $x = isset($_GET['s']) ? $_GET['s'] : '';
                echo "<input style=\"display:none\" type=\"text\" name=\"s\" value=\"".$x."\" />";
                ?> <!-- //! Prevent the search from disappearing after using filters -->
                <div>
                    <input type="checkbox" name="type[]" value="computer" id="computer" />
                    <label for="computer">Bilgisayar</label>
                </div>
                <div>
                    <input type="checkbox" name="type[]" value="tablet" id="tablet" />
                    <label for="tablet">Tablet</label>
                </div>
                <h4>Marka</h4>
                <div>
                    <input type="checkbox" name="brand[]" value="asus" id="asus" />
                    <label for="asus">Asus</label>
                </div>
                <div>
                    <input type="checkbox" name="brand[]" value="acer" id="acer" />
                    <label for="acer">Acer</label>
                </div><!--//! Add more -->
                <h4>Fiyat</h4>
                <div id="price">
                    <input type="number" name="price[min]" placeholder="Min" />
                    <p>-</p>
                    <input type="number" name="price[max]" placeholder="Max" />
                </div>
                <h4>Rating</h4>
                <div>
                    <input type="radio" name="rating" value="5" id="5" />
                    <label for="5">⭐⭐⭐⭐⭐</label>
                </div>
                <div>
                    <input type="radio" name="rating" value="4" id="4" />
                    <label for="4">⭐⭐⭐⭐</label>
                </div>
                <div>
                    <input type="radio" name="rating" value="3" id="3" />
                    <label for="3">⭐⭐⭐</label>
                </div>
                <div>
                    <input type="radio" name="rating" value="2" id="2" />
                    <label for="2">⭐⭐</label>
                </div>
                <div>
                    <input type="radio" name="rating" value="1" id="1" />
                    <label for="1">⭐</label>
                </div>
                <h4>CPU</h4>
                <div>
                    <input type="checkbox" name="cpu[]" value="intel" id="intel" />
                    <label for="intel">Intel</label>
                </div>
                <div>
                    <input type="checkbox" name="cpu[]" value="amd" id="amd" />
                    <label for="amd">AMD</label>
                </div>
                <h4>RAM</h4>
                <div>
                    <input type="checkbox" name="ram[]" value="8" id="8" />
                    <label for="8">8 GB</label>
                </div>
                <div>
                    <input type="checkbox" name="ram[]" value="16" id="16" />
                    <label for="16">16 GB</label>
                </div>
                <div>
                    <input type="checkbox" name="ram[]" value="32" id="32" />
                    <label for="32">32 GB</label>
                </div>
                <h4>Depolama</h4>
                <div>
                    <input type="checkbox" name="storage[]" value="256" id="256" />
                    <label for="256">256 GB</label>
                </div>
                <div>
                    <input type="checkbox" name="storage[]" value="512" id="512" />
                    <label for="512">512 GB</label>
                </div>
                <div>
                    <input type="checkbox" name="storage[]" value="1024" id="1024" />
                    <label for="1024">1 TB</label>
                </div>
                <div>
                    <input type="checkbox" name="storage[]" value="2048" id="2048" />
                    <label for="2048">2 TB</label>
                </div>
                <button type="submit">Filtreleri Kaydet</button>
            </form>
        </div>

        <div id="mainContent"><!-- Bunun icine butun listingler gelicek -->

            <?php

            $types = isset($_GET['type']) ? $_GET['type'] : [];
            $brands = isset($_GET['brand']) ? $_GET['brand'] : [];
            $search = isset($_GET['s']) ? $_GET['s'] : '';
            $price = isset($_GET['price']) ? $_GET['price'] : [];
            $rating = isset($_GET['rating']) ? $_GET['rating'] : [];
            $cpu = isset($_GET['cpu']) ? $_GET['cpu'] : [];
            $ram = isset($_GET['ram']) ? $_GET['ram'] : [];
            $storage = isset($_GET['storage']) ? $_GET['storage'] : [];

            //! FOR TESTING
            if (count($types) > 0) {
                echo "<h2>Tür: ";
                foreach ($types as $type) {
                    echo $type . " ";
                }
                echo "</h2>";
            }
            if (count($brands) > 0) {
                echo "<h2>Marka: ";
                foreach ($brands as $brand) {
                    echo $brand . " ";
                }
                echo "</h2>";
            }
            if (count($price) > 0) {
                echo "<h2>Fiyat: " . $price['min'] . " - " . $price['max'] . "</h2>";
            }
            if ($rating != null) {
                echo "<h2>Rating: $rating</h2>";
            }
            if (count($cpu) > 0) {
                echo "<h2>CPU: ";
                foreach ($cpu as $c) {
                    echo $c . " ";
                }
                echo "</h2>";
            }
            if (count($ram) > 0) {
                echo "<h2>RAM: ";
                foreach ($ram as $r) {
                    echo $r . " ";
                }
                echo "</h2>";
            }
            if (count($storage) > 0) {
                echo "<h2>Depolama: ";
                foreach ($storage as $s) {
                    echo $s . " ";
                }
                echo "</h2>";
            }

            if ($search != '') {
                echo "<h2>Arama: $search</h2>";
            }
            //! END TESTING
            /* If these values are not set, use * instead of filtering */

            ?>

        </div>
    </div>
</body>

</html>