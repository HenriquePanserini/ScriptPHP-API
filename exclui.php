
<?php
//$pdo = mysqli_connect("127.0.0.1", "root", "t1eteoli", "barracao");
//$pdo = mysqli_connect("127.0.0.1", "root", "", "marins");
 
require_once 'scripts/cnn-class.php'; 

//echo ' existe registro cadastrado:  ' . mysqli_real_escape_string($pdo,$_POST['parusuario']) . ' </br>';
//echo ' existe registro cadastrado'+$parametro;
//echo 'HGFDHGFD' . ($_GET['parusuario']) . 'dssdds';
//$res=$pdo->query("SELECT max(seq) as seqmax FROM tslv020  where codapp > 0  ");

$primeiro = $_GET['par'];


//echo 'wewee'  +$primeiro;


$res=$pdo->query("update tslv021 set exclui = 'S' where cupom = '$primeiro' and exclui = ' ' " );

$res=$pdo->query("update tslv020 set exclui = 'S' where seq = '$primeiro' and exclui = ' ' " );







//echo utf8_encode(json_encode($dados));

?>
