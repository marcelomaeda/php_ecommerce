<?php
define('MODULE_PAYMENT_ETH_TEXT_TITLE', 'Ethereum (ETH)');
if ( defined('MODULE_PAYMENT_ETH_QRCODE') && (MODULE_PAYMENT_ETH_QRCODE != "") ) {
define('MODULE_PAYMENT_ETH_TEXT_DESCRIPTION',  'Zahlbar an: ' . MODULE_PAYMENT_ETH_PAYTO . '<br><br>' . '<a href="ethereum:'.MODULE_PAYMENT_ETH_PAYTO.'" target="_blank"><img src= "' . MODULE_PAYMENT_ETH_QRCODE . '" border="0" /></a>' . '<br><br>' . 'Ihre Bestellung wird erst versendet, wenn wir die Zahlung erhalten haben.');
define('MODULE_PAYMENT_ETH_TEXT_EMAIL_FOOTER', 'Zahlbar an: ' . MODULE_PAYMENT_ETH_PAYTO . "\n\n"     . '<img src= "' . MODULE_PAYMENT_ETH_QRCODE . '" border="0" />' .  "\n\n"    . 'Ihre Bestellung wird erst versendet, wenn wir die Zahlung erhalten haben.');
}elseif ( ( defined('MODULE_PAYMENT_ETH_PAYTO') && (MODULE_PAYMENT_ETH_PAYTO != "") ) || ( defined('MODULE_PAYMENT_ETH_QRCODE') && (MODULE_PAYMENT_ETH_QRCODE == "") ) ) {
define('MODULE_PAYMENT_ETH_TEXT_DESCRIPTION',  'Zahlbar an: ' . defined('MODULE_PAYMENT_ETH_PAYTO') ? MODULE_PAYMENT_ETH_PAYTO : '' . '<br><br>' . 'Ihre Bestellung wird erst versendet, wenn wir die Zahlung erhalten haben.');
define('MODULE_PAYMENT_ETH_TEXT_EMAIL_FOOTER', 'Zahlbar an: ' . defined('MODULE_PAYMENT_ETH_PAYTO') ? MODULE_PAYMENT_ETH_PAYTO : '' . "\n\n" . 'Ihre Bestellung wird erst versendet, wenn wir die Zahlung erhalten haben.');
}
define('MODULE_PAYMENT_ETH_TEXT_DEADLINE_DATE', 'Zahlungsfrist');
?>
