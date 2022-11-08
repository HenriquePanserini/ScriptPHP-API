<?php
//$pdo = mysqli_connect("127.0.0.1", "root", "t1eteoli", "barracao");
//$pdo = mysqli_connect("127.0.0.1", "root", "", "marins");
 

require_once 'scripts/cnn-class.php'; 


$res=$pdo->query("SELECT codigo,descpro,preco1,codbar,preco2,preco3,preco4,uni FROM tslc003");

$dados=array();


$comAcentos = array('à', 'á', 'â', 'ã', 'ä', 'å', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ù', 'ü', 'ú', 'ÿ', 'À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'O', 'Ù', 'Ü', 'Ú','´');

$semAcentos = array('a', 'a', 'a', 'a', 'a', 'a', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'y', 'A', 'A', 'A', 'A', 'A', 'A', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'N', 'O', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U','');




foreach ($res as $row){
    array_push($dados, array(
        'codigo'=>$row['codigo'],
        'descpro'=>str_replace($comAcentos, $semAcentos, $row['descpro']),
        'preco1'=>$row['preco1'],
        'codbar'=>$row['codbar'],
	'preco2'=>$row['preco2'],
	'preco3'=>$row['preco3'],
	'preco4'=>$row['preco4'],
        'uni'=>str_replace($comAcentos, $semAcentos, $row['uni']),
        
    ));
}

echo utf8_encode(json_encode($dados));
?>