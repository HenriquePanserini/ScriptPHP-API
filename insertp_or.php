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
$sql = "INSERT INTO tslor02(cupom,codprod,descricao,quant,desconto,unit,total) VALUES ('$cupom','$codprod','$descricao','$quant','$desconto','$preco1','$total')";


if(mysqli_query($pdo, $sql)){
    echo "Records added successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($pdo);
}
 
// Close connection
mysqli_close($pdo);
?>



