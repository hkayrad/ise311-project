<?php
session_start(); 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    try {
        
        $pdo = new PDO("mysql:host=localhost;dbname=projeniz;charset=utf8", "kullanici_adi", "sifre");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $checkStmt = $pdo->prepare("SELECT * FROM users WHERE username = :username OR email = :email LIMIT 1");
        $checkStmt->execute([
            'username' => $username,
            'email' => $email
        ]);
        $existingUser = $checkStmt->fetch(PDO::FETCH_ASSOC);

        if ($existingUser) {
            echo "<p style='color:red;'>Bu kullanıcı adı veya e-posta zaten mevcut.</p>";
        } else {
            
            $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :password)");
            $stmt->execute([
                'username' => $username,
                'email' => $email,
                'password' => $hashedPassword
            ]);

            echo "<p style='color:green;'>Kayıt başarılı! Giriş yapmak için <a href='login.php'>tıklayın</a>.</p>";
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
    <title>Kayıt Ol</title>
</head>
<body>
    <h1>Kayıt Ol</h1>
    <form action="register.php" method="POST">
        <label for="username">Kullanıcı Adı:</label><br>
        <input type="text" id="username" name="username" required><br><br>
        
        <label for="email">E-posta:</label><br>
        <input type="email" id="email" name="email" required><br><br>

        <label for="password">Şifre:</label><br>
        <input type="password" id="password" name="password" required><br><br>
        
        <input type="submit" value="Kayıt Ol">
    </form>
</body>
</html>
