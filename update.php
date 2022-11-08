<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */

//$pdo = mysqli_connect("127.0.0.1", "root", "", "marins");

require_once 'scripts/cnn-class.php'; 


 
// Check connection
if($pdo === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

$first_name = mysqli_real_escape_string($pdo, $_POST['nome']);
 
// Attempt update query execution
$sql = "UPDATE tslc001 SET clinom='$first_name' WHERE clicod=2232";
if(mysqli_query($pdo, $sql)){
    echo "Records were updated successfully.";
} else {
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($pdo);
}
 
// Close connection
mysqli_close($pdo);
?>