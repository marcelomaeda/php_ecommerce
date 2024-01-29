<?php
  class eth {
    var $code, $title, $description, $enabled;

// class constructor
    function __construct() {
      global $order;

      $this->code = 'eth';

	  if (defined('MODULE_PAYMENT_ETH_IMAGE') && MODULE_PAYMENT_ETH_IMAGE != '') {
	  $image_payment = ' ' . tep_image(MODULE_PAYMENT_ETH_IMAGE, (( defined('MODULE_PAYMENT_ETH_TITLE_NEW') && (MODULE_PAYMENT_ETH_TITLE_NEW != "") ) ? MODULE_PAYMENT_ETH_TITLE_NEW : MODULE_PAYMENT_ETH_TEXT_TITLE), '', '', ' align="absmiddle"');
	  }
		  
	  if ( defined('MODULE_PAYMENT_ETH_QRCODE') && (MODULE_PAYMENT_ETH_QRCODE != "") ) {
		  $data_image = file_get_contents(MODULE_PAYMENT_ETH_QRCODE);
		  $base64_image = 'data:image/' . $type_image . ';base64,' . base64_encode($data_image);
	  }

	  if ( defined('MODULE_PAYMENT_ETH_TITLE_NEW') && (MODULE_PAYMENT_ETH_TITLE_NEW != "") ) {
      $this->title = utf8_decode(MODULE_PAYMENT_ETH_TITLE_NEW) . $image_payment . "<br /><span style=\"font-weight: normal;\">".utf8_decode(str_replace(MODULE_PAYMENT_ETH_QRCODE, $base64_image, MODULE_PAYMENT_ETH_TEXT_DESCRIPTION))."</span>";
	  }elseif ( defined('MODULE_PAYMENT_ETH_TEXT_TITLE') && (MODULE_PAYMENT_ETH_TEXT_TITLE != "") ) {
	  $this->title = utf8_decode(MODULE_PAYMENT_ETH_TEXT_TITLE) . $image_payment . "<br /><span style=\"font-weight: normal;\">".utf8_decode(defined('MODULE_PAYMENT_ETH_TEXT_DESCRIPTION') ? str_replace(MODULE_PAYMENT_ETH_QRCODE, $base64_image, MODULE_PAYMENT_ETH_TEXT_DESCRIPTION) : '')."</span>";
	  }

      if (defined('MODULE_PAYMENT_ETH_TEXT_DESCRIPTION') && MODULE_PAYMENT_ETH_TEXT_DESCRIPTION != "") {
        $this->description = utf8_decode(str_replace(MODULE_PAYMENT_ETH_QRCODE, $base64_image, MODULE_PAYMENT_ETH_TEXT_DESCRIPTION));
      } else {
        $this->description = '';
      }
      if (defined('MODULE_PAYMENT_ETH_SORT_ORDER') && MODULE_PAYMENT_ETH_SORT_ORDER != "") {
        $this->sort_order = (int)MODULE_PAYMENT_ETH_SORT_ORDER;
      } else {
        $this->sort_order = '';
      }

      if (defined('MODULE_PAYMENT_ETH_STATUS')) {
        $this->enabled = (defined('MODULE_PAYMENT_ETH_STATUS') && (MODULE_PAYMENT_ETH_STATUS == 'True') ? true : false);
      } else {
        $this->enabled = false;
      }

      if (defined('MODULE_PAYMENT_ETH_ORDER_STATUS_ID') && MODULE_PAYMENT_ETH_ORDER_STATUS_ID != "") {
        if ((int)MODULE_PAYMENT_ETH_ORDER_STATUS_ID > 0) {
          $this->order_status = MODULE_PAYMENT_ETH_ORDER_STATUS_ID;
        }
      } else {
        $this->order_status = 0;
      }

      if (is_object($order)) $this->update_status();

      if (defined('MODULE_PAYMENT_ETH_TEXT_EMAIL_FOOTER')) {
        $this->email_footer = MODULE_PAYMENT_ETH_TEXT_EMAIL_FOOTER;
      } else {
        $this->email_footer = '';
      }
	  
	  if ($this->enabled == true) {
		  $check_configuration_query = tep_db_query("select configuration_key from configuration where configuration_key = 'MODULE_PAYMENT_ETH_COUNTRIES_BLOCK' ");
		  $check_configuration = tep_db_fetch_array($check_configuration_query);
		  if ($check_configuration['configuration_key'] == '') {
		  tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Do not accept payments in the countries', 'MODULE_PAYMENT_ETH_COUNTRIES_BLOCK', '', 'Separate by comma if you have more than one country (Example: Brazil,Argentina,Paraguay). Leave blank to accept in all countries.', '6', '2', now())");
		  }
		  $check_configuration_query = tep_db_query("select configuration_key from configuration where configuration_key = 'MODULE_PAYMENT_ETH_MAXIMUM_VALUE' ");
		  $check_configuration = tep_db_fetch_array($check_configuration_query);
		  if ($check_configuration['configuration_key'] == '') {
		  tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Maximum amount to accept this payment', 'MODULE_PAYMENT_ETH_MAXIMUM_VALUE', '0', 'What is the maximum amount to accept the form of payment? (Example: 50 or 50.00) (zero disables this feature)', '6', '2', now())");
		  }
		  $check_configuration_query = tep_db_query("select configuration_key from configuration where configuration_key = 'MODULE_PAYMENT_ETH_ONLY_MARKETPLACE' ");
		  $check_configuration = tep_db_fetch_array($check_configuration_query);
		  if ($check_configuration['configuration_key'] == '') {
		  tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Disable Only to Marketplace', 'MODULE_PAYMENT_ETH_ONLY_MARKETPLACE', 'False', 'Do you want enable disable only to marketplace?', '6', '0', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
		  }
		  $check_configuration_query = tep_db_query("select configuration_key from configuration where configuration_key = 'MODULE_PAYMENT_ETH_API_RATE' ");
		  $check_configuration = tep_db_fetch_array($check_configuration_query);
		  if ($check_configuration['configuration_key'] == '') {
//		  tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('API Rate', 'MODULE_PAYMENT_ETH_API_RATE', 'bitpay', 'Choose the API Rate', '6', '10', 'tep_cfg_select_option(array(\'mercadobitcoin\', \'bitpay\'), ', now())");
		  tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('API Rate', 'MODULE_PAYMENT_ETH_API_RATE', 'bitpay', 'Choose the API Rate', '6', '10', 'tep_cfg_select_option(array(\'bitpay\'), ', now())");
		  }
		  $check_configuration_query = tep_db_query("select configuration_key from configuration where configuration_key = 'MODULE_PAYMENT_ETH_PERCENTAGE_ADD' ");
		  $check_configuration = tep_db_fetch_array($check_configuration_query);
		  if ($check_configuration['configuration_key'] == '') {
		  tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Percentage to add as a safety margin', 'MODULE_PAYMENT_ETH_PERCENTAGE_ADD', '0', 'What is the percentage to add as a safety margin? (Example: 50) (only number) (empty disables this feature)', '6', '2', now())");
		  }
	  
	  }

    }

// class methods
    function update_status() {
      global $order, $cart;

	  //$cart_total = $cart->show_total();
	  $cart_total = $order->info['total'];
	  
	  if ( ($this->enabled == true) && (defined('MODULE_PAYMENT_ETH_MAXIMUM_VALUE') && MODULE_PAYMENT_ETH_MAXIMUM_VALUE > 0) ) {
	  $countries_info_query=tep_db_query("SELECT countries_iso_code_2 FROM countries WHERE `countries_name` = '".$order->customer['country']['title']."'");
	  $countries_info_q = tep_db_fetch_array($countries_info_query);  
	  if ($countries_info_q["countries_iso_code_2"] != '') {
	  $dest_country = $countries_info_q["countries_iso_code_2"];
	  }else{
	  $dest_country = $order->customer['country']['iso_code_2'];
	  }
	  
	  if (defined('MODULE_PAYMENT_ETH_MAXIMUM_VALUE') && MODULE_PAYMENT_ETH_MAXIMUM_VALUE == 0) {
		  $lock_eth = false;
	  }else{
		  if (defined('MODULE_PAYMENT_ETH_MAXIMUM_VALUE') && $cart_total >= MODULE_PAYMENT_ETH_MAXIMUM_VALUE && MODULE_PAYMENT_ETH_MAXIMUM_VALUE > 0) {
			$lock_eth = true;
		  }else{
			$lock_eth = false;
		  }
	  }
	  if ($lock_eth == true) {
		  $this->enabled = false;
	  }
	  }

      if ( ($this->enabled == true) && (defined('MODULE_PAYMENT_ETH_ZONE') && (int)MODULE_PAYMENT_ETH_ZONE > 0) ) {
        $check_flag = false;
        $check_query = tep_db_query("select zone_id from " . TABLE_ZONES_TO_GEO_ZONES . " where geo_zone_id = '" . MODULE_PAYMENT_ETH_ZONE . "' and ( zone_country_id = 0 or zone_country_id = '" . $order->billing['country']['id'] . "' ) order by zone_id");
        while ($check = tep_db_fetch_array($check_query)) {
          if ($check['zone_id'] < 1) {
            $check_flag = true;
            break;
          } elseif ($check['zone_id'] == $order->billing['zone_id']) {
            $check_flag = true;
            break;
          }
        }

        if ($check_flag == false) {
          $this->enabled = false;
        }
      }
	  
	  if ( ($this->enabled == true) && (defined('MODULE_PAYMENT_ETH_COUNTRIES_BLOCK') && MODULE_PAYMENT_ETH_COUNTRIES_BLOCK != '') ) {
		  $check_flag = false;
		  $dest_country = $order->customer['country']['title'];
	
		  $regions2_table = constant('MODULE_PAYMENT_ETH_COUNTRIES_BLOCK');
		  $country_states_or_countries = preg_split("/[,]/", $regions2_table);
		  if (is_array($country_states_or_countries)) {
		  if (in_array($dest_country, $country_states_or_countries)) {
			$check_flag = true;
			//break;
		  }
		  if ($check_flag == true) {
			$this->enabled = false;
		  }
		  }
	  }

	  // marketplace
	  if (defined('ENABLE_MARKETPLACE') && ENABLE_MARKETPLACE == 'true' && defined('STATUS_MARKETPLACE') && STATUS_MARKETPLACE == 'true') {
		  if (defined('MODULE_PAYMENT_ETH_ONLY_MARKETPLACE') && MODULE_PAYMENT_ETH_ONLY_MARKETPLACE == "False"){
			  for ($i=0, $n=sizeof($order->products); $i<$n; $i++) {
				  if ($order->products[$i]['seller_member_id'] != '') {
					  $has_seller_member_id = true;
				  }
			  }
			  if ($has_seller_member_id == true){
				  $this->enabled = true;
			  }
		  }elseif (defined('MODULE_PAYMENT_ETH_ONLY_MARKETPLACE') && MODULE_PAYMENT_ETH_ONLY_MARKETPLACE == "True"){
			for ($i=0, $n=sizeof($order->products); $i<$n; $i++) {
				if ($order->products[$i]['seller_member_id'] != '') {
					$has_seller_member_id = true;
				}else{
					$has_seller_member_id = false;
				}
			}
			if ($has_seller_member_id == false){
				$this->enabled = false;
			}
		  }
	  }
	  // marketplace eof
		
    }

    function javascript_validation() {
      return false;
    }

    function selection() {
//      global $order, $n_pedido, $currencies;
		
      return array('id' => $this->code,
                   'module' => $this->title . $add_confirmation);
    }

    function pre_confirmation_check() {
      return false;
    }

    function confirmation() {
      return array('title' => utf8_decode(MODULE_PAYMENT_ETH_TEXT_DESCRIPTION));
    }

    function process_button() {
      return false;
    }

    function before_process() {
      return false;
    }

    function after_process() {
      global $insert_id, $order, $currencies;

      if (defined('MODULE_PAYMENT_ETH_API_RATE') && MODULE_PAYMENT_ETH_API_RATE == 'bitpay'){
			$curl = curl_init();
			curl_setopt($curl, CURLOPT_URL, "https://bitpay.com/rates/ETH");
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
			$result = curl_exec($curl);
			curl_close($curl);
			$response_decode = json_decode($result);
			$result_body = objectToArray($response_decode);
		  
		    for ($i=0, $n=sizeof($result_body['data']); $i<$n; $i++) {
				
				if ($result_body['data'][$i]['code'] == DEFAULT_CURRENCY){	
//				if ($order->info['total'] <= 19 ){
//					$value_divide = 100;
//					$value_divide_res = $order->info['total']/$value_divide;
//					$eth_total = $value_divide_res / (int)$result_body['data'][$i]['rate'];
//				}elseif ($order->info['total'] >= 19){
					$eth_total = $order->info['total'] / (int)$result_body['data'][$i]['rate'];
//				}
				$eth_rate_orig = $result_body['data'][$i]['rate'];
				$eth_rate = (int)$result_body['data'][$i]['rate'];
				}
			}
      }	// end if (defined('MODULE_PAYMENT_ETH_API_RATE') && MODULE_PAYMENT_ETH_API_RATE == 'bitpay'){
		
//	  echo $order->info['total'];
//	  echo '<br>-----<br>';
//	  echo $eth_total;
//	  echo '<br>-----<br>';

	  if ($eth_total != ''){

	  if (defined('MODULE_PAYMENT_ETH_PERCENTAGE_ADD') && MODULE_PAYMENT_ETH_PERCENTAGE_ADD != '' && MODULE_PAYMENT_ETH_PERCENTAGE_ADD > 0) {
		  $percentage_calc = MODULE_PAYMENT_ETH_PERCENTAGE_ADD/100;
		  $eth_total_percentage_calc = $eth_total * $percentage_calc;
		  $eth_total = $eth_total_percentage_calc + $eth_total;
	  }
		  
	  if ( defined('MODULE_PAYMENT_ETH_QRCODE') && (MODULE_PAYMENT_ETH_QRCODE != "") ) {
		  $data_image = file_get_contents(MODULE_PAYMENT_ETH_QRCODE);
		  $base64_image = 'data:image/' . $type_image . ';base64,' . base64_encode($data_image);
		  $add_qr_code = '<a href="ethereum:'.MODULE_PAYMENT_ETH_PAYTO.'" target="_blank"><img src= "' . $base64_image . '" border="0" /></a>';
	  }

	  $add_confirmation = "\n\n<b>ETH: " . $eth_total . "</b>\n<b>Rate: " . $eth_rate_orig . "</b>\n<b>Total: " . $currencies->format($order->info['total'], true, $order->info['currency'], $order->info['currency_value']). "</b>" . "\n<b>" . MODULE_PAYMENT_ETH_TEXT_DEADLINE_DATE.": ".date("d/m/Y"). "</b>\n<b>" . utf8_decode(str_replace(MODULE_PAYMENT_ETH_QRCODE, $base64_image, MODULE_PAYMENT_ETH_TEXT_DESCRIPTION)) . "</b>";

	  }
		
		$sql_data_array = array('orders_id' => $insert_id 	,
								'orders_status_id' => MODULE_PAYMENT_ETH_ORDER_STATUS_ID 	,
								'date_added' => 'now()'		,
								'customer_notified' => '1'	,
								'comments' => $add_confirmation);
		tep_db_perform(TABLE_ORDERS_STATUS_HISTORY, $sql_data_array);
//		print_r($sql_data_array);
//		die;
		
		// send mail
		$email_order = $order->customer['firstname'] . ' ' . $order->customer['lastname'] . "\n\n";
		$email_order .= EMAIL_TEXT_ORDER_NUMBER . ' ' . $insert_id . "\n";
		$email_order .= str_replace("<br>", "\n", $add_confirmation) . "\n";
		$email_order .= EMAIL_TEXT_INVOICE_URL . ' ' . tep_href_link(FILENAME_ACCOUNT_HISTORY_INFO, 'order_id=' . $insert_id, 'SSL', false) . "\n";

		tep_mail($order->customer['firstname'] . ' ' . $order->customer['lastname'], $order->customer['email_address'], EMAIL_TEXT_ORDER_NUMBER . ' ' . $insert_id, $email_order, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);
		// send mail eof
		
//      return false;
    }

    function get_error() {
      return false;
    }

    function check() {
      if (!isset($this->_check)) {
        $check_query = tep_db_query("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_ETH_STATUS'");
        $this->_check = tep_db_num_rows($check_query);
      }
      return $this->_check;
    }

    function install() {
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable ETH Module', 'MODULE_PAYMENT_ETH_STATUS', 'True', 'Do you want to accept Ethereum payments?', '6', '1', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now());");

		tep_db_query("insert into " . TABLE_CONFIGURATION . " (".
                   "configuration_title, configuration_key, configuration_value, ".
                   "configuration_description, configuration_group_id, sort_order, ".
                   "date_added".
                   ") values (".
                   "'Text to be displayed to the customer on the payment options screen', 'MODULE_PAYMENT_ETH_TITLE_NEW', 'Ethereum Address', ".
                   "'Text to be displayed to the customer on the payment options screen.', '6', '1', ".
                   "now())");

      tep_db_query("insert into " . TABLE_CONFIGURATION . " (".
                   "configuration_title, configuration_key, configuration_value, ".
                   "configuration_description, configuration_group_id, sort_order, ".
                   "set_function, date_added".
                   ") values (".
                   "'Picture of the form of payment', 'MODULE_PAYMENT_ETH_IMAGE', 'images/payment_ethereum.png', ".
                   "'Picture of the form of payment.', '6', '1', ".
                   "'tep_cfg_input_field_pickupimage(', now())");

      tep_db_query("insert into " . TABLE_CONFIGURATION . " (".
                   "configuration_title, configuration_key, configuration_value, ".
                   "configuration_description, configuration_group_id, sort_order, ".
                   "set_function, date_added".
                   ") values (".
                   "'Picture of the QR Code', 'MODULE_PAYMENT_ETH_QRCODE', '', ".
                   "'Picture of the QR Code.', '6', '1', ".
                   "'tep_cfg_input_field_pickupimage(', now())");

      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Your ETH Address:', 'MODULE_PAYMENT_ETH_PAYTO', '', 'Who should payments be made payable to (Ethereum Address)?', '6', '1', now());");

      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ETH Sort order of display.', 'MODULE_PAYMENT_ETH_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', '6', '0', now())");

      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('ETH Payment Zone', 'MODULE_PAYMENT_ETH_ZONE', '0', 'If a zone is selected, enable this payment method for that zone only.', '6', '2', 'tep_get_zone_class_title', 'tep_cfg_pull_down_zone_classes(', now())");

      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, use_function, date_added) values ('ETH Set Order Status', 'MODULE_PAYMENT_ETH_ORDER_STATUS_ID', '0', 'Set the status of orders made with this payment module to this value', '6', '0', 'tep_cfg_pull_down_order_statuses(', 'tep_get_order_status_name', now())");

	  tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Maximum amount to accept this payment', 'MODULE_PAYMENT_ETH_MAXIMUM_VALUE', '0', 'What is the maximum amount to accept the form of payment? (Example: 50 or 50.00) (zero disables this feature)', '6', '2', now())");
	  
	  tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Do not accept payments in the countries', 'MODULE_PAYMENT_ETH_COUNTRIES_BLOCK', '', 'Separate by comma if you have more than one country (Example: Brazil,Argentina,Paraguay). Leave blank to accept in all countries.', '6', '0', now())");
		
	  tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Disable Only to Marketplace', 'MODULE_PAYMENT_ETH_ONLY_MARKETPLACE', 'False', 'Do you want enable disable only to marketplace?', '6', '0', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
		
//	  tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('API Rate', 'MODULE_PAYMENT_ETH_API_RATE', 'bitpay', 'Choose the API Rate', '6', '10', 'tep_cfg_select_option(array(\'mercadobitcoin\', \'bitpay\'), ', now())");
	  tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('API Rate', 'MODULE_PAYMENT_ETH_API_RATE', 'bitpay', 'Choose the API Rate', '6', '10', 'tep_cfg_select_option(array(\'bitpay\'), ', now())");

	  tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Percentage to add as a safety margin', 'MODULE_PAYMENT_ETH_PERCENTAGE_ADD', '0', 'What is the percentage to add as a safety margin? (Example: 50) (only number) (empty disables this feature)', '6', '2', now())");

    }

    function remove() {
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }

    function keys() {
      return array('MODULE_PAYMENT_ETH_STATUS', 'MODULE_PAYMENT_ETH_ZONE', 'MODULE_PAYMENT_ETH_ORDER_STATUS_ID', 'MODULE_PAYMENT_ETH_SORT_ORDER', 'MODULE_PAYMENT_ETH_PAYTO', 'MODULE_PAYMENT_ETH_TITLE_NEW', 'MODULE_PAYMENT_ETH_IMAGE', 'MODULE_PAYMENT_ETH_QRCODE', 'MODULE_PAYMENT_ETH_MAXIMUM_VALUE', 'MODULE_PAYMENT_ETH_COUNTRIES_BLOCK', 'MODULE_PAYMENT_ETH_ONLY_MARKETPLACE', 'MODULE_PAYMENT_ETH_API_RATE', 'MODULE_PAYMENT_ETH_PERCENTAGE_ADD');
    }
  }
?>
