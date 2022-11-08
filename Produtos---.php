    <?php
header('Content-Type: text/html; charset=utf-8');   // UTF-8
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");   // Date in the past

// Require Files
require_once 'scripts/cnn-class.php'; 

// Verify Access
//$KeyAPP     = (isset($_REQUEST['KeyAPP']))  ?  AntiInjection($_REQUEST['KeyAPP'])  : '' ;
// if ($KeyAPP == $KeyAPPComp) {

$apiArgArray = explode("/", substr(@$_SERVER['PATH_INFO'], 1));
$returnObject = (object) array();

if ($_SERVER['REQUEST_METHOD']) {

    switch ($_SERVER['REQUEST_METHOD']) {
        
        case 'GET':

            try
            {
                $rs = $pdo->prepare("
                                        SELECT 
                                            CODIGO
                                            ,CODBAR
                                            ,DESCPRO
                                            ,ROUND(PRECO1,2) AS PRECO1
                                            ,ROUND(PRECO2,2) AS PRECO2
                                            ,ROUND(PRECO3,2) AS PRECO3
                                            ,ROUND(PRECO4,2) AS PRECO4
                                        FROM 
                                            tslc003
                                        WHERE
                                            PRECO1 > 0
                                        ORDER BY DESCPRO ASC
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
                    [{"ERROR","Dados não localizados!"}]
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
        
            // CREATE NEW RECORD
            $data = json_decode(file_get_contents('php://input'), true);

            if($data) { 

                $CLINOM = strtoupper((!empty($data['CLINOM'])) ? $data['CLINOM'] : "NOME");
                $CLIEND = strtoupper((!empty($data['CLIEND'])) ? $data['CLIEND'] : "ENDERECO");
                $CLIBAI = strtoupper((!empty($data['CLIBAI'])) ? $data['CLIBAI'] : "BAIRRO");
                $CLICID = strtoupper((!empty($data['CLICID'])) ? $data['CLICID'] : "CIDADE") ;
                $CLIEST = strtoupper((!empty($data['CLIEST'])) ? $data['CLIEST'] : "XX") ;
                $CLICEP = strtoupper((!empty($data['CLICEP'])) ? $data['CLICEP'] : "CEP") ;
                $PESSOA = strtoupper((!empty($data['PESSOA'])) ? $data['PESSOA'] : "TIPO") ;
                $CLICGC = strtoupper((!empty($data['CLICGC'])) ? $data['CLICGC'] : "CNPJ") ;
                $CLIINS = strtoupper((!empty($data['CLIINS'])) ? $data['CLIINS'] : "INSCRICAO") ;
                $CLICPF = strtoupper((!empty($data['CLICPF'])) ? $data['CLICPF'] : "CPF") ;
                $CLIRG  = strtoupper((!empty($data['CLIRG']))  ? $data['CLIRG']  : "RG") ; 
                $CLITEL = strtoupper((!empty($data['CLITEL'])) ? $data['CLITEL'] : "TEL") ;
                $CLIFAX = strtoupper((!empty($data['CLIFAX'])) ? $data['CLIFAX'] : "FAX") ;
                $CLICON = strtoupper((!empty($data['CLICON'])) ? $data['CLICON'] : "CONTATO") ;

            try
            {
                $rs = $pdo->prepare("
                                        INSERT INTO tslc001 (
                                            CLINOM
                                            ,CLIEND
                                            ,CLIBAI
                                            ,CLICID
                                            ,CLIEST
                                            ,CLICEP
                                            ,PESSOA
                                            ,CLICGC
                                            ,CLIINS
                                            ,CLICPF
                                            ,CLIRG
                                            ,CLITEL
                                            ,CLIFAX
                                            ,CLICON
                                        ) VALUES (
                                            :CLINOM
                                            ,:CLIEND
                                            ,:CLIBAI
                                            ,:CLICID
                                            ,:CLIEST
                                            ,:CLICEP
                                            ,:PESSOA
                                            ,:CLICGC
                                            ,:CLIINS
                                            ,:CLICPF
                                            ,:CLIRG
                                            ,:CLITEL
                                            ,:CLIFAX
                                            ,:CLICON
                                        ) 
                                    ");
                $rs->bindParam(":CLINOM", $CLINOM, PDO::PARAM_STR);
                $rs->bindParam(":CLIEND", $CLIEND, PDO::PARAM_STR);
                $rs->bindParam(":CLIBAI", $CLIBAI, PDO::PARAM_STR);
                $rs->bindParam(":CLICID", $CLICID, PDO::PARAM_STR);
                $rs->bindParam(":CLIEST", $CLIEST, PDO::PARAM_STR);
                $rs->bindParam(":CLICEP", $CLICEP, PDO::PARAM_STR);
                $rs->bindParam(":PESSOA", $PESSOA, PDO::PARAM_STR);
                $rs->bindParam(":CLICGC", $CLICGC, PDO::PARAM_STR);
                $rs->bindParam(":CLIINS", $CLIINS, PDO::PARAM_STR);
                $rs->bindParam(":CLICPF", $CLICPF, PDO::PARAM_STR);
                $rs->bindParam(":CLIRG", $CLIRG, PDO::PARAM_STR);
                $rs->bindParam(":CLITEL", $CLITEL, PDO::PARAM_STR);
                $rs->bindParam(":CLIFAX", $CLIFAX, PDO::PARAM_STR);
                $rs->bindParam(":CLICON", $CLICON, PDO::PARAM_STR);

                //$executa = $rs->execute();

                // Verifica se a query rodou sem erros e se tem resultados
                if($executa != '')
                {
?>
                    [{ "msg": "OK", "txt": "Cadastrado efetuado com sucesso!" }]
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
            [{ "msg": "OK", "txt": "DELETE" }]
<?php        

        break;
    }

} else {

?>

    [{"ERROR","Você não tem permissão para este acesso!"}]

<?php    
}
?>                  