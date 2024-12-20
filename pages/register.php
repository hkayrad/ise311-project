<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kayıt Ol</title>

    <?php
    session_start();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        try {
            $pdo = new PDO("mysql:host=localhost;dbname=ise_project;charset=utf8", "root", "");
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

                echo "<p style='color:green;'>Kayıt başarılı! Giriş yapmak için <a href='./login.php'>tıklayın</a>.</p>";
            }
        } catch (PDOException $e) {
            echo "Veritabanı hatası: " . $e->getMessage();
        }
    }
    ?>
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

        .register-container {
            background: rgba(255, 255, 255, 0.8);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            text-align: center;
        }

        .register-container h1 {
            margin-bottom: 20px;
        }

        .register-container form {
            width: 250px;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
        }

        .register-container label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            text-align: left;
        }

        .register-container input[type="text"], 
        .register-container input[type="email"], 
        .register-container input[type="password"] {
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .register-container input[type="submit"] {
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

        .register-container a {
            color: #ff6000;
            text-decoration: none;
            font-weight: bold;
        }

        .register-container a:hover {
            text-decoration: underline;
        }

        p[style='color:red;'],
        p[style='color:green;'] {
            margin-bottom: 10px;
        }

        .login-link {
            margin-top: 10px;
            display: block;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <div class="register-container">
        <h1>Kayıt Ol</h1>
        <form action="./register.php" method="POST">
            <label for="username">Kullanıcı Adı:</label>
            <input type="text" id="username" name="username" required>

            <label for="email">E-posta:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Şifre:</label>
            <input type="password" id="password" name="password" required>

            <input type="submit" value="Kayıt Ol">

            
            <a href="./login.php" class="login-link">Hesabın var mı? Giriş Yap</a>
        </form>
    </div>
</body>

</html>