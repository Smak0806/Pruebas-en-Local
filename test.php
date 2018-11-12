<?php
	$array_prueba = [
		"index_1" => "valor1",
		"index_2" => "valor2",
		"index_3" => "valor3"
	];

	echo var_dump($array_prueba)."<br><br>";

	foreach ($array_prueba as $key => $value) {
		echo "$key - $value<br>";
	}
	

?>