<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
	$file_name='../bingos/polymangaBingo'.'.json';
	$current_data=file_get_contents("$file_name");
	$array_data=json_decode($current_data, true);
	
	$array_data2=json_decode($current_data, true);
	
	$NbCases=$_POST['number'];
	$NbJoueurs=$_POST['numP'];
	
	$lastElement = $array_data[array_key_last($array_data)];
//	print_r ($lastElement);
    $nbPerso1 = $lastElement['id'];
	
	$max=$min=0;

	$max=$nbPerso1-=1;
	$resultat=array();
}else{header("location: ../index.php");}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Génération des Bingos</title>
	<link rel="stylesheet" href="../style/style.css">
	<link rel="stylesheet" href="../style/bingo.css">
</head>
<body>
	<?php require_once("menu_nav.php"); ?>
	<div id="container">
		<br><br><h2>Votre Bingo</h2><br><br><br><br>
		<?php 
		for($i=1; $i<=$NbJoueurs; $i++){
			shuffle($array_data2); 
			
			/*
			print_r($array_data2);
			echo '<br><br>'; 
			
			$dsds=$array_data2[0]["nom"];
			echo $dsds."<br><br>";
			*/
		?>
		<div class="joueur">
			<div class="enTete">
				<div class="numIdJou cont_Tete">
					N°<?php echo $i; ?>
				</div>
				<div class="nomJou cont_Tete">
					<input type="text" class="inpText" placeholder="Nom du joueur <?php echo $i; ?>">
				</div>
				<div class="infoJou cont_Tete">
					Polymanga 2022
				</div>
			</div>
			<?php
			for($o=0; $o<$NbCases; $o++){
					
				$id=$array_data2[$o]["id"];
				$nom=$array_data2[$o]["nom"];
				$serie=$array_data2[$o]["serie"];
				$image=$array_data2[$o]["image"];
			?>
			<style>
				#image_<?php echo $i; ?>_<?php echo $o; ?>{
					background-image: url(../images/polymanga/<?php echo $image; ?>);
					background-position: center;
					background-repeat: no-repeat;
					background-size: contain;
					
/*
					background-image: url(../images/polymanga/<?php echo $image; ?>), url(../images/polymanga/<?php echo $image; ?>);
					background-position: center, center;
					background-repeat: no-repeat, no-repeat;
					background-size: contain, cover;
					background-blend-mode: normal, exclusion;
*/
				}
			</style>
			<div class="perso">
				<div id="image_<?php echo $i; ?>_<?php echo $o; ?>" class="image card_content">
					<div class="id_perso"><?php echo $id; ?></div>
<!--					<img src="../images/polymanga/<?php echo $image; ?>" alt="Pas d'image de <?php echo "$nom de la série $serie"; ?>.">-->
				</div>
				<div class="titre card_content"><?php echo $nom; ?></div>
				<div class="serie card_content"><?php echo $serie; ?></div>
				<div class="vue card_content">Vue : </div>
			</div>
			<?php } ?>
		</div>
		<?php } ?>
		
		
		
		
		<!--
		<?php $i=1; while($i<=$NbJoueurs){ ?>
		<div class="joueur">
			<?php
			while(count($resultat)<$NbCases){
				$rand=mt_rand($min, $max);
//				echo $rand;
				if(!in_array($rand, $resultat)/* && in_array($rand, $array_data)*/){
					array_push($resultat, $rand);
					
					$id=$array_data[$rand]["id"];
					$nom=$array_data[$rand]["nom"];
					$serie=$array_data[$rand]["serie"];
					$image=$array_data[$rand]["image"];
			?>
			<div class="perso">
				<div class="image"></div>
				<div class="titre"><?php echo $nom; ?></div>
				<div class="serie"><?php echo $serie; ?></div>
				<div class="id"><?php echo $id; ?></div>
				<div class="vue">Vue : </div>
			</div>
			<?php } } $resultat=array(); ?>
		</div>
		<?php $i++; } ?>
		-->
	</div>
</body>
</html>