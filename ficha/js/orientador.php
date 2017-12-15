<?php
        $universidade1 = " - Universidade do Estado do Amazonas, Manaus, ";

        if( (!empty($nomeOrientador)) AND ($nomeCoorientador[0] == '') ){
        	$cloneOrient = $nomeOrientador;
	        $tamOrientador = count($cloneOrient);

	        if($tamOrientador > 2){
	        	$ultOrientador = array_pop($cloneOrient);
	            $orient = implode("., ", $cloneOrient);
	            $orientador = $orient." e ".$ultOrientador.".";

	        }elseif($tamOrientador == 2){
	            $orientador = $cloneOrient[0]. " e ".$cloneOrient[1];
	            
	        }else{
	            $orientador = $cloneOrient[0];
	        }

	    	$texto .= "$cursoPrograma".$universidade1.$ano.".\nInclui bibliografia\nOrientador: ".$orientador."\n\n";

	    }else{
	    	$cloneOrient = $nomeOrientador;
        	$cloneCoorient = $nomeCoorientador;
        	$tamOrientador = count($cloneOrient);
        	$tamCoorientador = count($cloneCoorient);
	        
	        #orientador
	        if($tamOrientador == 1){
	        	$orientador = $cloneOrient[0];
	        }

	        if($tamOrientador == 2){
	            $orientador = $cloneOrient[0]. " e ".$cloneOrient[1];   
	        }

	        if($tamOrientador > 2){
	            $ultOrientador = array_pop($cloneOrient);
	            $orient = implode("., ", $cloneOrient);
	            $orientador = $orient." e ".$ultOrientador.".";
	        }

	        #coorientador
	        if($tamCoorientador == 1){
	            $coorientador = $cloneCoorient[0];
	        }

	        if($tamCoorientador == 2){
	            $coorientador = $cloneCoorient[0]. " e ".$cloneCoorient[1];
	        }

	        if($tamCoorientador > 2 ){
	            $ultCoorientador = array_pop($cloneCoorient);
	            $coorient = implode("., ", $cloneCoorient);
	            $coorientador = $coorient." e ".$ultCoorientador.".";
	        }

	        $texto .= "$cursoPrograma".$universidade1.$ano.".\nInclui bibliografia\nOrientador: ".$orientador."\nCoorientador: ".$coorientador."\n\n";
	    }

        if (!empty ($palavraChave1)){ $texto .= "   	 1. $palavraChave1. "; }
        if (!empty ($palavraChave2)){ $texto .= "   2. $palavraChave2. "; }
        if (!empty ($palavraChave3)){ $texto .= "   3. $palavraChave3. "; }
        if (!empty ($palavraChave4)){ $texto .= "   4. $palavraChave4. "; }
        if (!empty ($palavraChave5)){ $texto .= "   5. $palavraChave5. "; }
		
		$numerosRomanos = array("I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII", "XIII", "XIV", "XV", "XVI", "XVII", "XVIII", "XIX", "XX");
    	$universidade = "Universidade do Estado do Amazonas. ";
    	    	
	  if( (!empty($nomeOrientador)) AND ($nomeCoorientador[0] == '') ){ //array orientador não vazio e array coorientador vazio
		    for ($i = 0; $i < count($nomeOrientador); $i++) {
		        $texto .= $numerosRomanos[$i].". ".$nomeOrientador[$i]." (Orient.). ";
		    }
		    $u = count($nomeOrientador);
		    $tittle = $u + 1;
			$texto .= $numerosRomanos[$u].". ".$universidade.$numerosRomanos[$tittle].". ".$tituloTrabalho;
	   	
	   	}else{
	   		for ($i = 0; $i < count($nomeOrientador); $i++) {
	            $texto .= $numerosRomanos[$i].". ".$nomeOrientador[$i]." (Orient.). ";
	        }

	        $k = count($nomeOrientador);
	        for ($j=0; $j < count($nomeCoorientador); $j++){
	            $texto .=  $numerosRomanos[$k].". ".$nomeCoorientador[$j]." (Coorient.). ";
	            $k++;
	        }
	        $u = count($nomeOrientador) + count($nomeCoorientador);
	        $tittle = $u+1;
	        $texto .= $numerosRomanos[$u].". ".$universidade.$numerosRomanos[$tittle].". ".$tituloTrabalho;
	   	}
?>