<?php

//$cutter = inicio + codigoDaPlanilha(sobrenome) + fim

$numeros = array("1", "2", "3", "4", "5", "6", "7", "8", "9");

$letras = array("u", "d", "t", "q", "c", "s", "s", "o", "n");

$preposicoes = array ("o", "a", "os", "as", "um", "uns", "uma", "umas", "de", "do", "da", "dos", "das", "no", "na", "nos", "nas", "ao", "aos", "à", "às", "pelo", "pela", "pelos", "pelas", "duma", "dumas", "dum", "duns", "num", "numa", "nuns", "numas", "com", "por", "em");

$inicio =  substr($sobrenome,0,1); //retorna a primeira letra do sobrenome - Maiusculo(primeiraLetraSobrenome)

// separa o título por espaços em branco e verifica a primeira palavra
$titulo = explode(" ",$tituloTrabalho);

if(in_array($titulo[0], $numeros)){ //se a primeira letra do titulo é numero
    for($i=0; $i < $numeros; $i++) { 
        if($titulo[0] == $numeros[$i]){
            $fim = $letras[$i];
            $codigo = $inicio.$fim;
        }
    }

}elseif( in_array(strtolower($titulo[0]), $preposicoes) ){ // se a primeira palavra for uma preposicao, o fim será a primeira letra da segunda palavra do título
    $fim = strtolower(substr($titulo[1],0,1)); //subtstr: a própria string, o índice inicial e a quantidade de caracteres a ser retornada.
    if($fim == "l"){ //se a primeira da segunda palavra for um 'l', retorna as três primeiras letras para não confundir com o 'i'
        $fim = strtolower(substr($titulo[1], 0, 3));
        $codigo = $inicio.$fim;
    }else{
        $fim = strtolower(substr($titulo[1],0,1)); //retorna a letra diferente de 'l'
        $codigo = $inicio.$fim;
    }

}else{
    $fim = strtolower(substr($titulo[0],0,1)); //retorna a primeira do titulo sem preposicao ou numero no inicio
    if($fim == "l"){
        $fim = strtolower(substr($titulo[0], 0, 3));
        $codigo = $inicio.$fim;
    }else{
        $fim = strtolower(substr($titulo[0],0,1));
        $codigo = $inicio.$fim;
    }
}

?>