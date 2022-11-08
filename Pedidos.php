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

            $CODIGO   = (!empty($_REQUEST['CODIGO'])) ? $_REQUEST['CODIGO'] : '';
            
            // DATA SELECT
            try
            {
                $rs = $pdo->prepare("
                                        SELECT 
                                            SEQ
                                            ,P.DATA
                                            ,P.PEDIDO
                                            ,CONCAT('R$ ', REPLACE (REPLACE (REPLACE (FORMAT(P.BRUTO, 2), '.', '|'), ',', '.'), '|', ',')) AS BRUTO
                                            ,CONCAT('R$ ', REPLACE (REPLACE (REPLACE (FORMAT(P.DESCONTO, 2), '.', '|'), ',', '.'), '|', ',')) AS DESCONTO
                                            ,CONCAT('R$ ', REPLACE (REPLACE (REPLACE (FORMAT(P.LIQUIDO, 2), '.', '|'), ',', '.'), '|', ',')) AS LIQUIDO
                                            ,C.CLINOM
                                            ,PG.DESCRICAO AS PAGAMENTO
                                        FROM 
                                            tslor01 AS P
                                        INNER JOIN 
                                            tslc001 AS C
                                            ON P.CODCLI = C.CLICOD
                                        INNER JOIN
                                            tslc005 AS PG
                                            ON P.CODFORM = PG.CODIGO
                                        WHERE P.PEDIDO = 0
                                            AND P.EXCLUI = '' 
                                            AND P.CODVEN = :CODIGO
                                        ORDER BY P.PEDIDO ASC
                                    ");
                $rs->bindParam(":CODIGO", $CODIGO, PDO::PARAM_STR);
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
            [{ "msg": "ERROR", "txt": "Dados não localizados" }]
<?php

        break;  

        case 'POST':      
        
            // CREATE NEW RECORD
            $data = json_decode(file_get_contents('php://input'), true);

            if($data) { 

                $DATA       = date("Y-m-d");
                $CLICOD     = (!empty($data['CLICOD'])) ? $data['CLICOD'] : "1";
                $LIQUIDO    = (!empty($data['LIQUIDO'])) ? str_replace("R$ ", "", $data['LIQUIDO']) : "0.000" ;
                $CODVEN     = (!empty($data['CODVEN'])) ? $data['CODVEN'] : "1" ;
                $COMPRADO   = strtoupper((!empty($data['COMPRADO'])) ? $data['COMPRADO'] : "COMPRADO") ;
                $CODFORM    = (!empty($data['CODFORM'])) ? $data['CODFORM'] : "1" ;
                $QTDEITENS  = (!empty($data['QTDEITENS'])) ? $data['QTDEITENS'] : "1";
                $DESCONTO   = (!empty($data['DESCONTO'])) ? str_replace("R$ ", "", $data['DESCONTO']) : "0.000" ;
                $BRUTO      = (!empty($data['BRUTO'])) ? str_replace("R$ ", "", $data['BRUTO']) : "0.000" ;
                

            try
            {
                $rs = $pdo->prepare("
                                        INSERT INTO tslor01 (
                                            DATA
                                            ,CODCLI
                                            ,BRUTO
                                            ,DESCONTO
                                            ,LIQUIDO
                                            ,CODVEN
                                            ,COMPRADO
                                            ,CODFORM
                                        ) VALUES (
                                            :DATA
                                            ,:CLICOD
                                            ,:BRUTO
                                            ,:DESCONTO
                                            ,:LIQUIDO
                                            ,:CODVEN
                                            ,:COMPRADO
                                            ,:CODFORM
                                        ) 
                                    ");
                $rs->bindParam(":DATA", $DATA, PDO::PARAM_STR);
                $rs->bindParam(":CLICOD", $CLICOD, PDO::PARAM_STR);
                $rs->bindParam(":BRUTO", $BRUTO, PDO::PARAM_STR);
                $rs->bindParam(":DESCONTO", $DESCONTO, PDO::PARAM_STR);
                $rs->bindParam(":LIQUIDO", $LIQUIDO, PDO::PARAM_STR);
                $rs->bindParam(":CODVEN", $CODVEN, PDO::PARAM_STR);
                $rs->bindParam(":COMPRADO", $COMPRADO, PDO::PARAM_STR);
                $rs->bindParam(":CODFORM", $CODFORM, PDO::PARAM_STR);

                $executa = $rs->execute();

                # pega o ultimo ID inserido
                $ID = $pdo->lastInsertId();

                // Verifica se a query rodou sem erros e se tem resultados
                if($executa != '')
                {
                    $QTDEITENS = $QTDEITENS-1;

                    for ($i=0; $i <= $QTDEITENS; $i++) { 

                        $CODPROD    = (!empty($data['ITEM'][$i]['CODPROD']))    ? $data['ITEM'][$i]['CODPROD'] : "0" ;
                        $DESCRICAO  = (!empty($data['ITEM'][$i]['DESCRICAO']))  ? $data['ITEM'][$i]['DESCRICAO'] : "1" ;
                        $UNIT       = (!empty($data['ITEM'][$i]['UNIT']))       ? str_replace(",", ".", $data['ITEM'][$i]['UNIT']) : "0" ;
                        $QUANT      = (!empty($data['ITEM'][$i]['QUANT']))      ? $data['ITEM'][$i]['QUANT'] : "0";
                        $TOTAL1     = (!empty($data['ITEM'][$i]['TOTAL']))      ? str_replace(".", "", $data['ITEM'][$i]['TOTAL']) : "0" ;

                        $TOTAL      = str_replace(",", ".", $TOTAL1);

                        $rsc = $pdo->prepare("
                                        INSERT INTO tslor02 (
                                            CUPOM
                                            ,CODPROD
                                            ,DESCRICAO
                                            ,UNIT
                                            ,QUANT
                                            ,TOTAL
                                        ) VALUES (
                                            :CUPOM
                                            ,:CODPROD
                                            ,:DESCRICAO
                                            ,:UNIT
                                            ,:QUANT
                                            ,:TOTAL
                                        ) 
                                    ");
                        $rsc->bindParam(":CUPOM", $ID, PDO::PARAM_STR);
                        $rsc->bindParam(":CODPROD", $CODPROD, PDO::PARAM_STR);
                        $rsc->bindParam(":DESCRICAO", $DESCRICAO, PDO::PARAM_STR);
                        $rsc->bindParam(":UNIT", $UNIT, PDO::PARAM_STR);
                        $rsc->bindParam(":QUANT", $QUANT, PDO::PARAM_STR);
                        $rsc->bindParam(":TOTAL", $TOTAL, PDO::PARAM_STR);

                        $exec = $rsc->execute();

                        $TOTAL = 0;
                            
                    }  
?>
                    [{ "msg": "OK", "txt": "Pedido <?php echo $ID; ?> cadastrado com sucesso!" }]
<?php

                } else {

?>
                    [{ "msg": "ERROR", "txt": "Cadastro não efetuado, tente novamente mais tarde!" }]
                    
<?php
                }
            } catch(PDOException $e) {
                echo $e->getMessage();
            }
            $rs = null;

        } else {
?>
                    [{ "msg": "ERROR", "txt": "Cadastro não efetuado, tente novamente mais tarde!" }]
<?php
        }

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