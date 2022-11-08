
<?php
//$pdo = mysqli_connect("127.0.0.1", "root", "t1eteoli", "barracao");
//$pdo = mysqli_connect("127.0.0.1", "root", "", "marins");
 
require_once 'scripts/cnn-class.php'; 

//echo ' existe registro cadastrado:  ' . mysqli_real_escape_string($pdo,$_POST['parusuario']) . ' </br>';
//echo ' existe registro cadastrado'+$parametro;
//echo 'HGFDHGFD' . ($_GET['parusuario']) . 'dssdds';
//$res=$pdo->query("SELECT max(seq) as totmax FROM tslv021  where codapp > 0  ");

$primeiro = $_GET['par'];



$data1 = date("Y/m/d");
//dataexclu = '$data1',

$res=$pdo->query("UPDATE tslv020web SET exclui = 's', dataexclu = '$data1', exclui2 = 's', nf = 9 where seq = '$primeiro' " );


$res=$pdo->query("UPDATE tslv021web SET exclui = 's' where cupom = '$primeiro' " );





//if(mysqli_query($pdo, $res)){
    //echo "Records deleted successfully";
//} else{
 //   echo "ERROR: Could not able to execute $res. " . mysqli_error($pdo);
//}
 




//$dados=array();

//foreach ($res as $row){
 //   array_push($dados, array(
  //      'totmax'=>$row['totmax']
  //  ));
//}

//echo utf8_encode(json_encode($dados));

?>
