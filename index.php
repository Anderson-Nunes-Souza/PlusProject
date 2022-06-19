 <!DOCTYPE html>
 <html lang="pt_BR">

 <head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <script src="https://www.paypalobjects.com/webstatic/ppplusdcc/ppplusdcc.min.js" type="text/javascript"></script>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

     <title>Plus Project</title>
 </head>

 <body>

     <div class="container-flex">

         <header class="text-center col-12 bg-secondary p-3">
             PayPal Plus
         </header>

         <div class="col-12 bg-light p-5">
             <div id="ppplusDiv"></div>

             <div class="d-grid col-6 mx-auto p-3">
                 <button type="submit" id="continueButton" class="btn btn-lg btn-primary" onclick="ppp.doContinue(); return false;">
                     Checkout
                 </button>
             </div>

             <div class="row p-5"></div>
             <div class="row p-5"></div>
             <div class="row p-4"></div>
         </div>

         <div class="col-12 p-3 bg-secondary">
             <footer class="text-center">
                 PayPal do Brasil © 1999 - <script>
                     document.write(new Date().getFullYear());
                 </script>
             </footer>
         </div>

     </div>

     <script type="application/javascript">
         var url = <?php print_r(strval(require_once('./phps/CreatePayment.php'))); ?>;
         var rememberedCards = "customerRememberedCardHash";

         var ppp = PAYPAL.apps.PPP({
             "approvalUrl": url.links[1].href,
             "placeholder": "ppplusDiv",
             "mode": "sandbox",
             "payerFirstName": "John",
             "payerLastName": "Doe",
             "payerPhone": "5511954854582",
             "payerEmail": "johndoe@email.com",
             "payerTaxId": "19850755806",
             "payerTaxIdType": "BR_CPF",
             "language": "pt_BR",
             "country": "BR",
             "rememberedCards": rememberedCards,
             "enableContinue": "continueButton",
             "iframeHeight": "450",
             "onContinue": () => {
                 $.ajax({
                     url: "./phps/paymentExecution.php",
                     type: "POST",
                     data: {
                         field1: payerId,
                         field2: url.links[2].href
                     },
                     success: function(result) {
                         result = JSON.parse(result);
                         console.table(result);
                         alert("Pagamento Concluído");
                         window.location.href = "./SucessPayment.php?paymentId=" + result.transactions[0].related_resources[0].sale.id;
                     },
                     error: function() {
                         window.location.href = "./CancelPayment.html"
                     }
                 })
             },
         });

         window.addEventListener("message", messageListener, false);

         function messageListener(event) {
             var data = JSON.parse(event.data);
             if (data.action == "checkout") {
                 payerId = data.result.payer.payer_info.payer_id;
             } else {}
         };
     </script>

 </body>

 </html>