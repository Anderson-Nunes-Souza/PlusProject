 <!DOCTYPE html>
 <html lang="pt_BR">

 <head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
     <script src="https://www.paypalobjects.com/webstatic/ppplusdcc/ppplusdcc.min.js" type="text/javascript">  
     </script>
     <title>Plus Project</title>
 </head>

 <body>
     <header>
         <nav class="navbar navbar-light">
             <div class="container-fluid justify-content-lg-center bg-secondary">
                 <span class="navbar-brand mb-0 h1 align-middle">PayPal Integrations</span>
             </div>
         </nav>
     </header>
     <div id="ppplusDiv">
     </div>
     <script type="application/javascript">

        const url = <?php strval(require('./phps/CreatePayment.php'));?>;
        //console.table(url);

        var ppp = PAYPAL.apps.PPP({
             "approvalUrl": url.links[1].href,
             "placeholder": "ppplusDiv",
             "mode": "sandbox",
             "payerFirstName": "Anderson",
             "payerLastName": "Souza",
             "payerPhone": " 5511979730795",
             "payerEmail": "teste@outlook.com",
             "payerTaxId": "38384480818",
             "payerTaxIdType": "BR_CPF",
             "language": "pt_BR",
             "country": "BR",
             "rememberedCards": "customerRememberedCardHash",
             "enableContinue": "continueButton",
         });
     </script>

     <br>
     <button type="submit" id="continueButton" class="btn btn-lg btn-primary btn-block " onclick="ppp.doContinue(); return false">
         Checkout
     </button> 

 </body>
 </html>