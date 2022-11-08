<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */

require_once 'scripts/cnn-class.php'; 


//$pdo = mysqli_connect("127.0.0.1", "root", "t1eteoli", "barracao");
// $pdo = mysqli_connect("127.0.0.1", "root", "", "marins");
// Check connection
if($pdo === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
// Escape user inputs for security

 
// Attempt insert query execution
$nmesa1 = mysqli_real_escape_string($pdo,$_POST['nmesa']);


//$sql = " update tscom01 set inativo = 1 where seqcom01 = '$nmesa1' ";

//$sql = " delete from tscom02 where seqcom01 = '$nmesa1'  and ip = 'CELULAR000000000000' ";


$sql = " delete from tscom02 where seqcom01 = '$nmesa1'  ";

if(mysqli_query($pdo, $sql)){
    echo "Records added successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($pdo);
}
 
// Close connection
mysqli_close($pdo);
?>