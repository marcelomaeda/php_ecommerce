<?php
define('MODULE_PAYMENT_BTC_TEXT_TITLE', 'Bitcoin (BTC)');
if ( defined('MODULE_PAYMENT_BTC_QRCODE') && (MODULE_PAYMENT_BTC_QRCODE != "") ) {
define('MODULE_PAYMENT_BTC_TEXT_DESCRIPTION',  'Zahlbar an: ' . MODULE_PAYMENT_BTC_PAYTO . '<br><br>' . '<a href="bitcoin:'.MODULE_PAYMENT_BTC_PAYTO.'" target="_blank"><img src= "' . MODULE_PAYMENT_BTC_QRCODE . '" border="0" /></a>' . '<br><br>' . 'Ihre Bestellung wird erst versendet, wenn wir die Zahlung erhalten haben.');
define('MODULE_PAYMENT_BTC_TEXT_EMAIL_FOOTER', 'Zahlbar an: ' . MODULE_PAYMENT_BTC_PAYTO . "\n\n"     . '<img src= "' . MODULE_PAYMENT_BTC_QRCODE . '" border="0" />' .  "\n\n"    . 'Ihre Bestellung wird erst versendet, wenn wir die Zahlung erhalten haben.');
}elseif ( ( defined('MODULE_PAYMENT_BTC_PAYTO') && (MODULE_PAYMENT_BTC_PAYTO != "") ) || ( defined('MODULE_PAYMENT_BTC_QRCODE') && (MODULE_PAYMENT_BTC_QRCODE == "") ) ) {
define('MODULE_PAYMENT_BTC_TEXT_DESCRIPTION',  'Zahlbar an: ' . defined('MODULE_PAYMENT_BTC_PAYTO') ? MODULE_PAYMENT_BTC_PAYTO : '' . '<br><br>' . 'Ihre Bestellung wird erst versendet, wenn wir die Zahlung erhalten haben.');
define('MODULE_PAYMENT_BTC_TEXT_EMAIL_FOOTER', 'Zahlbar an: ' . defined('MODULE_PAYMENT_BTC_PAYTO') ? MODULE_PAYMENT_BTC_PAYTO : '' . "\n\n" . 'Ihre Bestellung wird erst versendet, wenn wir die Zahlung erhalten haben.');
}
define('MODULE_PAYMENT_BTC_TEXT_DEADLINE_DATE', 'Zahlungsfrist');
?>
