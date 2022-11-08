<?php
//$pdo = mysqli_connect("127.0.0.1", "root", "", "marins");

require_once 'scripts/cnn-class.php'; 


$res=$pdo->query("SELECT clicod,clinom,cliend,clibai,clicid,numero,clicep,clitel,clitel2,celular,clicon,email,seq004 FROM tslc001 where trim(ativo) = 'Ativo' or trim(ativo) = ''  ");

$dados=array();

$comAcentos = array('�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', '�', 'O', '�', '�', '�');

$semAcentos = array('a', 'a', 'a', 'a', 'a', 'a', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'y', 'A', 'A', 'A', 'A', 'A', 'A', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'N', 'O', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U');






foreach ($res as $row){
    array_push($dados, array(
        'clicod'=>$row['clicod'],
        'clinom'=>str_replace($comAcentos, $semAcentos,$row['clinom']),
        'cliend'=>str_replace($comAcentos, $semAcentos,$row['cliend']),
        'clibai'=>str_replace($comAcentos, $semAcentos,$row['clibai']),
        'clicid'=>$row['clicid'],
        'numero'=>$row['numero'],
        'clicep'=>$row['clicep'],
        'clitel'=>$row['clitel'],
        'clitel2'=>$row['clitel2'],
        'celular'=>$row['celular'],
        'clicon'=>$row['clicon'],
        'email'=>$row['email'],
        'seq004'=>$row['seq004'],
    ));
}

echo utf8_encode(json_encode($dados));
?>
