<?php
//$pdo = mysqli_connect("127.0.0.1", "root", "", "marins");

require_once 'scripts/cnn-class.php'; 


$res=$pdo->query("SELECT nome,endereco,bairro,cidade,fone FROM tsl ");

$dados=array();

foreach ($res as $row){
    array_push($dados, array(
        'nome'=>$row['nome'],
        'endereco'=>$row['endereco'],
        'bairro'=>$row['bairro'],
        'cidade'=>$row['cidade'],
        'fone'=>$row['fone'],
    ));
}

echo utf8_encode(json_encode($dados));
?>
