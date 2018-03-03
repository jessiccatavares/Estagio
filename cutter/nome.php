<?php

	$nome = "vasconcelos";
	$tam = strlen($nome);

	for ($i=strlen($nome); $i >=1 ; $i--) { 
		$palavra = substr($nome,0,$tam);	
		$tam--;
		echo $palavra."<br>";
	}
?>