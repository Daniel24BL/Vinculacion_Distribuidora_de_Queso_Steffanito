<?php
define("CLIENT_ID", "Ac6NNdUPpApyyGNUXc-i59UWsNIUDUTT3KoJTm6im_NTPeiO13NDfM5u0AsEldNASzEeqVmfPgNxHj_P");
define("CURRENCY", "USD");

define("KEY_TOKEN", "APR.wqc-354*");
define("MONEDA", "$");

session_start();

$num_cart=0;
if(isset ($SESSION['carrito']['productos'])){
	$num_cart=count($SESSION['carrito']['productos']);
}

?>