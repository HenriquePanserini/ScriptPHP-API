<?php
//$pdo = mysqli_connect("127.0.0.1", "root", "", "marins");

require_once 'scripts/cnn-class.php'; 

 
$res=$pdo->query("SELECT codigo,nome,senha FROM tslc004");

$dados=array();


$comAcentos = array('�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', 'O', '�', '�', '�');

$semAcentos = array('a', 'a', 'a', 'a', 'a', 'a', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'y', 'A', 'A', 'A', 'A', 'A', 'A', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'N', 'O', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U');




foreach ($res as $row){
    array_push($dados, array(
        'codigo'=>$row['codigo'],
      	'nome'=>str_replace($comAcentos, $semAcentos,$row['nome']),
      	'senha'=>str_replace($comAcentos, $semAcentos,$row['senha']),
    ));
}

echo utf8_encode(json_encode($dados));
?>
