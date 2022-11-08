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

            if (!empty($CODIGO)) {

                // DATA SELECT
                try
                {
                    $rs = $pdo->prepare("
                                            SELECT 
                                                CLICOD
                                                ,CLINOM
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
                                                ,CLIFAN
                                            FROM 
                                                tslc001
                                            WHERE 
                                                SEQ004 = :CODIGO
                                            ORDER BY CLINOM ASC
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

            } else {
?>
                    [{ "msg": "ERROR", "txt": "Dados não localizados" }]
<?php
            }

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

            $erro = 0;

            if($data) { 

                $CLINOM = strtoupper((!empty($data['CLINOM'])) ? $data['CLINOM'] : "");
                $CLIEND = strtoupper((!empty($data['CLIEND'])) ? $data['CLIEND'] : "");
                $CLIBAI = strtoupper((!empty($data['CLIBAI'])) ? $data['CLIBAI'] : "");
                $CLICID = strtoupper((!empty($data['CLICID'])) ? $data['CLICID'] : "");
                $CLIEST = strtoupper((!empty($data['CLIEST'])) ? $data['CLIEST'] : "");
                $CLICEP = strtoupper((!empty($data['CLICEP'])) ? $data['CLICEP'] : "");
                $PESSOA = strtoupper((!empty($data['PESSOA'])) ? str_replace("Í", "I", $data['PESSOA']) : "");
                $CLICGC = strtoupper((!empty($data['CLICGC'])) ? $data['CLICGC'] : "");
                $CLIINS = strtoupper((!empty($data['CLIINS'])) ? $data['CLIINS'] : "");
                $CLICPF = strtoupper((!empty($data['CLICPF'])) ? $data['CLICPF'] : "");
                $CLIRG  = strtoupper((!empty($data['CLIRG']))  ? $data['CLIRG']  : ""); 
                $CLITEL = strtoupper((!empty($data['CLITEL'])) ? $data['CLITEL'] : "");
                $CLIFAX = strtoupper((!empty($data['CLIFAX'])) ? $data['CLIFAX'] : "");
                $CLICON = strtoupper((!empty($data['CLICON'])) ? $data['CLICON'] : "");
                $CLIFAN = strtoupper((!empty($data['CLIFAN'])) ? $data['CLIFAN'] : "");
                $CLIVEND = strtoupper((!empty($data['CODVEN'])) ? $data['CODVEN'] : "");

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
                                            ,CLIFAN
                                            ,SEQ004
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
                                            ,:CLIFAN
                                            ,:CLIVEND
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
                $rs->bindParam(":CLIRG",  $CLIRG, PDO::PARAM_STR);
                $rs->bindParam(":CLITEL", $CLITEL, PDO::PARAM_STR);
                $rs->bindParam(":CLIFAX", $CLIFAX, PDO::PARAM_STR);
                $rs->bindParam(":CLICON", $CLICON, PDO::PARAM_STR);
                $rs->bindParam(":CLIFAN", $CLIFAN, PDO::PARAM_STR);
                $rs->bindParam(":CLIVEND",$CLIVEND, PDO::PARAM_STR);

                $executa = $rs->execute();

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
    [{ "msg": "ERROR", "txt": "Voce não tem permissão pra isso" }]

<?php    
}
?>                  