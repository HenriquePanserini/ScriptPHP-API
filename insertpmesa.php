<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */

require_once 'scripts/cnn-class.php'; 


 
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
$ip = mysqli_real_escape_string($pdo,$_POST['ip']);
$unit = mysqli_real_escape_string($pdo,$_POST['unit']);
$desconto = mysqli_real_escape_string($pdo,$_POST['desconto']);
$preco1 = mysqli_real_escape_string($pdo,$_POST['preco1']);
$total = mysqli_real_escape_string($pdo,$_POST['total']);
$obs1 = mysqli_real_escape_string($pdo,$_POST['obs']);
$impresso1 = mysqli_real_escape_string($pdo,$_POST['impresso']);
$nrmesa1 = mysqli_real_escape_string($pdo,$_POST['nrmesa']);



$sql = "INSERT INTO tscom02 (seqcom01,seq003,quant,valor,descricao,ip,obs,impresso) VALUES ('$cupom','$codprod','$quant','$unit','$descricao','$ip','$obs1','$impresso1')";

if(mysqli_query($pdo, $sql)){
    echo "Records added successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($pdo);
}


$sql = " update tscom01 set nrmesa = '$nrmesa1' where seqcom01 = '$cupom' ";


if(mysqli_query($pdo, $sql)){
    echo "Records added successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($pdo);
}
 
// Close connection
mysqli_close($pdo);
?>