<?php
if($_SERVER['REQUEST_METHOD']!='POST' && !isset($_POST['submit'])){header("location: ajouter.php");}
$numpers = $_POST['num'];
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Ajouter <?php echo $numpers; ?> personnage<?php if($numpers>=2){echo 's';} ?></title>
	<link rel="stylesheet" href="../style/style.css">
	<link rel="stylesheet" href="../style/ajouter.css">
</head>
<body>
	<?php require_once("menu_nav.php"); ?>
	<br><br>
	<div id="container">
		<br><br>
		<form action="insererPersosFonc.php" method="post" enctype="multipart/form-data">
			<?php for($i=1; $i<=$numpers; $i++){ ?>
			<fieldset>
				<legend>Personnage <?php echo $i; ?></legend>
				<br>
				<input type="text" class="inpText" id="name_<?php echo $i; ?>" placeholder="Nom" name="name_<?php echo $i; ?>" required><br><br>
				<input type="text" class="inpText" id="serie_<?php echo $i; ?>" placeholder="Série" name="serie_<?php echo $i; ?>" required><br><br>
				<input type="file" class="imgPerso inpText" id="imgPerso_<?php echo $i; ?>" name="imgPerso_<?php echo $i; ?>" accept="image/*" required><br>
				<br>
			</fieldset>
			<?php } ?>
			<div id="btnSub">
				<input type="hidden" name="numPers" id="numPers" value="<?php echo $numpers; ?>">
				<input type="submit" class="submit" id="submit" name="submit" value="Insérer <?php echo $numpers; ?> personnage<?php if($numpers>=2){echo 's';} ?>">
			</div>
		</form>
		<br><br>
	</div>
</body>
</html>