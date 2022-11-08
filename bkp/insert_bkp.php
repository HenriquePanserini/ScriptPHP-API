<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */

require_once 'scripts/cnn-class.php'; 


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
$dataincapp = mysqli_real_escape_string($pdo,$_POST['dataincapp']);
$datasincapp = mysqli_real_escape_string($pdo,$_POST['datasincapp']);
$tipopgto = mysqli_real_escape_string($pdo,$_POST['tipopgto']);
$parusuario = mysqli_real_escape_string($pdo,$_POST['parusuario']);
$obsped = mysqli_real_escape_string($pdo,$_POST['obsped']);





$sql = "INSERT INTO tslv020(data,codcli,bruto,desconto,liquido,codven,codform,codapp,dataincapp,datasincapp,tipopgto,micro,obs) VALUES ('$data','$codcli','$bruto','$desconto','$liquido','$codven','$codform','$codapp','$dataincapp','$datasincapp','$tipopgto','$parusuario','$obsped')";


if(mysqli_query($pdo, $sql)){
    echo "Records added successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($pdo);
}
 
// Close connection
mysqli_close($pdo);
?>