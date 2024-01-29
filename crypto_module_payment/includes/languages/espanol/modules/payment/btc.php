<?php
define('MODULE_PAYMENT_BTC_TEXT_TITLE', 'Bitcoin (BTC)');
if ( defined('MODULE_PAYMENT_BTC_QRCODE') && (MODULE_PAYMENT_BTC_QRCODE != "") ) {
define('MODULE_PAYMENT_BTC_TEXT_DESCRIPTION',  'Pagar para: ' . MODULE_PAYMENT_BTC_PAYTO . '<br><br>' . '<a href="bitcoin:'.MODULE_PAYMENT_BTC_PAYTO.'" target="_blank"><img src= "' . MODULE_PAYMENT_BTC_QRCODE . '" border="0" /></a>' . '<br><br>' . 'Su pedido sólo será enviado después de recibir el pago.');
define('MODULE_PAYMENT_BTC_TEXT_EMAIL_FOOTER', 'Pagar para: ' . MODULE_PAYMENT_BTC_PAYTO . "\n\n"     . '<img src= "' . MODULE_PAYMENT_BTC_QRCODE . '" border="0" />' .  "\n\n"    . 'Su pedido sólo será enviado después de recibir el pago.');
}elseif ( ( defined('MODULE_PAYMENT_BTC_PAYTO') && (MODULE_PAYMENT_BTC_PAYTO != "") ) || ( defined('MODULE_PAYMENT_BTC_QRCODE') && (MODULE_PAYMENT_BTC_QRCODE == "") ) ) {
define('MODULE_PAYMENT_BTC_TEXT_DESCRIPTION',  'Pagar para: ' . defined('MODULE_PAYMENT_BTC_PAYTO') ? MODULE_PAYMENT_BTC_PAYTO : '' . '<br><br>' . 'Su pedido sólo será enviado después de recibir el pago.');
define('MODULE_PAYMENT_BTC_TEXT_EMAIL_FOOTER', 'Pagar para: ' . defined('MODULE_PAYMENT_BTC_PAYTO') ? MODULE_PAYMENT_BTC_PAYTO : '' . "\n\n" . 'Su pedido sólo será enviado después de recibir el pago.');
}
define('MODULE_PAYMENT_BTC_TEXT_DEADLINE_DATE', 'Plazo de Pago');
?>