<?php
//if($_SERVER['REQUEST_METHOD'] != 'GET'){header("location: ../index.php");}
										 
$file_name='../bingos/polymangaBingo'.'.json';
$current_data=file_get_contents("$file_name");
$array_data=json_decode($current_data, true);
	
$id=$_GET['id_perso'];

//echo $id;

//print_r($array_data);
//foreach ($array_data as $key => $value) {
//	if (in_array("$id", $value)) {
//		unset($array_data[$key]);
//	}
//}

if(isset($_POST['Modifier'])){
	$id=$_POST['id_perso'];
	$nom=$_POST['nom'];
	$serie=$_POST['serie'];
	
	if(isset($_FILES['imgPerso']["name"]) && $_FILES['imgPerso']["name"]!=""){
		$fileData = pathinfo(basename($_FILES["imgPerso"]["name"]));
        $type = $fileData['extension'];

        $search1 = array(",",".");
        $search2 = array(";","§","°","+","¦","@","#","%","&","¬","(",")","¢","=","'","?","´","^","`","~","¨","!","[","]","{","}","$","£",'"',"æ","Æ","œ","Œ","ß","«","»","•","–","—","±","×","÷","²","³","€","†","‡","Æ");

        $search0 = array("à","á","â","ç","è","é","ê","ë","ì","í","î","ï","ñ","ò","ó","ô","ù","ú","û","ü","ý","ÿ","À","Á","Â","Ç","È","É","Ê","Ë","Ì","Í","Î","Ï","Ñ","Ò","Ó","Ô","Ù","Ú","Û","Ü","Ý","Ÿ");

        $newContent0 = array("a","a","a","c","e","e","e","e","i","i","i","i","n","o","o","o","u","u","u","u","y","y","A","A","A","C","E","E","E","E","I","I","I","I","N","O","O","O","U","U","U","U","Y","Y");

        $filename3 = $name."__".$serie;
        $filename2 = str_replace(" ","_",$filename3);
        $filename1 = str_replace($search1,"-",$filename2);
        $filename0 = str_replace($search0,$newContent0,$filename1);
        $filename00 = str_replace($search2,"",$filename0);
        $filename = "$filename00.$type";

        $tempname = $_FILES['imgPerso']["tmp_name"];

        $folder = "../images/polymanga/$filename";

		$msgRes="IMAGE téléchargé";
        if(move_uploaded_file($tempname, $folder) == false){$msgRes='Erreur IMAGE';}
//		echo $msgRes;
		
		$data[$id]['image'] = "$filename";
		$newJsonString = json_encode($data);
		file_put_contents($file_name, $newJsonString);
	}
	
	$data[$id]['nom'] = "$nom";
	$newJsonString = json_encode($data);
//	file_put_contents($file_name, $newJsonString);
	
	$data[$id]['serie'] = "$serie";
	$newJsonString = json_encode($data);
//	file_put_contents($file_name, $newJsonString);
	
	header("location: ../index.php");
}

//print_r(array_keys($array_data[0]));

$idPerso = array_column($array_data, 'id');
$found_key = array_search($id, $idPerso);
//echo $found_key;

$nom=$array_data[$found_key]["nom"];
$serie=$array_data[$found_key]["serie"];
$image=$array_data[$found_key]["image"];
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Modification de l'id N°<?php echo $id; ?></title>
	<link rel="stylesheet" href="../style/style.css">
	<link rel="stylesheet" href="../style/modifier.css">
	<style>
/*		p, h1, h2, h3, h4, h5, h6, label{color: white;}*/
/*
		.contForm{
			float: left;
			height: 250px;
			width: 100%;
		}
*/
		#section_2{
			background-image: url("../images/polymanga/<?php echo $image; ?>");
/*
			background-position: center;
			background-size: contain;
			background-repeat: no-repeat;
*/
		}
/*
		#section_2, #section_3{width: 50%;}
		svg{
			color: #c1c1c1;
			transition: all 0.3s ease-in-out;
		}
*/
/*
		svg:hover{
			fill: #FCFCFC;
			transition: all 0.2s ease-in-out;
		}
*/
	</style>
</head>
<body>
	<?php require_once("menu_nav.php"); ?>
	<div id="container">
<!--
		<div id="section_0">
			<a href="../index.php" id="btnRetour" title="Retour">
				<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="#c1c1c1" class="bi bi-house-door fel" viewBox="0 0 16 16">
					<path d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4.5a.5.5 0 0 0 .5-.5v-4h2v4a.5.5 0 0 0 .5.5H14a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146zM2.5 14V7.707l5.5-5.5 5.5 5.5V14H10v-4a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v4H2.5z"/>
				</svg>
			</a>
		</div>
-->
		
		<form action="modifier.php" method="post" enctype="multipart/form-data">
			<div id="section_1" class="contForm">
				<label for="nom">Nom du personnage </label>
				<input type="text" id="nom" class="inpText" placeholder="Nom du personnage" name="nom" value="<?php echo $nom; ?>" required>
				<br><br><br><br>
				<label for="serie">Nom de la série </label>
				<input type="text" class="inpText" placeholder="Série" id="serie" name="serie" value="<?php echo $serie; ?>" required>
				<input type="hidden" id="id_perso" name="id_perso" value="<?php echo $id; ?>">
			</div>
			
			<div id="section_2" class="contForm"></div>
			
			<div id="section_3" class="contForm">
				<label for="imgPerso">Image du personnage</label><br><br>
				<input type="file" class="imgPerso" id="imgPerso" name="imgPerso" accept="image/*">
			</div>
			
			<div id="section_4" class="contForm">
				<input type="submit" id="Modifier" name="Modifier" value="Modifier">
			</div>
		</form>
	</div>
</body>
</html>