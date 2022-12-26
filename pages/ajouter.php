<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Ajouter des persos</title>
	<link rel="stylesheet" href="../style/style.css">
	<link rel="stylesheet" href="../style/ajouter.css">
	<style>
		form{
			display: flex;
			justify-content: center;
		}
	</style>
</head>
<body>
	<?php require_once("menu_nav.php"); ?>
	<br><br>
	<div id="container">
		<br><br>
		<form action="insererPersos.php" method="post">
			<input type="number" class="inpText" id="num" placeholder="Nombre de nouveaux personnages" name="num" min="1" required>
			<input type="submit" class="submit" id="submit" name="submit" value="Aller à l'insertion >>">
		</form>
		<br><br>
	</div>
</body>
</html>