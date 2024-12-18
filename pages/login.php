<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usernameOrEmail = $_POST['username'];
    $password = $_POST['password'];

    try {
        $pdo = new PDO("mysql:host=localhost;dbname=projeniz;charset=utf8", "kullanici_adi", "sifre");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);   
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username OR email = :username LIMIT 1");
        $stmt->execute(['username' => $usernameOrEmail]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['username'] = $user['username'];
            
            header("Location: index.php");
            exit;
        } else {
            echo "<p style='color:red;'>Kullanıcı adı veya şifre hatalı.</p>";
        }

    } catch (PDOException $e) {
        echo "Veritabanı hatası: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giriş Yap</title>
</head>
<body>
    <h1>Giriş Yap</h1>
    <form action="login.php" method="POST">
        <label for="username">Kullanıcı Adı veya E-posta:</label><br>
        <input type="text" id="username" name="username" required><br><br>
        
        <label for="password">Şifre:</label><br>
        <input type="password" id="password" name="password" required><br><br>
        
        <input type="submit" value="Giriş Yap">
    </form>
</body>
</html>
