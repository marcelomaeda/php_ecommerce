<?php
define('MODULE_PAYMENT_ETH_TEXT_TITLE', 'Ethereum (ETH)');
if ( defined('MODULE_PAYMENT_ETH_QRCODE') && (MODULE_PAYMENT_ETH_QRCODE != "") ) {
define('MODULE_PAYMENT_ETH_TEXT_DESCRIPTION',  'Payable à: ' . MODULE_PAYMENT_ETH_PAYTO . '<br><br>' . '<a href="ethereum:'.MODULE_PAYMENT_ETH_PAYTO.'" target="_blank"><img src= "' . MODULE_PAYMENT_ETH_QRCODE . '" border="0" /></a>' . '<br><br>' . 'Votre commande ne sera pas expédiée avant réception du paiement.');
define('MODULE_PAYMENT_ETH_TEXT_EMAIL_FOOTER', 'Payable à: ' . MODULE_PAYMENT_ETH_PAYTO . "\n\n"     . '<img src= "' . MODULE_PAYMENT_ETH_QRCODE . '" border="0" />' .  "\n\n"    . 'Votre commande ne sera pas expédiée avant réception du paiement.');
}elseif ( ( defined('MODULE_PAYMENT_ETH_PAYTO') && (MODULE_PAYMENT_ETH_PAYTO != "") ) || ( defined('MODULE_PAYMENT_ETH_QRCODE') && (MODULE_PAYMENT_ETH_QRCODE == "") ) ) {
define('MODULE_PAYMENT_ETH_TEXT_DESCRIPTION',  'Payable à: ' . defined('MODULE_PAYMENT_ETH_PAYTO') ? MODULE_PAYMENT_ETH_PAYTO : '' . '<br><br>' . 'Votre commande ne sera pas expédiée avant réception du paiement.');
define('MODULE_PAYMENT_ETH_TEXT_EMAIL_FOOTER', 'Payable à: ' . defined('MODULE_PAYMENT_ETH_PAYTO') ? MODULE_PAYMENT_ETH_PAYTO : '' . "\n\n" . 'Votre commande ne sera pas expédiée avant réception du paiement.');
}
define('MODULE_PAYMENT_ETH_TEXT_DEADLINE_DATE', 'Terme de Paiement');
?>