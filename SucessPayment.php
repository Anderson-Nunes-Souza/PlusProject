<!DOCTYPE html>
<html lang="en" style="max-height: 800px;">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Sucess Payment</title>
</head>
<body>
    <div class="container-flex">
            <header class="text-center col-12 bg-secondary p-3">
                PayPal Plus
            </header>

        <div class="col-12 bg-light text-center p-5">
            <h1>Id da transação: <?php $paymenId = $_GET["paymentId"];
                                    echo $paymenId; ?></h1>
            <h2>Pagamento realizado com sucesso!</h2>
            <div class="p-3">
                <h2><a href="./index.php">Retornar ao site da loja</h2></a>
            </div>

             <div class="row p-5"></div>
             <div class="row p-5"></div>
             <div class="row p-5"></div>
             <div class="row p-5"></div>
             <div class="row p-5"></div>
             <div class="row p-4"></div>
        </div>
        

        <div class="col-12 p-3 bg-secondary">
            
            <footer class="text-center">
                PayPal do Brasil
            </footer>
        </div>
    </div>
</body>

</html>