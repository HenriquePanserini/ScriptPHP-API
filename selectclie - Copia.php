<?php

$link = mysqli_connect("localhost", "root", "t1eteoli", "barracao");

 
$res=$link->query("SELECT clicod,clinom,cliend,clibai,clicid,numero,clicep,clitel,clitel2,celular,clicon,email,seq004 FROM tslc001 ");

$dados=array();

foreach ($res as $row){
    array_push($dados, array(
        'clicod'=>$row['clicod'],
        'clinom'=>$row['clinom'],
        'cliend'=>$row['cliend'],
        'clibai'=>$row['clibai'],
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
