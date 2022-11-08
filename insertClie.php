<?php

	require_once "scripts/cnn-class.php";

	if($pdo == false){
		die("ERROR: Could not connect.". mysqli_connect_error());
	}
	
	$nome = mysqli_real_escape_string($pdo,$_POST['nome']);
	$fants = mysqli_real_escape_string($pdo,$_POST['fants']);
	$cnpj = mysqli_real_escape_string($pdo,$_POST['cnpj']);
	$ie =  mysqli_real_escape_string($pdo, $_POST['ie']);
	$cpf = mysqli_real_escape_string($pdo,$_POST['cpf']);
	$rg = mysqli_real_escape_string($pdo,$_POST['rg']);
	$end = mysqli_real_escape_string($pdo,$_POST['end']);
	$numero = mysqli_real_escape_string($pdo,$_POST['nro']);
	$bairro = mysqli_real_escape_string($pdo,$_POST['bairro']);
	$cidade = mysqli_real_escape_string($pdo,$_POST['cida']);
	$cep = mysqli_real_escape_string($pdo,$_POST['cep']);
	$telefone = mysqli_real_escape_string($pdo,$_POST['tel']);
	$email = mysqli_real_escape_string($pdo,$_POST['email']);
	$contato = mysqli_real_escape_string($pdo,$_POST['cont']);
	$vendedor = mysqli_real_escape_string($pdo,$_POST['vend']);
	

	$sql = "INSERT INTO tslc001 (CLINOM, CLIFAN,CLICGC, CLIINS ,CLICPF, CLIRG, CLIEND, NUMERO, CLIBAI, CLICID, CLICEP, CLITEL, EMAIL, CLICON, SEQ004) 
	VALUES ('$nome','$fants','$cnpj','$ie','$cpf','$rg','$end','$numero','$bairro','$cidade','$cep','$telefone','$email','$contato','$vendedor')";
	
	if(mysqli_query($pdo, $sql)){
			echo "Records added successfully.";
	}else{
			echo "ERROR: Could not able to execute $sql. ". mysqli_error($pdo);
	}

	mysqli_close($pdo);
?>