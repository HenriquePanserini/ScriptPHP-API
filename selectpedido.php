
<?php
//$pdo = mysqli_connect("127.0.0.1", "root", "t1eteoli", "barracao");
//$pdo = mysqli_connect("127.0.0.1", "root", "", "marins");
 
require_once 'scripts/cnn-class.php'; 

//echo ' existe registro cadastrado:  ' . mysqli_real_escape_string($pdo,$_POST['parusuario']) . ' </br>';
//echo ' existe registro cadastrado'+$parametro;
//echo 'HGFDHGFD' . ($_GET['parusuario']) . 'dssdds';
//$res=$pdo->query("SELECT max(seq) as totmax FROM tslv021  where codapp > 0  ");

$primeiro = $_GET['par'];


//echo 'wewee'  +$primeiro;



$res=$pdo->query("SELECT count(seq) as totmax FROM tslv021web where cupom = '$primeiro' and exclui = '' " );


//echo $_GET['var1']; //valor1
//echo $_GET['var2']; //valor2

$dados=array();

foreach ($res as $row){
    array_push($dados, array(
        'totmax'=>$row['totmax']
    ));
}

echo utf8_encode(json_encode($dados));

?>
