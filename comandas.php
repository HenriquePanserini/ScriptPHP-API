<?php

require_once 'scripts/cnn-class.php'; 

//$link = mysqli_connect("127.0.0.1", "root", "", "marins");


//$res=$link->query("SELECT seqcom01,inativo FROM tscom01");
$res=$pdo->query("SELECT numero,seqcom01,inativo FROM tscom01 where mesa_comanda = 1");

$dados=array();

foreach ($res as $row){
    array_push($dados, array(
        'seqcom01'=>$row['seqcom01'],
        'inativo'=>$row['inativo'],
	'numero'=>$row['numero'],
    ));
}

echo utf8_encode(json_encode($dados));
?>
