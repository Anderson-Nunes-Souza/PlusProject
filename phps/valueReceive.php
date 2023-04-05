<?php
session_start();

$installments = $_GET['installments'];
$vlrTotal = $_GET['vlrTotal'];

echo $installments;
echo$vlrTotal;


$_SESSION['vlrTotal'] = $vlrTotal;
$_SESSION['installments'] = $installments;


?>