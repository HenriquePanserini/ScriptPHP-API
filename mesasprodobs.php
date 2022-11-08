<?php
 
//$pdo = mysqli_connect("127.0.0.1", "root", "", "marins");

require_once 'scripts/cnn-class.php'; 


$res=$pdo->query("SELECT nrmesa,seqcom01 FROM tscom01  ");

$dados=array();

foreach ($res as $row){
    array_push($dados, array(
        'seqcom01'=>$row['seqcom01'],
        'nrmesa'=>$row['nrmesa'],
    ));
}

echo utf8_encode(json_encode($dados));
?>
