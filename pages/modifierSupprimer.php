<?php 
$file_name = '../bingos/polymangaBingo'.'.json';
if(!file_exists("$file_name")){header("location: ../index.php");}

$current_data=file_get_contents("$file_name");
$array_data=json_decode($current_data, true);

$json_array = $array_data;
$nbPerso = count($json_array);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Modifier / Supprimer</title>
	<link rel="stylesheet" href="../style/style.css">
	<style>
		h2{text-align: center;}
	</style>
</head>
<body>
	<?php require_once("menu_nav.php"); ?>
	<div id="container">
		<h2>Vo<?php if($nbPerso>1){echo 's';}else{echo 'tre';} ?> personnage<?php if($nbPerso>1){echo 's';} ?></h2><br>
		<?php
		if(file_exists("$file_name")){
			$current_data=file_get_contents("$file_name");
			$array_data=json_decode($current_data, true);

			$json_array = $array_data;
			$nbPerso = count($json_array);
		?>
		<table>
			<th>id</th><th>nom</th><th>série</th><th>image</th><!--<th>modifier</th>--><th>supprimer</th>
			<?php
			$lastElement = $array_data[array_key_last($array_data)];
    		$nbPersoList = $lastElement['id'];
			for($o=0; $o<=$nbPersoList; $o++){
				if(isset($array_data[$o]["id"])){
					$id=$array_data[$o]["id"];
					$nom=$array_data[$o]["nom"];
					$serie=$array_data[$o]["serie"];
					$image=$array_data[$o]["image"];
			?>
			<tr>
				<td><?php echo $id; ?></td>
				<td><?php echo $nom; ?></td>
				<td><?php echo $serie; ?></td>
				<td><img src="../images/polymanga/<?php echo $image; ?>" alt="Pas d'image de <?php echo "$nom de la série $serie"; ?>."></td>
<!--				<td><a href="modifier.php?id_perso=<?php echo $id; ?>" title="Modifier">Modifier</a></td>-->
				<td>
					<a href="effacer.php?id_perso=<?php echo $id; ?>" title="Effacer" onclick="return confirm('Voulez-vous vraiment supprimer <?php echo $nom; ?> de la série <?php echo $serie; ?> ?\nCe seras définitif !');">
						<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="red" class="bi bi-trash-fill" viewBox="0 0 16 16">
							<path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
						</svg>
					</a>
				</td>
			</tr>
			<?php } } ?>
		</table>
		<?php } ?>
	</div>
</body>
</html>