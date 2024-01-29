<?php
define('MODULE_PAYMENT_ETH_TEXT_TITLE', 'Ethereum (ETH)');
if ( defined('MODULE_PAYMENT_ETH_QRCODE') && (MODULE_PAYMENT_ETH_QRCODE != "") ) {
define('MODULE_PAYMENT_ETH_TEXT_DESCRIPTION',  'Pagar para: ' . MODULE_PAYMENT_ETH_PAYTO . '<br><br>' . '<a href="ethereum:'.MODULE_PAYMENT_ETH_PAYTO.'" target="_blank"><img src= "' . MODULE_PAYMENT_ETH_QRCODE . '" border="0" /></a>' . '<br><br>' . 'Su pedido sólo será enviado después de recibir el pago.');
define('MODULE_PAYMENT_ETH_TEXT_EMAIL_FOOTER', 'Pagar para: ' . MODULE_PAYMENT_ETH_PAYTO . "\n\n"     . '<img src= "' . MODULE_PAYMENT_ETH_QRCODE . '" border="0" />' .  "\n\n"    . 'Su pedido sólo será enviado después de recibir el pago.');
}elseif ( ( defined('MODULE_PAYMENT_ETH_PAYTO') && (MODULE_PAYMENT_ETH_PAYTO != "") ) || ( defined('MODULE_PAYMENT_ETH_QRCODE') && (MODULE_PAYMENT_ETH_QRCODE == "") ) ) {
define('MODULE_PAYMENT_ETH_TEXT_DESCRIPTION',  'Pagar para: ' . defined('MODULE_PAYMENT_ETH_PAYTO') ? MODULE_PAYMENT_ETH_PAYTO : '' . '<br><br>' . 'Su pedido sólo será enviado después de recibir el pago.');
define('MODULE_PAYMENT_ETH_TEXT_EMAIL_FOOTER', 'Pagar para: ' . defined('MODULE_PAYMENT_ETH_PAYTO') ? MODULE_PAYMENT_ETH_PAYTO : '' . "\n\n" . 'Su pedido sólo será enviado después de recibir el pago.');
}
define('MODULE_PAYMENT_ETH_TEXT_DEADLINE_DATE', 'Plazo de Pago');
?>