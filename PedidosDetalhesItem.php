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

            $CUPOM   = (!empty($_REQUEST['CUPOM'])) ? $_REQUEST['CUPOM'] : '1';

            // DATA SELECT
            try
            {

                $rs = $pdo->prepare("
                                    SELECT 
                                        SEQ AS CSEG
                                        ,CUPOM
                                        ,CODPROD
                                        ,DESCRICAO
                                        ,UNIT
                                        ,QUANT
                                        ,TOTAL
                                        ,CONCAT('R$ ', REPLACE (REPLACE (REPLACE (FORMAT(UNIT, 2), '.', '|'), ',', '.'), '|', ','), ' * ', ROUND(QUANT,0), ' = R$ ', REPLACE (REPLACE (REPLACE (FORMAT(TOTAL, 2), '.', '|'), ',', '.'), '|', ',')) AS DETALHE
                                    FROM 
                                        tslor02
                                    WHERE CUPOM = :CUPOM
                                    ");
                $rs->bindParam(":CUPOM", $CUPOM, PDO::PARAM_STR);
                $rs->execute();


                if($rs->execute() === true && ($rs->rowCount() > 0))
                {
                    $results=$rs->fetchAll(PDO::FETCH_ASSOC);

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
            [{ "msg": "ERROR", "txt": "Dados não localizados" }]
<?php

        break;  

        case 'POST':      
        
?>
                    [{ "msg": "OK", "txt": "Cadastro realizazo com sucesso!" }]
<?php

        break;
        
        case 'DELETE':    
        
        // Delete collection or member
?>
            [{"OK","OK"}]
<?php        

        break;
    }

    
} else {

?>
    [{ "msg": "ERROR", "txt": "Você não tem permissão para este acesso!" }]

<?php    
}
?>                  