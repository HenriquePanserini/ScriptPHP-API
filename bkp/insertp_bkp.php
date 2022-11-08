<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */

require_once 'scripts/cnn-class.php'; 


//$pdo = mysqli_connect("127.0.0.1", "root", "t1eteoli", "barracao");
//$pdo = mysqli_connect("127.0.0.1", "root", "", "marins");
 
// Check connection
if($pdo === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
// Escape user inputs for security

 
// Attempt insert query execution
$cupom = mysqli_real_escape_string($pdo,$_POST['cupom']);
$codprod = mysqli_real_escape_string($pdo,$_POST['codprod']);
$descricao = mysqli_real_escape_string($pdo,$_POST['descricao']);
$quant = mysqli_real_escape_string($pdo,$_POST['quant']);
$unit = mysqli_real_escape_string($pdo,$_POST['unit']);
$desconto = mysqli_real_escape_string($pdo,$_POST['desconto']);
$preco1 = mysqli_real_escape_string($pdo,$_POST['preco1']);
$total = mysqli_real_escape_string($pdo,$_POST['total']);
$codapp2 = mysqli_real_escape_string($pdo,$_POST['codapp2']);
$uni = mysqli_real_escape_string($pdo,$_POST['uni']);



//$sql = "INSERT INTO tslv021(cupom,codprod,descricao,quant,unit,desconto,preco1,total,codappl,unidade) VALUES //('$cupom','$codprod','$descricao','$quant','$unit','$desconto','$preco1','$total','$codapp2','$uni')";


$sql = "INSERT INTO tslv021(cupom,codprod,descricao,quant,unit,desconto,bkppreco,total,codappl,unidade) VALUES ('$cupom','$codprod','$descricao','$quant','$preco1','$desconto','$unit','$total','$codapp2','$uni')";



if(mysqli_query($pdo, $sql)){
    echo "Records added successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($pdo);
}
 
// Close connection
mysqli_close($pdo);
?>