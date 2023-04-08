<?php
session_start();

$installments = $_GET['installments'];
$vlrTotal = $_GET['vlrTotal'];


$_SESSION['vlrTotal'] = $vlrTotal;
$_SESSION['installments'] = $installments;

//echo $installments;
//echo $vlrTotal;

?>