<?php
//$pdo = mysqli_connect("127.0.0.1", "root", "t1eteoli", "barracao");
//pdo = mysqli_connect("127.0.0.1", "root", "", "marins");


require_once 'scripts/cnn-class.php'; 

 
$res=$pdo->query("SELECT codigo,descricao FROM tslc005");

$dados=array();



$comAcentos = array('�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', 'O', '�', '�', '�');

$semAcentos = array('a', 'a', 'a', 'a', 'a', 'a', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'y', 'A', 'A', 'A', 'A', 'A', 'A', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'N', 'O', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U');


foreach ($res as $row){
    array_push($dados, array(
        'codigo'=>$row['codigo'],
        'descricao'=>str_replace($comAcentos, $semAcentos,$row['descricao']),

    ));
}

echo utf8_encode(json_encode($dados));
?>
