<?php
define('MODULE_PAYMENT_ETH_TEXT_TITLE', 'Ethereum (ETH)');
if ( defined('MODULE_PAYMENT_ETH_QRCODE') && (MODULE_PAYMENT_ETH_QRCODE != "") ) {
define('MODULE_PAYMENT_ETH_TEXT_DESCRIPTION',  '��ʧ���� ' . MODULE_PAYMENT_ETH_PAYTO . '<br><br>' . '<a href="ethereum:'.MODULE_PAYMENT_ETH_PAYTO.'" target="_blank"><img src= "' . MODULE_PAYMENT_ETH_QRCODE . '" border="0" /></a>' . '<br><br>' . '���ʤ�����ʸ�ϡ��䤿������ʧ���������ä���ˤΤ߽в٤���ޤ�');
define('MODULE_PAYMENT_ETH_TEXT_EMAIL_FOOTER', '��ʧ���� ' . MODULE_PAYMENT_ETH_PAYTO . "\n\n"     . '<img src= "' . MODULE_PAYMENT_ETH_QRCODE . '" border="0" />' .  "\n\n"    . '���ʤ�����ʸ�ϡ��䤿������ʧ���������ä���ˤΤ߽в٤���ޤ�');
}elseif ( ( defined('MODULE_PAYMENT_ETH_PAYTO') && (MODULE_PAYMENT_ETH_PAYTO != "") ) || ( defined('MODULE_PAYMENT_ETH_QRCODE') && (MODULE_PAYMENT_ETH_QRCODE == "") ) ) {
define('MODULE_PAYMENT_ETH_TEXT_DESCRIPTION',  '��ʧ���� ' . defined('MODULE_PAYMENT_ETH_PAYTO') ? MODULE_PAYMENT_ETH_PAYTO : '' . '<br><br>' . '���ʤ�����ʸ�ϡ��䤿������ʧ���������ä���ˤΤ߽в٤���ޤ�');
define('MODULE_PAYMENT_ETH_TEXT_EMAIL_FOOTER', '��ʧ���� ' . defined('MODULE_PAYMENT_ETH_PAYTO') ? MODULE_PAYMENT_ETH_PAYTO : '' . "\n\n" . '���ʤ�����ʸ�ϡ��䤿������ʧ���������ä���ˤΤ߽в٤���ޤ�');
}
define('MODULE_PAYMENT_ETH_TEXT_DEADLINE_DATE', '��ʧ���');
?>