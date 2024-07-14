<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/citas-style.css">
    <link rel="stylesheet" href="styles.css">
    <title>Dashboard - Clínica Veterinaria HappyPet Chiclayo</title>
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

    <div class="dashboard-container">
		<br>
        <h1 style="text-align: center">Panel de Control</h1>
        <h2 style="text-align: center">Citas Agendadas</h2>
        <ul class="citas-list"></ul>
    </div>

	<footer>
		<div class="footer-grid">
			<div class="footer-grid-item">
				<h1>LOCALES Y CONTACTO</h1>
				<p>Av. Juan Tomis Stack 941, Chiclayo, Perú</p>
				<p>987654321</p>
				<p>074 654 3210</p>
				<br>
				<p>Av. Pacífico 171, Chiclayo, Perú</p>
				<p>987654321</p>
				<p>074 654 3210</p>
				<br>
				<p>Av. Panamericana Norte, Chiclayo, Perú</p>
				<p>987654321</p>
				<p>074 654 3210</p>
				<br>
				</div>
			<div class="footer-grid-item">
				<h1>HORARIOS</h1>
				<p>HappyPet Av Juan Tomis</p>
				<p>09:00am - 08:00pm</p>
				<br>
				<p>HappyPet Urb Miraflores</p>
				<p>09:00am - 08:00pm</p>
				<br>
				<p>HappyPet Coquetos</p>
				<p>09:00am - 08:00pm</p>
				<br>
			</div>
		<div class="footer-grid-item">
			<img src="img/happypet-logo.png" alt="">
		</div>
		</div>
	</footer>


    <script src="scripts.js"></script>
    <script src="js/contact.js"></script>
</body>
</html>