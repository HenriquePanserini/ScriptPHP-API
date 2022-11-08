<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */

	require_once 'scripts/cnn-class5.php'; 

//$pdo = mysqli_connect("127.0.0.1", "root", "t1eteoli", "barracao");
// $pdo = mysqli_connect("127.0.0.1", "root", "", "marins");
// Check connection
	if($pdo === false){
    		die("ERROR: Could not connect. " . mysqli_connect_error());
	}
 
// Escape user inputs for security

// Attempt insert query execution
	
	
	$data = mysqli_real_escape_string($pdo,$_POST['data']);
	$codcli = mysqli_real_escape_string($pdo,$_POST['codcli']);
	$bruto = mysqli_real_escape_string($pdo,$_POST['bruto']);
	$desconto = mysqli_real_escape_string($pdo,$_POST['desconto']);
	$liquido = mysqli_real_escape_string($pdo,$_POST['liquido']);
	$codven = mysqli_real_escape_string($pdo,$_POST['codven']);
	$codform = mysqli_real_escape_string($pdo,$_POST['codform']);
	$codapp = mysqli_real_escape_string($pdo,$_POST['codapp']);
	$dataincapp = mysqli_real_escape_string($pdo, $_POST['dataincapp']);
	$datasincapp = mysqli_real_escape_string($pdo, $_POST['datasincapp']);
	$tipopgto = mysqli_real_escape_string($pdo,$_POST['tipopgto']);
	$nome =  mysqli_real_escape_string($pdo, $_POST['nome']);
	
	/*$tipopgto = mysqli_real_escape_string($pdo,$_POST['tipopgto']);
	$cupom = mysqli_real_escape_string($pdo,$_POST['cupom']);
	$data = mysqli_real_escape_string($pdo,$_POST['data']);
	$codcli = mysqli_real_escape_string($pdo,strval($_POST['codcli']));
	$bruto = mysqli_real_escape_string($pdo,$_POST['bruto']);
	$desconto = mysqli_real_escape_string($pdo, $_POST['desconto']);
	$liquido = mysqli_real_escape_string($pdo, $_POST['liquido']);
	$codven = mysqli_real_escape_string($pdo, $_POST['codven']);
	$codform = mysqli_real_escape_string($pdo, $_POST['codform']);
	$codapp = mysqli_real_escape_string($pdo, $_POST['codapp']);
	$dataincapp = mysqli_real_escape_string($pdo,$_POST['dataincapp']);
	$datasincapp = mysqli_real_escape_string($pdo, $_POST['datasincapp']);
	$tipotrib = mysqli_real_escape_string($pdo,$_POST['tipotrib']);
	$nome = mysqli_real_escape_string($pdo,$_POST['nome']);*/

	//$parusuario = mysqli_real_escape_string($pdo,$_POST['parusuario']);
	//$obsped = mysqli_real_escape_string($pdo,$_POST['obsped']);

	//$sql = "INSERT INTO tslv020web (data,codcli,bruto,desconto,liquido,codven,codform,codapp,dataincapp,datasincapp,tipopgto,micro,obs) VALUES ('$data','$codcli','$bruto','$desconto','$liquido','$codven','$codform','$codapp','$dataincapp','$datasincapp','$tipopgto','$parusuario','$obsped')";

	//$sql = "INSERT INTO tslv020web (data, codcli, bruto, desconto, liquido, codven, codform, codapp, dataincapp, datasincapp, tipopgto) VALUES ('$data','$codcli','$bruto','$desconto','$liquido','$codven','$codform','$codapp','$dataincapp','$datasincapp','$tipopgto')";
	
        $sql = "INSERT INTO tslv020web (data, codcli, bruto, desconto, liquido, codven, codform, codapp, dataincapp, datasincapp, tipopgto, nome) VALUES ('$data','$codcli','$bruto','$desconto','$liquido','$codven','$codform','$codapp','$dataincapp','$dataincapp', '$tipopgto','$nome')";
	
	if(mysqli_query($pdo, $sql)){
    		echo "Records added successfully.";
	}else{
    		echo "ERROR: Could not able to execute $sql. " . mysqli_error($pdo);
	}
 
	// Close connection
	mysqli_close($pdo);
?>