<?php
session_start();

$installments = $_GET['installments'];
$vlrTotal = $_GET['vlrTotal'];

//echo $installments;
//echo $vlrTotal;

$atoken = require('.\aTokenCreate.php'); //Receives object
//echo $atoken;


$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://api-m.sandbox.paypal.com/v1/payments/payment',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => '{
      "intent": "sale",
      "payer": {
        "payment_method": "paypal"
      },
      "transactions": [
        {
          "amount": {
            "currency": "BRL",
            "total": "82",
            "details": {
              "shipping": "1",
              "subtotal": "75",
              "shipping_discount": "0",
              "insurance": "0",
              "handling_fee": "0",
              "tax": "6"
            }
          },
          "description": "This is the payment transaction description",
          "payment_options": {
            "allowed_payment_method": "IMMEDIATE_PAY"
          },
          "item_list": {
            "shipping_address": {
              "recipient_name": "PP Plus Recipient",
              "line1": "Gregório Rolim de Oliveira, 42",
              "line2": "JD Serrano II",
              "city": "Votorantim",
              "country_code": "BR",
              "postal_code": "18117-134",
              "state": "São Paulo",
              "phone": "0800-761-0880"
            },
            "items": [
              {
                "name": "handbag",
                "description": "red diamond",
                "quantity": "1",
                "price": "75",
                "tax": "6",
                "sku": "product34",
                "currency": "BRL"
              }
            ]
          }
        }
      ],
      "redirect_urls": {
        "return_url": "http://localhost/Plus%20Project/PlusProject/SucessPayment.html",
        "cancel_url": "http://localhost/Plus%20Project/PlusProject/CancelPayment.html"
      }
    }',
    CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
        'Authorization: Bearer ' . $atoken
    ),
));

$response = curl_exec($curl);

//echo strval($response);
//$response = strval($response);
//$response = json_decode($response);
//echo $response->links[1]->href;


print $response;
// ?>