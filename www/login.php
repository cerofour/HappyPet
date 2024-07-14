<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection details
$db_host = "localhost";
$db_name = "happypet_db";
$db_user = "happypet";
$db_pass = "happypet245";

$pdo = null;
$login_error = "";
$debug_message = "";

function connect_db() {
    global $pdo, $db_host, $db_name, $db_user, $db_pass, $debug_message;
    try {
        $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $debug_message .= "Conexión a la base de datos exitosa.<br>";
    } catch(PDOException $e) {
        $debug_message .= "Error de conexión a la base de datos: " . $e->getMessage() . "<br>";
    }
}

function attempt_login($username, $password) {
    global $pdo, $login_error, $debug_message;
    
    $debug_message .= "Intento de inicio de sesión para el usuario: " . htmlspecialchars($username) . "<br>";

    try {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            $debug_message .= "Usuario encontrado en la base de datos.<br>";
            $debug_message .= "Hash almacenado: " . $user['password'] . "<br>";
            
            if (password_verify($password, $user['password'])) {
                $debug_message .= "Contraseña verificada correctamente.<br>";
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $debug_message .= "Sesión iniciada. Redirigiendo...<br>";
                header("Location: dashboard.php");
                exit();
            } else {
                $debug_message .= "Verificación de contraseña fallida.<br>";
                $login_error = "Contraseña incorrecta";
            }
        } else {
            $debug_message .= "Usuario no encontrado en la base de datos.<br>";
            $login_error = "Usuario no encontrado";
        }
    } catch(PDOException $e) {
        $login_error = "Error en la consulta: " . $e->getMessage();
        $debug_message .= $login_error . "<br>";
    }
}

connect_db();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"])) {
    $username = $_POST["username"] ?? "";
    $password = $_POST["password"] ?? "";
    $debug_message .= "Formulario enviado. Usuario: $username<br>";
    attempt_login($username, $password);
} else {
    $debug_message .= "Página cargada sin envío de formulario.<br>";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Clínica Veterinaria HappyPet Chiclayo</title>
    <link rel="stylesheet" href="css/login-style.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <nav class="main-nav-bar">
        <ul>
            <li class="first-nav-element">
                <a href="index.html"> <img src="img/happypet-logo.png" alt="HappyPet Logo"></a>
                <div class="website-name"><a href="index.html">CLÍNICA VETERINARIA<br>HAPPYPET CHICLAYO</a></div>
            </li>
        </ul>
    </nav>

    <div class="login-container">
        <h2>Iniciar Sesión</h2>
        <?php if ($login_error) { echo "<p class='error' style='color:red' >$login_error</p>"; } ?>
        <form method="post" action="">
            <div class="input-group">
                <label for="username">Usuario:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="input-group">
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" name="login" class="login-button">Ingresar</button>
        </form>
    </div>

    <footer>
        <div class="footer-grid">
            <div class="footer-grid-item">
                <h1>LOCALES Y CONTACTO</h1>
                <p>Av. Juan Tomis Stack 941, Chiclayo, Perú</p>
                <p>987654321</p>
            </div>
        </div>
    </footer>
</body>
</html>