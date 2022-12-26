<?php $file_name = 'bingos/polymangaBingo'.'.json'; ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Accueil</title>
	<link rel="stylesheet" href="style/style.css">
	<link rel="stylesheet" href="style/index.css">
	<!--<style>
		p, h1, h2, h3, h4, h5, h6{color: white;}
		img{
			width: auto;
			height: auto;
			max-height: 100px;
		}
		/*	TABLE*/
		
		td, th {
    		border: 1px solid rgb(190, 190, 190);
    		padding: 10px;
		}

        td {
            text-align: center;
        }
        tr:nth-child(even) {
            background-color: #111;
        }

        th[scope="col"] {
           	background-color: #696969;
    		color: #fff;
			font-size: bold;
        }

        th[scope="row"] {
            background-color: #d7d9f2;
        }

        caption {
            padding: 10px;
            caption-side: bottom;
        }
		
		th {
			background-color: #696969;
    		color: #fff;
			font-size: bold;
		}

        table {
/*			width: 95%;*/
            border-collapse: collapse;
            border: 2px solid rgb(200, 200, 200);
            letter-spacing: 1px;
            font-family: sans-serif;
            font-size: .8rem;
			margin-left: auto;
			margin-right: auto;
			color: white;
        }
	</style>-->
</head>
<body>
	<div id="container">
		<?php
		require_once("pages/menu_nav_index.php");
		if(file_exists("$file_name")){
			$current_data=file_get_contents("$file_name");
			$array_data=json_decode($current_data, true);

			$json_array = $array_data;
			$nbPerso = count($json_array);
		?>
		<br>
		<div id="genererBingo">
			<form action="pages/genererBingo.php" method="post" id="Form_01" name="Form_01" class="Form_01">
				<fieldset>
					<legend>Générer un Bingo</legend>
					
					<input type="number" class="inpText" name="number" id="number" placeholder="Nb. Cases" min="1" max="<?php echo $nbPerso; ?>" required>
					<input type="number" class="inpText" name="numP" id="numP" placeholder="Nb. Joueurs" min="1" required>
<!--					<input type="text" class="inpText" id="nomJp" placeholder="Nom des joueurs" name="nomJp" required>-->
					<input type="submit" class="submit" name="generer" id="generer" value="Générer">
				</fieldset>
			</form>
		</div>
		<br>
		<?php } ?>
		<br>
		<div id="ajouterBD">
			<form action="pages/gfg.php" method="post" enctype="multipart/form-data">
				<fieldset>
					<legend>Ajouter un personnage</legend>
					
					<?php
					if(file_exists("$file_name")){
						$current_data=file_get_contents("$file_name");
						$array_data=json_decode($current_data, true);

						$json_array = $array_data;
						$nbPerso = count($json_array);
					?>
					<br><br><p class="textNum">Vous avez <strong><?php echo $nbPerso; ?></strong> personnage<?php if($nbPerso>1){echo 's';} ?> d'enrengistré<?php if($nbPerso>1){echo 's';} ?>.</p><br><br>
					<?php } ?>
					<input type="text" class="inpText" id="name" placeholder="Nom" name="name" required>
					<input type="text" class="inpText" placeholder="Série" name="serie" required>
					<input type="file" class="imgPerso inpText" id="imgPerso" name="imgPerso" accept="image/*" required>
					<br><br>
					<input type="submit" class="submit" id="submit" name="submit" value="Ajouter" onClick="on_submit()">
				</fieldset>
			</form>
		</div>
		<br><br><br>
		<?php if(isset($nbPerso)){ ?>
		<div id="voirBD">
			<h2>Vo<?php if(isset($nbPerso) && $nbPerso>1){echo 's';}else{echo 'tre';} ?> personnage<?php if($nbPerso>1){echo 's';} ?></h2><br>
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
					<td><img src="images/polymanga/<?php echo $image; ?>" alt="Pas d'image de <?php echo "$nom de la série $serie"; ?>."></td>
<!--					<td><a href="pages/modifier.php?id_perso=<?php echo $id; ?>" title="Modifier">Modifier</a></td>-->
					<td>
						<a href="pages/effacer.php?id_perso=<?php echo $id; ?>" title="Effacer" onclick="return confirm('Voulez-vous vraiment supprimer <?php echo $nom; ?> de la série <?php echo $serie; ?> ?\nCe seras définitif !');">
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
		<?php } ?>
	</div>
</body>
</html>