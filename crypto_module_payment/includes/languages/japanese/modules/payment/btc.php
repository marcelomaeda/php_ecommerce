<?php
define('MODULE_PAYMENT_BTC_TEXT_TITLE', 'Bitcoin (BTC)');
if ( defined('MODULE_PAYMENT_BTC_QRCODE') && (MODULE_PAYMENT_BTC_QRCODE != "") ) {
define('MODULE_PAYMENT_BTC_TEXT_DESCRIPTION',  '��ʧ���� ' . MODULE_PAYMENT_BTC_PAYTO . '<br><br>' . '<a href="bitcoin:'.MODULE_PAYMENT_BTC_PAYTO.'" target="_blank"><img src= "' . MODULE_PAYMENT_BTC_QRCODE . '" border="0" /></a>' . '<br><br>' . '���ʤ�����ʸ�ϡ��䤿������ʧ���������ä���ˤΤ߽в٤���ޤ�');
define('MODULE_PAYMENT_BTC_TEXT_EMAIL_FOOTER', '��ʧ���� ' . MODULE_PAYMENT_BTC_PAYTO . "\n\n"     . '<img src= "' . MODULE_PAYMENT_BTC_QRCODE . '" border="0" />' .  "\n\n"    . '���ʤ�����ʸ�ϡ��䤿������ʧ���������ä���ˤΤ߽в٤���ޤ�');
}elseif ( ( defined('MODULE_PAYMENT_BTC_PAYTO') && (MODULE_PAYMENT_BTC_PAYTO != "") ) || ( defined('MODULE_PAYMENT_BTC_QRCODE') && (MODULE_PAYMENT_BTC_QRCODE == "") ) ) {
define('MODULE_PAYMENT_BTC_TEXT_DESCRIPTION',  '��ʧ���� ' . defined('MODULE_PAYMENT_BTC_PAYTO') ? MODULE_PAYMENT_BTC_PAYTO : '' . '<br><br>' . '���ʤ�����ʸ�ϡ��䤿������ʧ���������ä���ˤΤ߽в٤���ޤ�');
define('MODULE_PAYMENT_BTC_TEXT_EMAIL_FOOTER', '��ʧ���� ' . defined('MODULE_PAYMENT_BTC_PAYTO') ? MODULE_PAYMENT_BTC_PAYTO : '' . "\n\n" . '���ʤ�����ʸ�ϡ��䤿������ʧ���������ä���ˤΤ߽в٤���ޤ�');
}
define('MODULE_PAYMENT_BTC_TEXT_DEADLINE_DATE', '��ʧ���');
?>