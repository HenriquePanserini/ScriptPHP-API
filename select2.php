<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */

//$pdo = mysqli_connect("127.0.0.1", "root", "t1eteoli", "barracao");

require_once 'scripts/cnn-class.php'; 


//$pdo = mysqli_connect("127.0.0.1", "root", "", "marins");
 
// Check connection
if($pdo === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
// Escape user inputs for security
$sql = "SELECT * FROM tslc001 where clicod = 1

 
// Attempt insert query execution
$nome = mysqli_real_escape_string($pdo,$_GET['nome']);

if(mysqli_query($pdo, $sql)){
    echo "Records added successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($pdo);
}
 
// Close connection
mysqli_close($pdo);
?>
