<?php
define('MODULE_PAYMENT_BTC_TEXT_TITLE', 'Bitcoin (BTC)');
if ( defined('MODULE_PAYMENT_BTC_QRCODE') && (MODULE_PAYMENT_BTC_QRCODE != "") ) {
define('MODULE_PAYMENT_BTC_TEXT_DESCRIPTION',  'Payable à: ' . MODULE_PAYMENT_BTC_PAYTO . '<br><br>' . '<a href="bitcoin:'.MODULE_PAYMENT_BTC_PAYTO.'" target="_blank"><img src= "' . MODULE_PAYMENT_BTC_QRCODE . '" border="0" /></a>' . '<br><br>' . 'Votre commande ne sera pas expédiée avant réception du paiement.');
define('MODULE_PAYMENT_BTC_TEXT_EMAIL_FOOTER', 'Payable à: ' . MODULE_PAYMENT_BTC_PAYTO . "\n\n"     . '<img src= "' . MODULE_PAYMENT_BTC_QRCODE . '" border="0" />' .  "\n\n"    . 'Votre commande ne sera pas expédiée avant réception du paiement.');
}elseif ( ( defined('MODULE_PAYMENT_BTC_PAYTO') && (MODULE_PAYMENT_BTC_PAYTO != "") ) || ( defined('MODULE_PAYMENT_BTC_QRCODE') && (MODULE_PAYMENT_BTC_QRCODE == "") ) ) {
define('MODULE_PAYMENT_BTC_TEXT_DESCRIPTION',  'Payable à: ' . defined('MODULE_PAYMENT_BTC_PAYTO') ? MODULE_PAYMENT_BTC_PAYTO : '' . '<br><br>' . 'Votre commande ne sera pas expédiée avant réception du paiement.');
define('MODULE_PAYMENT_BTC_TEXT_EMAIL_FOOTER', 'Payable à: ' . defined('MODULE_PAYMENT_BTC_PAYTO') ? MODULE_PAYMENT_BTC_PAYTO : '' . "\n\n" . 'Votre commande ne sera pas expédiée avant réception du paiement.');
}
define('MODULE_PAYMENT_BTC_TEXT_DEADLINE_DATE', 'Terme de Paiement');
?>