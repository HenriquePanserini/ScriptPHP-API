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
$codprod = mysqli_real_escape_string($link,$_POST['codprod']);
$descricao = mysqli_real_escape_string($link,$_POST['descricao']);
$quant = mysqli_real_escape_string($link,$_POST['quant']);
$ip = mysqli_real_escape_string($link,$_POST['ip']);
$unit = mysqli_real_escape_string($link,$_POST['unit']);
$desconto = mysqli_real_escape_string($link,$_POST['desconto']);
$preco1 = mysqli_real_escape_string($link,$_POST['preco1']);
$total = mysqli_real_escape_string($link,$_POST['total']);
$obs1 = mysqli_real_escape_string($link,$_POST['obs']);
$impresso1 = mysqli_real_escape_string($link,$_POST['impresso']);
$nrmesa1 = mysqli_real_escape_string($link,$_POST['nrmesa']);
$seqcom02 = mysqli_real_escape_string($link,$_POST['seqcom02']);
$exclui = mysqli_real_escape_string($link,$_POST['exclui']);


if (($seqcom02 === '0') && ($exclui === '0')) 
{
$sql = "1INSERT INTO tscom02 (seqcom01,seq003,quant,valor,descricao,ip,obs,impresso) VALUES ('$cupom','$codprod','$quant','$unit','$descricao','$ip','$obs1','$impresso1')";
}

if (($exclui === '1') and ($seqcom02 !== '0')) 
{
	$sql = "1delete from tscom02 where  seqcom02 = '$seqcom02' ";
}





if(mysqli_query($link, $sql))
{
    
    $variavel = 1;
    exit(json_encode($variavel));
} 
else
{
    
	$variavel= 0;
      exit(json_encode($variavel));
}
 
// Close connection
mysqli_close($link);
