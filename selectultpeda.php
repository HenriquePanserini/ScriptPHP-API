
<?php
//$pdo = mysqli_connect("127.0.0.1", "root", "t1eteoli", "barracao");
//$pdo = mysqli_connect("127.0.0.1", "root", "", "marins");
 
require_once 'scripts/cnn-class.php'; 

//echo ' existe registro cadastrado:  ' . mysqli_real_escape_string($pdo,$_POST['parusuario']) . ' </br>';
//echo ' existe registro cadastrado'+$parametro;
//echo 'HGFDHGFD' . ($_GET['parusuario']) . 'dssdds';
//$res=$pdo->query("SELECT max(seq) as seqmax FROM tslv020  where codapp > 0  ");


$res=$pdo->query("SELECT max(seq) as seqmax,micro FROM tslv020  group by micro ");


//echo $_GET['var1']; //valor1
//echo $_GET['var2']; //valor2

$dados=array();

foreach ($res as $row){
    array_push($dados, array(
        'seqmax'=>$row['seqmax'],
        'micro'=>$row['micro']
    ));
}

echo utf8_encode(json_encode($dados));

?>
