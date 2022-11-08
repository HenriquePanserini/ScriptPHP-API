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
            
            // echo $CUPOM;

            // DATA SELECT
            try
            {
                $rs = $pdo->prepare("
                                        SELECT 
                                            P.SEQ AS PSEG
                                            ,P.CUPOM
                                            ,P.DATA
                                            ,P.BRUTO
                                            ,P.DESCONTO
                                            ,P.LIQUIDO
                                            ,C.CLICOD
                                            ,C.CLINOM
                                            ,C.CLIFAN
                                            ,P.CODVEN
                                            ,V.NOME AS VENDEDOR
                                            ,P.CODFORM
                                            ,F.DESCRICAO AS FORMDESC
                                        FROM 
                                            tslor01 AS P
                                            INNER JOIN 
                                                tslc001 AS C
                                                ON P.CODCLI = C.CLICOD
                                            INNER JOIN
                                                tslc004 AS V
                                                ON P.CODVEN = V.CODIGO
                                            INNER JOIN 
                                                tslc005 AS F
                                                ON P.CODFORM = F.CODIGO
                                        WHERE P.PEDIDO = 0
                                            AND P.EXCLUI = '' 
                                            AND P.SEQ = :CUPOM
                                    ");
                $rs->bindParam(":CUPOM", $CUPOM, PDO::PARAM_STR);
                $rs->execute();

                // Verifica se a query rodou sem erros e se tem resultados
                if($rs->execute() === true && ($rs->rowCount() > 0))
                {
                    $reg = $rs->fetch(PDO::FETCH_OBJ);


                    $json = '{ 
                                "SEQ": "'.$reg->PSEG.'"
                                ,"CUPOM": "'.$reg->CUPOM.'"
                                ,"DATA": "'.$reg->DATA.'"
                                ,"BRUTO": "'.$reg->BRUTO.'"
                                ,"DESCONTO": "'.$reg->DESCONTO.'"
                                ,"LIQUIDO": "'.$reg->LIQUIDO.'"
                                ,"CLICOD": "'.$reg->CLICOD.'"
                                ,"CLINOM": "'.$reg->CLINOM.'"
                                ,"CLIFAN": "'.$reg->CLIFAN.'"
                                ,"CODVEN": "'.$reg->CODVEN.'"
                                ,"VENDEDOR": "'.$reg->VENDEDOR.'"
                                ,"CODFORM": "'.$reg->CODFORM.'"
                                ,"FORMDESC": "'.$reg->FORMDESC.'"
                                ,"ITEM":  [
                            ';

                        $rsc = $pdo->prepare("
                                            SELECT 
                                                SEQ AS CSEG
                                                ,CUPOM
                                                ,CODPROD
                                                ,DESCRICAO
                                                ,UNIT
                                                ,QUANT
                                                ,TOTAL
                                            FROM 
                                                tslor02
                                            WHERE CUPOM = :CUPOM
                                            ");
                        $rsc->bindParam(":CUPOM", $CUPOM, PDO::PARAM_STR);
                        $rsc->execute();


                        if($rsc->execute() === true && ($rsc->rowCount() > 0))
                        {

                            $CountRegTot = $rsc->rowCount();
                            $CountReg = 1;

                            while($regc = $rsc->fetch(PDO::FETCH_OBJ)){

                                $json .= '{
                                            "SEQ": "'.$regc->CSEG.'"
                                            ,"CUPOM": "'.$regc->CUPOM.'"
                                            ,"CODPROD": "'.$regc->CODPROD.'"
                                            ,"DESCRICAO": "'.$regc->DESCRICAO.'"
                                            ,"UNIT": "'.$regc->UNIT.'"
                                            ,"QUANT": "'.$regc->QUANT.'"
                                            ,"TOTAL": "'.$regc->TOTAL.'"
                                        }';

                                if ($CountRegTot != $CountReg) {
                                    $json .= ", ";
                                }

                                $CountReg = $CountReg+1;

                            }  

                        } else {
                            $json .= '{
                                            "SEQ": ""
                                            ,"CUPOM": ""
                                            ,"CODPROD": ""
                                            ,"DESCRICAO": ""
                                            ,"UNIT": ""
                                            ,"QUANT": ""
                                            ,"TOTAL": ""
                                        }';                         
                            }

                        $json .= "   ]";  

                    $json .= "}";


                    echo $json;


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
            try
            {
                $rs = $pdo->prepare("
                                        INSERT INTO (
                                            
                                        ) VALUES (
                                            
                                        ) 
                                    ");
                $rs->execute();

                // Verifica se a query rodou sem erros e se tem resultados
                if($rs->execute() === true && ($rs->rowCount() > 0))
                {
?>
                    [{ "msg": "OK", "txt": "Cadastro realizazo com sucesso!" }]
<?php

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