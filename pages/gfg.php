<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
	function get_data(){
		$name = $_POST['name'];
		$serie = $_POST['serie'];
		$file_name = '../bingos/polymangaBingo'.'.json';
		$filename = "";
		
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
				'nom' => $_POST['name'],
				'serie' => $_POST['serie'],
				'image' => "$filename"
			);
			$array_data[]=$extra;
//			echo "Le fichier existe<br>";
			return json_encode($array_data);
		}else{
			$datae=array();
			$datae[]=array(
				'id' => "1",
				'nom' => $_POST['name'],
				'serie' => $_POST['serie'],
				'image' => "$filename"
			);
//			echo "Le fichier n'existe pas<br>";
			return json_encode($datae);
		}
	}
	$file_name='../bingos/polymangaBingo'.'.json';
	if(file_put_contents("$file_name", get_data() )){/*echo 'succès';}else{echo 'Il y a eu des erreures';*/}
}
//echo '<br><br><a href="../index.php">Retour</a>';
header("location: ../index.php");
?>