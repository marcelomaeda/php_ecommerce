<?php
define('MODULE_PAYMENT_ETH_TEXT_TITLE', 'Ethereum (ETH)');
if ( defined('MODULE_PAYMENT_ETH_QRCODE') && (MODULE_PAYMENT_ETH_QRCODE != "") ) {
define('MODULE_PAYMENT_ETH_TEXT_DESCRIPTION',  'Payable To: ' . MODULE_PAYMENT_ETH_PAYTO . '<br><br>' . '<a href="ethereum:'.MODULE_PAYMENT_ETH_PAYTO.'" target="_blank"><img src= "' . MODULE_PAYMENT_ETH_QRCODE . '" border="0" /></a>' . '<br><br>' . 'Your order will not ship until we receive payment.');
define('MODULE_PAYMENT_ETH_TEXT_EMAIL_FOOTER', 'Payable To: ' . MODULE_PAYMENT_ETH_PAYTO . "\n\n"     . '<img src= "' . MODULE_PAYMENT_ETH_QRCODE . '" border="0" />' .  "\n\n"    . 'Your order will not ship until we receive payment.');
}elseif ( ( defined('MODULE_PAYMENT_ETH_PAYTO') && (MODULE_PAYMENT_ETH_PAYTO != "") ) || ( defined('MODULE_PAYMENT_ETH_QRCODE') && (MODULE_PAYMENT_ETH_QRCODE == "") ) ) {
define('MODULE_PAYMENT_ETH_TEXT_DESCRIPTION',  'Payable To: ' . defined('MODULE_PAYMENT_ETH_PAYTO') ? MODULE_PAYMENT_ETH_PAYTO : '' . '<br><br>' . 'Your order will not ship until we receive payment.');
define('MODULE_PAYMENT_ETH_TEXT_EMAIL_FOOTER', 'Payable To: ' . defined('MODULE_PAYMENT_ETH_PAYTO') ? MODULE_PAYMENT_ETH_PAYTO : '' . "\n\n" . 'Your order will not ship until we receive payment.');
}
define('MODULE_PAYMENT_ETH_TEXT_DEADLINE_DATE', 'Payment Term');
?>