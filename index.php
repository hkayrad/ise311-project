<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="./assets/brand/favicon.ico" type="image/x-icon">
	<link rel="stylesheet" href="./index.css">
	<link rel="stylesheet" href="./styles/index/index.css"> <!-- Page styles -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Host+Grotesk:ital,wght@0,300..800;1,300..800&display=swap"
		rel="stylesheet">
	<title>Hepsiburada</title>

	<script>
		const resetSearchParams = () => {
			window.location.href = window.location.href.split("?")[0];
		}
	</script>
</head>

<body>
	<div id="form">



	</div>
	<?php
	include "./config.php"; //? Connect to database
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
				$searchQuery = isset($_GET['s']) ? $_GET['s'] : '';
				echo "<input style=\"display:none\" type=\"text\" name=\"s\" value=\"" . $searchQuery . "\" />";
				?> <!-- //! Prevent the search from disappearing after using filters -->
				
				<?php //? Dynamically add types
			
				$typeQuery = "SELECT DISTINCT type FROM products";
				$typeResult = mysqli_query($conn, $typeQuery);

				if (!$typeResult) {
					die("Query error! " . mysqli_error($conn));
				} else {
					while ($row = mysqli_fetch_assoc($typeResult)) {
						echo "<div>
							<input type=\"checkbox\" name=\"type[]\" value=\"" . strtolower($row['type']) . "\" id=\"" . $row['type'] . "\" />
							<label for=\"" . $row['type'] . "\">" . ucfirst($row['type']) . "</label>
						</div>";
					}
				}
				?>


				<h4>Marka</h4>

				<?php /* .//? Dynamically add brands */

				$brandQuery = "SELECT DISTINCT brand FROM products";
				$brandResult = mysqli_query($conn, $brandQuery);

				if (!$brandResult) {
					die("Query error! " . mysqli_error($conn));
				} else {
					while ($row = mysqli_fetch_assoc($brandResult)) {
						echo "<div>
                            <input type=\"checkbox\" name=\"brand[]\" value=\"" . strtolower($row['brand']) . "\" id=\"" . $row['brand'] . "\" />
                            <label for=\"" . $row['brand'] . "\">" . $row['brand'] . "</label>
                        </div>";
					}
				}

				?>
				<h4>Fiyat</h4>
				<div id="price">
					<input type="number" name="price[min]" placeholder="Min" />
					<p>-</p>
					<input type="number" name="price[max]" placeholder="Max" />
				</div>
				<h4>Rating</h4>
				<?php //? Dynamically add ratings

				$ratingQuery = "SELECT DISTINCT rating FROM products ORDER BY rating DESC";
				$ratingResult = mysqli_query($conn, $ratingQuery);

				if (!$ratingResult) {
					die("Query error! " . mysqli_error($conn));
				} else {
					while ($row = mysqli_fetch_assoc($ratingResult)) {
						echo "<div>
                            <input type=\"radio\" name=\"rating\" value=\"" . $row['rating'] . "\" id=\"" . $row['rating'] . "\" />
                            <label for=\"" . $row['rating'] . "\">" . str_repeat('⭐', $row['rating']) . "</label>
                        </div>";
					}
				}

				?>

				<h4>CPU</h4>
				<?php
				$cpuQuery = "SELECT DISTINCT cpu FROM products";
				$cpuResult = mysqli_query($conn, $cpuQuery);

				if (!$cpuResult) {
					die("Query error! " . mysqli_error($conn));
				} else {
					while ($row = mysqli_fetch_assoc($cpuResult)) {
						echo "<div>
							<input type=\"checkbox\" name=\"cpu[]\" value=\"" . $row['cpu'] . "\" id=\"" . $row['cpu'] . "\" />
							<label for=\"" . $row['cpu'] . "\">" . $row['cpu'] . "</label>
						</div>";
					}
				}
				?>

				<h4>RAM</h4>
				<?php //? Dynamically add RAM sizes

				$ramQuery = "SELECT DISTINCT ram FROM products";
				$ramResult = mysqli_query($conn, $ramQuery);

				if (!$ramResult) {
					die("Query error! " . mysqli_error($conn));
				} else {
					while ($row = mysqli_fetch_assoc($ramResult)) {
						echo "<div>
                            <input type=\"checkbox\" name=\"ram[]\" value=\"" . $row['ram'] . "\" id=\"" . $row['ram'] . "\" />
                            <label for=\"" . $row['ram'] . "\">" . $row['ram'] . " GB</label>
                        </div>";
					}
				}
				?>

				<h4>Depolama</h4>
				<?php //? Dynamically add storage sizes

				$storageQuery = "SELECT DISTINCT storage FROM products";
				$storageResult = mysqli_query($conn, $storageQuery);

				if (!$storageResult) {
					die("Query error! " . mysqli_error($conn));
				} else {
					while ($row = mysqli_fetch_assoc($storageResult)) {
						echo "<div>
                            <input type=\"checkbox\" name=\"storage[]\" value=\"" . $row['storage'] . "\" id=\"" . $row['storage'] . "\" />
                            <label for=\"" . $row['storage'] . "\">" . $row['storage'] . " GB</label>
                        </div>";
					}
				}
				?>

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

			$query = "SELECT * FROM products";
			$prodcuts = mysqli_query($conn, $query);

			if (!$prodcuts) {
				die("Query error! " . mysqli_error($conn));
			} else {
				while ($row = mysqli_fetch_assoc($prodcuts)) {
					echo "<a href='./products.php?id=".$row['id']."' id='productCard'>
							<img id='productImg' src='https://placehold.co/600x400'/>
				<h2>".$row['brand']." ".$row['model']."</h2>
				<p>".$row['price']." ₺</p>
			</a>";
				}
			}

			?>
		</div>
</body>

</html>