<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */

require_once 'scripts/cnn-class.php';
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
// Escape user inputs for security

 
// Attempt insert query execution
$cupom = mysqli_real_escape_string($link,$_POST['cupom']);
$nrmesa1 = mysqli_real_escape_string($link,$_POST['nrmesa']);


 
$sql = " update tscom01 set nrmesa = '$nrmesa1', inativo = 1 where seqcom01 = '$cupom' ";



if(mysqli_query($link, $sql)){
    $variavel = 1;
    exit(json_encode($variavel));
} else{
    	$variavel= 0;
    exit(json_encode($variavel));
}
 



 
// Close connection
mysqli_close($link);
