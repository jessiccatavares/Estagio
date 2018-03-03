<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Sistema de busca interna com PHP/MySQL</title>
</head>

<body>
<form name="frmBusca" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>?a=buscar" >
    <input type="text" name="palavra" />
    <input type="submit" value="Buscar" />
</form>


<?php
// Mysql database
$servername = "localhost";
$username = "root";
$password = "123";
$dbname = "cutter";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

if(!$conn){
	die("Connection failed: " . mysqli_connect_error());
}


// Recuperamos a ação enviada pelo formulário
$a = $_GET['a'];

// Verificamos se a ação é de busca
if($a == "buscar") {
	// Pegamos a palavra
	$texto = trim($_POST['palavra']);
	$tam = strlen($texto);
	for ($i=$tam; $i >= 1 ; $i--) {
		$palavra = substr($texto,0,$tam);
		$sql = " SELECT * FROM users WHERE nome LIKE '%".$palavra."%'";
		$resultado = mysqli_query($conn,$sql) or die("erro");
		$produto = mysqli_fetch_array($resultado);
		$letra = substr($palavra, 0, 1);
		$codigo = $produto['codigo'];
		$nome = $produto['nome'];
		if($nome[0] == $letra){
			echo $codigo." - ".$nome."<br>";
		}
		$tam--;
	}

}
mysqli_close($conn);
?>
</body>
</html>