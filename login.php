<?php
session_start();
$error = '';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
    $username = htmlspecialchars(trim($_POST['username']));
    $password = htmlspecialchars(trim($_POST['password']));

    $valid_username = 'jose.pinzon@labbrands.com';
    $valid_password = 'password'; // 

    // Comprobar las credenciales
    if ($username === $valid_username && $password === $valid_password) {
        $_SESSION['username'] = $username;
        header("Location: index.php"); 
        exit();
    } else {
        $error = "Nombre de usuario o contraseña incorrectos.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="style.css"/>
</head>
<body>
    <div class="login-container">
        <div class="login-box">
        <img src="https://www.labbrands.com/wp-content/uploads/2019/11/cropped-Logo-Lab-Brands.png" alt="Logo" class="logo" style="height=70px;">
            <h2>Iniciar Sesión</h2>
            <?php if ($error): ?>
                <p style="color: red;"><?php echo $error; ?></p>
            <?php endif; ?>
            <form method="POST" action="">
                <div class="form-group">
                    <input type="text" name="username" placeholder="Nombre de usuario" required>
                </div>
                <div class="form-group">
                    <input type="password" name="password" placeholder="Contraseña" required>
                </div>
                <button type="submit">Ingresar</button>
            </form>
        </div>
    </div>
</body>
</html>