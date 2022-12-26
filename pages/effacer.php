<?php
if(isset($_GET['id_perso']) && $_GET['id_perso']!=""){
	function get_data(){
		$file_name='../bingos/polymangaBingo'.'.json';
		$current_data=file_get_contents("$file_name");
		$array_data=json_decode($current_data, true);

		$id_perso=$_GET['id_perso'];
//		echo $id_perso;
//		print_r($array_data);
		foreach ($array_data as $key => $value) {
			if (in_array("$id_perso", $value)) {
				unset($array_data[$key]);
			}
		}
        return json_encode($array_data);
	}
	$idPerso = $_GET['id_perso'];
	$o = $idPerso-=1;
	
	$file_name='../bingos/polymangaBingo'.'.json';
	$current_data=file_get_contents("$file_name");
	$array_data=json_decode($current_data, true);

//	$lastElement = $array_data[array_key_last($array_data)];
//    echo $lastElement['id'];
//	echo '<br><br><br>';
	
	$image=$array_data[$o]["image"];
	
	if($image!=""){
		unlink("../images/polymanga/$image");
	}

	$file_name='../bingos/polymangaBingo'.'.json';
	if(file_put_contents("$file_name", get_data() )){/*echo 'réussi';*/}
}
header("location: ../index.php");
?>