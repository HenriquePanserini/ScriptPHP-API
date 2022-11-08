<?php
header('Content-Type: text/html; charset=utf-8');   // UTF-8
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");   // Date in the past

// Require Files
require_once 'scripts/cnn-class.php';
 
        $rs = $pdo->prepare("    SELECT 
                                    CODIGO
                                    ,CODBAR
                                    ,DESCPRO
                                    ,PRECO1
                                FROM 
                                    tslc003
                                ORDER BY DESCPRO ASC
                            ");
        $rs->execute();

            $results=$rs->fetchAll(PDO::FETCH_ASSOC);
            header("Content-type: application/json; charset=utf-8");
    		$json=json_encode($results);
    		print_r($json);
?>                  