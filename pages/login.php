<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usernameOrEmail = $_POST['username'];
    $password = $_POST['password'];

    try {
        $pdo = new PDO("mysql:host=localhost;dbname=ise_project;charset=utf8", "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username OR email = :username LIMIT 1");
        $stmt->execute(['username' => $usernameOrEmail]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            
            echo "<script>
                    sessionStorage.setItem('user_id', '{$user['user_id']}');
                    sessionStorage.setItem('username', '{$user['username']}');
                    window.location.href = '../index.php';
                  </script>";
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
    <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        body {
            display: flex;
            justify-content: center; 
            flex-direction: column-reverse;
            align-items: center; 
            background: #f0f0f0;
            font-family: Arial, sans-serif;
        }

        .login-container {
            background: rgba(255, 255, 255, 0.8);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            text-align: center;
        }

        .login-container h1 {
            margin-bottom: 32px;
        }

        .login-container form {
            width: 250px; 
            margin: 0 auto;
            display: flex;
            flex-direction: column;
        }

        .login-container label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            text-align: left;
            width: fit-content;
        }

        .login-container input[type="text"], 
        .login-container input[type="password"] {
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .login-container input[type="submit"] {
            width: 100%;
            padding: 10px;
            background: #ff6000; 
            border: none;
            border-radius: 4px;
            color: #fff;
            font-weight: bold;
            cursor: pointer;
            margin: 24px 0 0 0;
        }

        .login-container a {
            display: block;
            margin-top: 10px;
            color: #ff6000; 
            text-decoration: none;
            font-weight: bold;
        }

        .login-container a:hover {
            text-decoration: underline;
        }

        p[style='color:red;'] {
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <h1>Giriş Yap</h1>
        <form action="./login.php" method="POST">
            <label for="username">Kullanıcı Adı veya E-posta:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Şifre:</label>
            <input type="password" id="password" name="password" required>

            <input type="submit" value="Giriş Yap">
            <a href="./register.php">Kayıt Ol</a>
        </form>
    </div>
    <a href="../"><img src="../assets/brand/logo.svg" alt="logo" style="width: 350px; position:absolute; top:100px; left:0; right:0; margin: auto;"></a>
</body>
</html>