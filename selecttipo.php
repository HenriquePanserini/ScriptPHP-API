<?php
//$pdo = mysqli_connect("127.0.0.1", "root", "t1eteoli", "barracao");

//$pdo = mysqli_connect("127.0.0.1", "root", "", "marins"); 

require_once 'scripts/cnn-class.php'; 



$res=$pdo->query("SELECT seq017,descricao FROM tslc017");

$dados=array();

foreach ($res as $row){
    array_push($dados, array(
        'seq017'=>$row['seq017'],
        'descricao'=>$row['descricao'],
    ));
}

echo utf8_encode(json_encode($dados));
?>
