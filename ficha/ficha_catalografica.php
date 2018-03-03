<?php
    error_reporting(0);
    ini_set('display_errors', 0);
    // Verifica se foi entrado um nome no formulário
    $nome = $_POST["nome"];
    if(empty($nome)){ // Se não houver valor para nome, apresenta o formulário para ser preenchido
?>
<html>
    <?php
        include('template/header.html');
        include('template/body.html');
        include('template/footer.html');
    ?> 
</html>

    <?php
        include('js/cursos.html');
        include('js/addOrientadores.html');
    ?>

<?php
    }else

    {
        // há alguma informação no formulário de entrada
        // carrega o pacote de geração de PDF
        require('pdf-php/class.ezpdf.php');

        //$cutter = $_POST["cutter"];
        $nome = $_POST["nome"];
        $sobrenome = $_POST["sobrenome"];
        $tituloTrabalho = $_POST["tituloTrabalho"]; 
        $subTituloTrabalho = $_POST["subTituloTrabalho"]; 
        $cursoPrograma = $_POST["cursoPrograma"];
        $tipoTrabalho = $_POST["tipoTrabalho"];  // tese / dissertação
        $nomeOrientador = $_POST["nomeOrientador"]; // nome do orientador
        $nomeCoorientador = $_POST["nomeCoorientador"]; // nome do coorientador
        $ano = $_POST["ano"];
        $ilustracoes = $_POST["ilustracoes"];
        $alturaFolha = $_POST["alturaFolha"];
        $numeroArabico = $_POST["numeroArabico"];
        $palavraChave1 = $_POST["palavraChave1"];  
        $palavraChave2 = $_POST["palavraChave2"];  
        $palavraChave3 = $_POST["palavraChave3"];  
        $palavraChave4 = $_POST["palavraChave4"];  
        $palavraChave5 = $_POST["palavraChave5"];       

        //$codigo1 = substr($sobrenome,0,1); //retorna a primeira letra do sobrenome
        
        // separa o título por espaços em branco e verifica a primeira palavra
        // se a primeira palavra for uma stopword, o $codigo2 será a primeira letra da segunda palavra do título
        $vetitulo = explode(" ",$tituloTrabalho);

        $stopwords = array ("o", "a", "os", "as", "um", "uns", "uma", "umas", "de", "do", "da", "dos", "das", "no", "na", "nos", "nas", "ao", "aos", "à", "às", "pelo", "pela", "pelos", "pelas", "duma", "dumas", "dum", "duns", "num", "numa", "nuns", "numas", "com", "por", "em");
        
        if (in_array (strtolower($vetitulo[0]), $stopwords)){
            $codigo2 = strtolower(substr($vetitulo[1],0,1)); //subtstr: a própria string, o índice inicial e a quantidade de caracteres a ser retornada.

            if($codigo2 == 'l'){
                $codigo2 = (substr($vetitulo[1], 0, 3));
            }
        }
        else{
            $codigo2 = strtolower(substr($vetitulo[0],0,1));

            if($codigo2 == 'l'){
                $codigo2 = strtolower(substr($vetitulo[0], 0, 3));
            }

        }
        // monta o Código Cutter
        $codigo = $cutter.$codigo2;
        
        if(!empty($ilustracoes)){
            $formato = implode(", ",$ilustracoes);
        }

        if(empty($subTituloTrabalho)){
            $texto = $sobrenome.", ".$nome."\n     ".$tituloTrabalho." / ".$nome." ".$sobrenome. ". Manaus : [s.n], ".$ano.".\n   ".$numeroArabico." f.: ".$formato."; ".$alturaFolha." cm.\n\n";
        }else{
            // monta informações da ficha catalográfica 
            $texto = $sobrenome.", ".$nome."\n     ".$tituloTrabalho." : ".$subTituloTrabalho." / ".$nome." ".$sobrenome. ". Manaus : [s.n], ".$ano.".\n   ".$numeroArabico." f.: ".$formato."; ".$alturaFolha." cm.\n\n";
        }
       
        
        if($tipoTrabalho == "tese"){ $texto .= "     Tese - "; }

        if($tipoTrabalho == "dissertacao"){ $texto .= "     Dissertação - "; }

        if($tipoTrabalho == "tccEspecializacao"){ $texto .= "     TCC - "; }

        if($tipoTrabalho == "tccGraduacao"){ $texto .= "     TCC - "; }

        include('js/orientador.php');

        $pdf = new Cezpdf();
        $ficha = array(array('cod' => "\n".$codigo, 'ficha' => "\n".$texto));
        // Gera a ficha em pdf
        $pdf -> selectFont('pdf-php/fonts/Times-Roman.afm');
        $pdf -> ezText("\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n");
        $pdf -> rectangle(100,45,400,285);
        $pdf -> ezText("<b>Ficha Catalográfica</b>", 15, array('justification' => 'center'));
        $pdf -> ezText("Ficha catalográfica elaborada automaticamente de acordo com os dados fornecidos pelo(a) autor(a).\n<b>Sistema Integrado de Bibliotecas da Universidade do Estado do Amazonas.</b>\n", 12, array('justification' => 'center')); 
        $pdf -> ezTable($ficha,'','', array ('fontSize' => 12,'showHeadings'=>0, 'showLines'=>0, 'width'=>345, 'cols' =>array('cod'=>array('width'=>60))));
       	$pdf -> ezStream();
    }
?>