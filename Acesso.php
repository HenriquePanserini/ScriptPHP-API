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

            // CREATE NEW RECORD
            $data = json_decode(file_get_contents('php://input'), true);

            $TrataLogin = '';

            if($data) { 

                $NOME   = strtoupper((!empty($data['NOME'])) ? $data['NOME'] : $TrataLogin = 'ERROR');
                $SENHA  = strtoupper((!empty($data['SENHA'])) ? $data['SENHA'] : $TrataLogin = 'ERROR');

                if($TrataLogin = 'ERROR') { 

                    // DATA SELECT
                    try
                    {
                        $rs = $pdo->prepare("
                                            SELECT 
                                                CODIGO
                                                ,NOME
                                            FROM
                                                tslc004
                                            WHERE
                                                NOME = :NOME
                                                AND SENHA = :SENHA
                                            ");
                        $rs->bindParam(":NOME", $NOME, PDO::PARAM_STR);
                        $rs->bindParam(":SENHA", $SENHA, PDO::PARAM_STR);
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
                            [{ "msg": "ERROR", "txt": "Dados incorretos" }]
<?php
                        }
                    } catch(PDOException $e) {
                        echo $e->getMessage();
                    }
                } else {
?>
                    [{ "msg": "ERROR", "txt": "Dados não localizados" }]
<?php    
                }                                
            } else {
?>
                    [{ "msg": "ERROR", "txt": "Dados não localizados" }]
<?php                
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

                        // CREATE NEW RECORD
            $data = json_decode(file_get_contents('php://input'), true);

            $TrataLogin = '';

            if($data) { 

                $NOME   = strtoupper((!empty($data['NOME'])) ? $data['NOME'] : $TrataLogin = 'ERROR');
                $SENHA  = strtoupper((!empty($data['SENHA'])) ? $data['SENHA'] : $TrataLogin = 'ERROR');

                if($TrataLogin = 'ERROR') { 

                    // DATA SELECT
                    try
                    {
                        $rs = $pdo->prepare("
                                            SELECT 
                                                'OK' AS MSG
                                                ,CODIGO
                                                ,NOME
                                            FROM
                                                tslc004
                                            WHERE
                                                NOME = :NOME
                                                AND SENHA = :SENHA
                                            ");
                        $rs->bindParam(":NOME", $NOME, PDO::PARAM_STR);
                        $rs->bindParam(":SENHA", $SENHA, PDO::PARAM_STR);
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
                            [{ "msg": "ERROR", "txt": "Dados incorretos" }]
<?php
                        }
                    } catch(PDOException $e) {
                        echo $e->getMessage();
                    }
                } else {
?>
                    [{ "msg": "ERROR", "txt": "Dados não localizados" }]
<?php    
                }                                
            } else {
?>
                    [{ "msg": "ERROR", "txt": "Dados não localizados" }]
<?php                
            }

            $rs = null;

        break;
        
        case 'DELETE':    
        
        // Delete collection or member
?>
            [{ "msg": "ERROR", "txt": "DELETE - Dados não localizados" }]
<?php        

        break;
    }

    
} else {

?>
    [{ "msg": "ERROR", "txt": "Voce não tem permissão pra isso" }]

<?php    
}
?>                  