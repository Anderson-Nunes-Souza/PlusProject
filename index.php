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
             <!-- Campo do Valor do produto-->


             <div class="d-grid col-6 mx-auto p-3">

                 <div class="input-group mb-3">
                     <div class="input-group-prepend">
                         <span class="input-group-text">R$</span>
                     </div>
                     <input type="text" class="form-control" id="valorProduto" aria-label="Quantia" placeholder="Valor Total do Produto">
                 </div>


                 <!--Seleção de parcelas
                       - Precisa colocar o valor total em uma variável.
                       - Precisa deixar as parcelas dinâmicas;
                   -->
                 <label for="valor"> Selecione as Parcelas</label>


                 <select class="form-select" id="parcelas" onchange=enviar_valor()>
                     <option selected value="0">Selecione a opção</option>
                     <option value="1">1x</option>
                     <option value="2">2x</option>
                     <option value="3">3x</option>
                     <option value="4">4x</option>
                     <option value="5">5x</option>
                     <option value="6">6x</option>
                 </select>
             </div>

             <!--Fim Seleção de parcelas-->

             <!--Iframe do PP+ -->
             <div id="ppplusDiv"></div>
             <!--fim do Iframe-->

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

     <br><br>

     <script type="application/javascript" defer>
         function enviar_valor() {
             var installments = document.getElementById("parcelas");
             var vlrTotal = document.getElementById("valorProduto");
             installments = parcelas.value;
             vlrTotal = vlrTotal.value;
             var feed = fetch("./phps/valueReceive.php?installments=" + installments + "&vlrTotal=" + vlrTotal);

             //Precisa melhorar a lógica desses if-else posteriormente.
             if (vlrTotal == "") {
                 alert("Insira um valor para continuar");
             } else if (parcelas == 0) {
                 alert("Selecione uma opção de parcelamento");
             } else {
                 carrega_frame(installments);
             }
         };
         
         function carrega_frame(installments) {
             var installments
             //console.table(feed);
             var url = <?php print_r(strval(require('./phps/CreatePayment.php'))); ?>;
             var rememberedCards = "customerRememberedCardHash";
             //console.log(installments);
             //console.table(vlrTotal);
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
                 "merchantInstallmentSelection": installments,
                 "merchantInstallmentSelectionOptional": false,
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
                    "onError": () => {
                        alert("erro" + m_error + "tente novamente");
                        window.location.reload();
                    }
                });
            };
            
         window.addEventListener("message", messageListener, false);
         
         function messageListener(event) {
             var data = JSON.parse(event.data);
             if (data.action == "checkout") {
                 payerId = data.result.payer.payer_info.payer_id;
                } else {
                    //console.log(data.cause);
                    m_error = data.cause;
                }
            };
            </script>

</body>

</html>