<?php
 
//$pdo = mysqli_connect("127.0.0.1", "root", "", "desiderio");
//$pdo = mysqli_connect("127.0.0.1", "root", "", "marins");

require_once 'scripts/cnn-class.php'; 


$res=$pdo->query("SELECT codigo,nome FROM tslc004");

$dados=array();

foreach ($res as $row){
    array_push($dados, array(
        'codigo'=>$row['codigo'],
        'nome'=>$row['nome'],
    ));
}

echo utf8_encode(json_encode($dados));
?>
