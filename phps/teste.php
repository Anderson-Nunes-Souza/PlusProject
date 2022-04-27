<?php
    //file_put_contents("testelog.txt", "esse é o conteúdo do arquivo teste log que eu criei"); -- Criar log da chamada
    //echo "teste de chamada ajax";
    //teste paypal execpayment:
    $payerID = $_POST['field1'];
    $urlExec = $_POST['field2'];
    echo "payerID " + $payerID + " " + $urlExec;
?>