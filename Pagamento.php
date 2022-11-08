<?php
header("Content-type: application/json; charset=utf-8");
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");   // Date in the past

// Require Files
require_once 'scripts/cnn-class.php'; 

// Verify Access
// $KeyAPP     = (isset($_REQUEST['KeyAPP']))  ?  AntiInjection($_REQUEST['KeyAPP'])  : '' ;

$apiArgArray = explode("/", substr(@$_SERVER['PATH_INFO'], 1));
$returnObject = (object) array();

if ($_SERVER['REQUEST_METHOD']) {

    switch ($_SERVER['REQUEST_METHOD']) {
        
        case 'GET':

            // DATA SELECT
            try
            {
                $rs = $pdo->prepare("
                                        SELECT 
                                            CODIGO
                                            ,DESCRICAO
                                        FROM 
                                            tslc005
                                        ORDER BY DESCRICAO ASC
                                    ");
                $rs->execute();

                // Verifica se a query rodou sem erros e se tem resultados
                    if($rs->execute() === true && ($rs->rowCount() > 0))
                    {
                        $results=$rs->fetchAll(PDO::FETCH_ASSOC);

                        // OUT JSON
                        header("Content-type: application/json; charset=utf-8");
                        $json=json_encode($results);
                        print_r($json);


                    } else {
            ?>
                    [{ "msg": "ERROR", "txt": "Dados não localizados" }]
<?php
                    }
                } catch(PDOException $e) {
                    echo $e->getMessage();
                }


                $rs = null;

        break;

        case 'PUT':       

            // Replace entire collection or member
?>
            [{ "msg": "ERROR", "txt": "PUT - Dados não localizados" }]
<?php

        break;  

        case 'POST':      
?>
            [{ "msg": "ERROR", "txt": "POST - Dados não localizados" }]
<?php    

        break;
        
        case 'DELETE':    
        
        // Delete collection or member
?>
            [{ "msg": "OK", "txt": "DELETE" }]
<?php        

        break;
    }

    
} else {

?>
    [{ "msg": "ERROR", "txt": "Voce não tem permissão pra isso" }]

<?php    
}
?>                  