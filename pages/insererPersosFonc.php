<?php
if($_SERVER['REQUEST_METHOD']!='POST' && !isset($_POST['submit'])){header("location: ajouter.php");}

$file_name='../bingos/polymangaBingo'.'.json';
$current_data=file_get_contents("$file_name");
$array_data=json_decode($current_data, true);

$numPers=$_POST['numPers'];

for($i=1; $i<=$numPers; $i++){
	$name=$_POST["name_$i"];
	$serie=$_POST["serie_$i"];
	$image=$_FILES["imgPerso_$i"];
	
//	function get_data($nameF, $serieF, $imageF){
		$name = $nameF = $_POST["name_$i"];
		$serie = $serieF = $_POST["serie_$i"];;
		$file_name = '../bingos/polymangaBingo'.'.json';
		$filename = "";
		
		if(isset($_FILES["imgPerso_$i"]["name"]) && $_FILES["imgPerso_$i"]["name"]!=""){
			$fileData = pathinfo(basename($_FILES["imgPerso_$i"]["name"]));
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
			
			$tempname = $_FILES["imgPerso_$i"]["tmp_name"];

			$folder = "../images/polymanga/$filename";

			if(move_uploaded_file($tempname, $folder) == false){/*echo 'Erreur IMAGE';*/}else{/*echo 'IMAGE téléchargé';*/}
		}
		
		if(file_exists("$file_name")){
			$current_data=file_get_contents("$file_name");
			$array_data=json_decode($current_data, true);
			
			$json_array = $array_data;
//			$nbPerso1 = count($json_array);
//			echo $nbPerso1;
//			$nbPerso = $nbPerso1+=1;
			
			$lastElement = $array_data[array_key_last($array_data)];
    		$nbPerso1 = $lastElement['id'];
			$nbPerso = $nbPerso1+=1;
			
			$extra=array(
				'id' => "$nbPerso",
				'nom' => $name,
				'serie' => $serie,
				'image' => "$filename"
			);
			$array_data[]=$extra;
//			echo "Le fichier existe<br>";
			
//			return json_encode($array_data);
			$donne=json_encode($array_data);
		}else{
			$datae=array();
			$datae[]=array(
				'id' => "1",
				'nom' => $name,
				'serie' => $serie,
				'image' => "$filename"
			);
//			echo "Le fichier n'existe pas<br>";
//			return json_encode($datae);
			$donne=json_encode($datae);
		}
		file_put_contents("$file_name", $donne);
//	}
	
	$file_name='../bingos/polymangaBingo'.'.json';
//	if(file_put_contents("$file_name", get_data($name, $serie, $image) )){
//		echo 'succès';
//	}else{
//		echo 'Il y a eu des erreures';
//	}
	
//	usleep(20000);
}
echo '<a href="../index.php">Retour</a>';
//header("location: ../index.php");
?>