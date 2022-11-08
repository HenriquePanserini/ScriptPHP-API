<?php
//$pdo = mysqli_connect("127.0.0.1", "root", "", "marins");

require_once 'scripts/cnn-class.php'; 

//where clinom = 'BAR DO DE PAULA'

$res=$pdo->query("SELECT reccod ,recemiss,recvenci,recvalor,clinom from tsm003 inner join tslc001 on tsm003.reccli = tslc001.clicod  ") ;

//where clinom = 'LANCHONETE E PASTELARIA TAMBELLI LTDA ME' 

$dados=array();

foreach ($res as $row){
         array_push($dados, array(
        'titulo'=>$row['reccod'],
        'emissao'=>$row['recemiss'],
        'vencimento'=>$row['recvenci'],
        'valor'=>$row['recvalor'],
        'nome'=>$row['clinom'],
         ));
}

echo utf8_encode(json_encode($dados));
?>


