<?php
 
require_once 'scripts/cnn-class.php'; 


//$pdo = mysqli_connect("127.0.0.1", "root", "", "marins");


$res=$pdo->query("SELECT seqcom01,seqcom02,seq003,quant,valor,descricao,impresso FROM tscom02 where baixa <> 's' ");

$dados=array();

foreach ($res as $row){
    array_push($dados, array(
        'seqcom01'=>$row['seqcom01'],
        'seqcom02'=>$row['seqcom02'],
        'seq003'=>$row['seq003'],
        'quant'=>$row['quant'],
        'valor'=>$row['valor'],
        'descricao'=>$row['descricao'],
        'impresso'=>$row['impresso'],
    ));
}

echo utf8_encode(json_encode($dados));
?>
