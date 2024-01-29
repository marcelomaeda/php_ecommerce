<?php
define('MODULE_PAYMENT_BTC_TEXT_TITLE', 'Bitcoin (BTC)');
if ( defined('MODULE_PAYMENT_BTC_QRCODE') && (MODULE_PAYMENT_BTC_QRCODE != "") ) {
define('MODULE_PAYMENT_BTC_TEXT_DESCRIPTION',  'Pagabile a: ' . MODULE_PAYMENT_BTC_PAYTO . '<br><br>' . '<a href="bitcoin:'.MODULE_PAYMENT_BTC_PAYTO.'" target="_blank"><img src= "' . MODULE_PAYMENT_BTC_QRCODE . '" border="0" /></a>' . '<br><br>' . 'Il tuo ordine non verrà spedito finché non avremo ricevuto il pagamento.');
define('MODULE_PAYMENT_BTC_TEXT_EMAIL_FOOTER', 'Pagabile a: ' . MODULE_PAYMENT_BTC_PAYTO . "\n\n"     . '<img src= "' . MODULE_PAYMENT_BTC_QRCODE . '" border="0" />' .  "\n\n"    . 'Il tuo ordine non verrà spedito finché non avremo ricevuto il pagamento.');
}elseif ( ( defined('MODULE_PAYMENT_BTC_PAYTO') && (MODULE_PAYMENT_BTC_PAYTO != "") ) || ( defined('MODULE_PAYMENT_BTC_QRCODE') && (MODULE_PAYMENT_BTC_QRCODE == "") ) ) {
define('MODULE_PAYMENT_BTC_TEXT_DESCRIPTION',  'Pagabile a: ' . defined('MODULE_PAYMENT_BTC_PAYTO') ? MODULE_PAYMENT_BTC_PAYTO : '' . '<br><br>' . 'Il tuo ordine non verrà spedito finché non avremo ricevuto il pagamento.');
define('MODULE_PAYMENT_BTC_TEXT_EMAIL_FOOTER', 'Pagabile a: ' . defined('MODULE_PAYMENT_BTC_PAYTO') ? MODULE_PAYMENT_BTC_PAYTO : '' . "\n\n" . 'Il tuo ordine non verrà spedito finché non avremo ricevuto il pagamento.');
}
define('MODULE_PAYMENT_BTC_TEXT_DEADLINE_DATE', 'Termine di Pagamento');
?>