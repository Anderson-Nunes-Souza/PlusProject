 <!DOCTYPE html>
 <html lang="pt_BR">

 <head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
     <script src="https://www.paypalobjects.com/webstatic/ppplusdcc/ppplusdcc.min.js" type="text/javascript"></script>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
     <title>Plus Project</title>
 </head>

 <div class="card card-body bg-secondary h-100">

     <body>
         <header>
         </header>

         <div id="ppplusDiv"></div>


         <div class="d-grid gap-2 col-6 mx-auto h-100">
             <button type="submit" id="continueButton" class="btn btn-lg btn-primary" onclick="ppp.doContinue(); return false;">
                 Checkout
             </button>
         </div>
         <div class="card-footer">
             <footer class="mt-auto text-white-50 text-center">
                 PayPal do Brasil
             </footer>
         </div>
         <script type="application/javascript">
             var url = <?php print_r(strval(require_once('./phps/CreatePayment.php'))); ?>;
             //console.table(url);
             var rememberedCards = "customerRememberedCardHash";
             var installments = null;

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
                 "rememberedCards": rememberedCards,
                 "enableContinue": "continueButton",
                 "merchantInstallmentSelectionOptional": installments,
                 "onContinue": () => {
                     $.ajax({
                         url: "./phps/paymentExecution.php",
                         type: "POST",
                         data: {
                             field1: payerId, // payerid vai aqui,
                             field2: url.links[2].href
                         },
                         success: function(result) {
                             //console.log(typeof(result)); //->String
                             console.log(result);
                             //console.table(result);
                             result = JSON.parse(result);
                             //console.log(typeof(result)); //->Object
                             console.table(result);
                             //console.log(result.id);
                             //console.table(result.id);
                             //console.table(result.transactions);
                             //console.table(result.transactions[0].related_resources[0].sale.id);
                             alert("Pagamento Concluído");
                             window.location.href = "./SucessPayment.php?paymentId=" + result.transactions[0].related_resources[0].sale.id;
                         },
                         error: function() {
                             //console.log(error);
                             alert("function Error");
                             window.location.href = "./CancelPayment.html"
                         }
                     })
                 },
             });

             window.addEventListener("message", messageListener, false);

             function messageListener(event) {
                 var data = JSON.parse(event.data);
                 //console.table(data);
                 if (data.action == "checkout") {
                     payerId = data.result.payer.payer_info.payer_id;
                     //console.log(data.result.payer.payer_info.payer_id);
                 } else {}
             };
         </script>
         <br>

 </div>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
 </body>

 </html>