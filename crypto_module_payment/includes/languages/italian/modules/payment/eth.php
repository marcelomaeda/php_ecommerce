<?php
define('MODULE_PAYMENT_ETH_TEXT_TITLE', 'Ethereum (ETH)');
if ( defined('MODULE_PAYMENT_ETH_QRCODE') && (MODULE_PAYMENT_ETH_QRCODE != "") ) {
define('MODULE_PAYMENT_ETH_TEXT_DESCRIPTION',  'Pagabile a: ' . MODULE_PAYMENT_ETH_PAYTO . '<br><br>' . '<a href="ethereum:'.MODULE_PAYMENT_ETH_PAYTO.'" target="_blank"><img src= "' . MODULE_PAYMENT_ETH_QRCODE . '" border="0" /></a>' . '<br><br>' . 'Il tuo ordine non verrà spedito finché non avremo ricevuto il pagamento.');
define('MODULE_PAYMENT_ETH_TEXT_EMAIL_FOOTER', 'Pagabile a: ' . MODULE_PAYMENT_ETH_PAYTO . "\n\n"     . '<img src= "' . MODULE_PAYMENT_ETH_QRCODE . '" border="0" />' .  "\n\n"    . 'Il tuo ordine non verrà spedito finché non avremo ricevuto il pagamento.');
}elseif ( ( defined('MODULE_PAYMENT_ETH_PAYTO') && (MODULE_PAYMENT_ETH_PAYTO != "") ) || ( defined('MODULE_PAYMENT_ETH_QRCODE') && (MODULE_PAYMENT_ETH_QRCODE == "") ) ) {
define('MODULE_PAYMENT_ETH_TEXT_DESCRIPTION',  'Pagabile a: ' . defined('MODULE_PAYMENT_ETH_PAYTO') ? MODULE_PAYMENT_ETH_PAYTO : '' . '<br><br>' . 'Il tuo ordine non verrà spedito finché non avremo ricevuto il pagamento.');
define('MODULE_PAYMENT_ETH_TEXT_EMAIL_FOOTER', 'Pagabile a: ' . defined('MODULE_PAYMENT_ETH_PAYTO') ? MODULE_PAYMENT_ETH_PAYTO : '' . "\n\n" . 'Il tuo ordine non verrà spedito finché non avremo ricevuto il pagamento.');
}
define('MODULE_PAYMENT_ETH_TEXT_DEADLINE_DATE', 'Termine di Pagamento');
?>