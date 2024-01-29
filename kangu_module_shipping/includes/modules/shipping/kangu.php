<?php
class kangu
{ 
  var $code, $cart, $title, $description, $enabled, $kangu; 

 
  function __construct() 
  { 

	if (defined('MODULE_SHIPPING_KANGU_IMAGE') && MODULE_SHIPPING_KANGU_IMAGE) {
	$image_payment = ' ' . tep_image(MODULE_SHIPPING_KANGU_IMAGE, (( defined('MODULE_SHIPPING_KANGU_TEXT_TITLE_NEW') && (MODULE_SHIPPING_KANGU_TEXT_TITLE_NEW != "") ) ? MODULE_SHIPPING_KANGU_TEXT_TITLE_NEW : ''), '', '', ' align="absmiddle"');
	}

	$this->code = 'kangu';

	if ( defined('MODULE_SHIPPING_KANGU_TEXT_TITLE_NEW') && (MODULE_SHIPPING_KANGU_TEXT_TITLE_NEW != "") ) {
	$this->title = MODULE_SHIPPING_KANGU_TEXT_TITLE_NEW . $image_payment;
	}elseif ( defined('MODULE_SHIPPING_KANGU_TEXT_TITLE') && (MODULE_SHIPPING_KANGU_TEXT_TITLE != "") ) {
	$this->title = MODULE_SHIPPING_KANGU_TEXT_TITLE . $image_payment;
	}

    if ( defined('MODULE_SHIPPING_KANGU_TEXT_DESCRIPTION') && (MODULE_SHIPPING_KANGU_TEXT_DESCRIPTION != "") ) {
    $this->description = MODULE_SHIPPING_KANGU_TEXT_DESCRIPTION;
    }
    $this->sort_order = defined('MODULE_SHIPPING_KANGU_SORT_ORDER') ? MODULE_SHIPPING_KANGU_SORT_ORDER : 0;
    $this->icon = '';
    $this->enabled = ((defined('MODULE_SHIPPING_KANGU_STATUS') && MODULE_SHIPPING_KANGU_STATUS == 'True') ? true : false);
    $this->kangu = 1;
	
  } 

// class methods 
  function quote($method = '') 
  { 
    global $order, $cart, $HTTP_GET_VARS, $currencies, $shipping_weight, $total_count, $_GET; 

	$countries_info_query=tep_db_query("SELECT countries_iso_code_2 FROM countries WHERE `countries_name` = '".$order->delivery['country']['title']."'");
    $countries_info_q = tep_db_fetch_array($countries_info_query);  
	if ($countries_info_q["countries_iso_code_2"] != '') {
    $dest_country = $countries_info_q["countries_iso_code_2"];
	}else{
	$dest_country = $order->delivery['country']['iso_code_2'];
	}
	
	if ($dest_country != 'BR') {
//		$error = true;
		return $this->quotes['error'];
	}
    
    $cep_origem=tep_db_query("SELECT configuration_value FROM ".TABLE_CONFIGURATION." WHERE `configuration_key` = 'SHIPPING_ORIGIN_ZIP'");
    $cep = tep_db_fetch_array($cep_origem);    
    $cep_origem = $cep["configuration_value"];
    $cep_origem = str_replace('-','',$cep_origem);
    $cep_origem = str_replace('.','',$cep_origem);
    $cep_origem = str_replace(',','',$cep_origem);
    $cep_origem = str_replace(' ','',$cep_origem);
    $cep_origem = str_replace('/','',$cep_origem);

    $cep_destino = $order->delivery['postcode'];
    $cep_destino = str_replace('-','',$cep_destino);
    $cep_destino = str_replace('.','',$cep_destino);
    $cep_destino = str_replace(',','',$cep_destino);
    $cep_destino = str_replace(' ','',$cep_destino);
    $cep_destino = str_replace('/','',$cep_destino);
// Corrigido para incluir o peso adicional da embalagem quando estiver configurado em Frete/Entregas
// e para calcular peso menor que 300 gr
	
    $peso=$cart->show_weight();
	$peso=$peso + SHIPPING_BOX_WEIGHT;
    $peso_orig=$peso;
	  
	// marketplace
	if (defined('ENABLE_MARKETPLACE') && ENABLE_MARKETPLACE == 'true' && defined('STATUS_MARKETPLACE') && STATUS_MARKETPLACE == 'true') {
		// $products = $cart->get_products();
		$products = $order->products;
		for ($i=0, $n=sizeof($products); $i<$n; $i++) {
			if ($products[$i]['seller_member_id'] != ""){
				$discount_seller_weight += $products[$i]['weight'];
			}
		}
		            if (count($products) > 1){
                if ($discount_seller_weight > $peso_orig){
                $peso = $discount_seller_weight - $peso_orig;
                }else{
                $peso = $peso_orig - $discount_seller_weight;
                }
            }else{
            $peso = $peso_orig;
            }
	}
	// marketplace eof

	if ($peso <= 0) {
		
		// marketplace
		if (defined('ENABLE_MARKETPLACE') && ENABLE_MARKETPLACE == 'true' && defined('STATUS_MARKETPLACE') && STATUS_MARKETPLACE == 'true') {
			$add_query_product = " and seller_member_id = '' ";
		}
		// marketplace eof
		
		$product_info_query = tep_db_query("select products_weight from " . TABLE_PRODUCTS . " where products_id = '" . (int)$HTTP_GET_VARS['products_id'] . "' " . $add_query_product);
		$product_info = tep_db_fetch_array($product_info_query);
		$peso=$product_info['products_weight'];
	}
    
	if ($peso > 0.3){
    $peso=$this->arredonda_peso($peso);
    }

// EOF correção
      
    if (!$shipping = $this->calcula_frete_kangu($cep_origem, $cep_destino, $peso, ''))
      $shipping = 0;

    // if (!$shipping_prazo = $this->calcula_prazo_kangu($cep_origem, $cep_destino, $peso, ''))
	//   $shipping_prazo = 0;
	
	if (empty($shipping['delivery_time'])){
		$shipping_prazo = 0;
	}else{
		$shipping_prazo = $shipping['delivery_time'];
	}
	  
	// marketplace
	if (defined('ENABLE_MARKETPLACE') && ENABLE_MARKETPLACE == 'true' && defined('STATUS_MARKETPLACE') && STATUS_MARKETPLACE == 'true') {
		// $products = $cart->get_products();
		$products = $order->products;
		
		for ($i=0, $n=sizeof($products); $i<$n; $i++) {	
			if ($products[$i]['seller_member_id'] != ""){
			$seller_member_id[] = $products[$i]['seller_member_id'];
			$seller_member_id = array_unique($seller_member_id);
			$product_has_seller_member_id = true;
			}
		}
		
		if ($product_has_seller_member_id == true) {
		$s = 0;
		foreach ($seller_member_id as $seller_id){
			$check_customers_query = tep_db_query("select a.entry_postcode from " . TABLE_CUSTOMERS . " c left join " . TABLE_ADDRESS_BOOK . " a on c.customers_default_address_id = a.address_book_id where a.customers_id = c.customers_id and c.customers_id = '" . (int)$seller_id . "'");
			$check_customers = tep_db_fetch_array($check_customers_query);
			$cep_origem = $check_customers['entry_postcode'];
			$cep_origem = str_replace('-','',$cep_origem);
			$cep_origem = str_replace('.','',$cep_origem);
			$cep_origem = str_replace(',','',$cep_origem);
			$cep_origem = str_replace(' ','',$cep_origem);
			$cep_origem = str_replace('/','',$cep_origem);
			
			for ($i=0, $n=sizeof($products); $i<$n; $i++) {
				if ($products[$i]['seller_member_id'] == $seller_id){
					$discount_seller_weight += $products[$i]['weight'];
				}
			}
            if (count($products) > 1){
                if ($discount_seller_weight > $peso_orig){
                $peso = $discount_seller_weight - $peso_orig;
                }else{
                $peso = $peso_orig - $discount_seller_weight;
                }
            }else{
            $peso = $peso_orig;
            }
			
			$shipping_seller_price = $this->calcula_frete_kangu($cep_origem, $cep_destino, $peso, $seller_id);
//			print_r($shipping_seller_price);
//			echo "aaaa";
			// $shipping_seller_prazo = $this->calcula_prazo_kangu($cep_origem, $cep_destino, $peso, $seller_id);
			$shipping_seller_kangu += $shipping_seller_price['price'];
			$shipping_seller_array[$s]['seller_id'] = $seller_id;
			$shipping_seller_array[$s]['shipping_price'] = $shipping_seller_price['price'];
			// $shipping_seller_array[$s]['shipping_prazo'] = $shipping_seller_prazo;
			$shipping_seller_array[$s]['shipping_prazo'] = $shipping_seller_price['delivery_time'];
		$s++;	
		}
		$add_seller_shipping_title = '';
		for ($j=0, $n2=sizeof($shipping_seller_array); $j<$n2; $j++) {
			if ($shipping_seller_array[$j]['seller_id'] != ""){
			$check_customers_query = tep_db_query("select seller_name from " . TABLE_CUSTOMERS . " where customers_id = '" . (int)$shipping_seller_array[$j]['seller_id'] . "'");
			$check_customers = tep_db_fetch_array($check_customers_query);
			$add_seller_shipping_title .= " [ " . $check_customers['seller_name'];
			$add_seller_shipping_title .= " {" . $shipping_seller_array[$j]['seller_id'];
			if ($j == $n2){
			$add_seller_shipping_title .= "} : " . $currencies->format($shipping_seller_array[$j]['shipping_price']) . " ] ";
			}else{
			$add_seller_shipping_title .= "} : " . $currencies->format($shipping_seller_array[$j]['shipping_price']) . " ] | ";
			}
			}
		}
		$has_products_store = false;
		for ($i=0, $n=sizeof($products); $i<$n; $i++) {	
			if ($products[$i]['seller_member_id'] == ""){
				$has_products_store = true;
				
				// check free shipping
//				$product_info_query = tep_db_query("select products_free_shipping from " . TABLE_PRODUCTS . " where products_id = '" . (int)$products[$i]['id'] . "' ");
//				$product_info = tep_db_fetch_array($product_info_query);
//				if ($product_info['products_free_shipping'] == 1){
//					$product_store_has_free_shipping = true;
//				}
				// check free shipping eof
			}
		}
		if ($has_products_store == true){
			$add_seller_shipping_title_store = '';
			$add_seller_shipping_title_store .= " [ " . STORE_NAME;
			$add_seller_shipping_title_store .= " {";
			
//			if ($product_store_has_free_shipping == true){
//				
//			if ($i == $n){
//				$add_seller_shipping_title_store .= "} : " . $currencies->format(0) . " ] ";
//			}else{
//				$add_seller_shipping_title_store .= "} : " . $currencies->format(0) . " ] | ";
//			}	
//				
//			}else{
			
			if ($i == $n){
				$add_seller_shipping_title_store .= "} : " . $currencies->format($shipping['price']) . " ] ";
			}else{
				$add_seller_shipping_title_store .= "} : " . $currencies->format($shipping['price']) . " ] | ";
			}
			
//			}
		}
		$this->title = $this->title . $add_seller_shipping_title . $add_seller_shipping_title_store;
		
		if (sizeof($seller_member_id) > 0) {
			
			if ($has_products_store == true){
				
		//		if ($product_store_has_free_shipping == true){
		//			$shipping = shipping_seller_kangu;
		//		}else{
					$shipping = $shipping['price'] + $shipping_seller_kangu;
		//		}
				
			}else{
				$shipping = $shipping_seller_kangu;
			}
			
		}else{
			$shipping = $shipping['price'];
		}
			
		} // end if ($product_has_seller_member_id == true) {
		
	}
	// marketplace eof
      
      if (is_array($shipping)){
		$shipping = $shipping['price'];
      }

	if ($shipping_prazo == 0) {
	$this->quotes = array('id' => $this->code, 'module' =>$this->title, 'methods' => array(array('id' => $this->code, 'title' => MODULE_SHIPPING_KANGU_MSG, 'cost' =>$shipping_cost += ($shipping + MODULE_SHIPPING_KANGU_HANDLING))));
	}else{
		if ($shipping_prazo > 1) {
		$this->quotes = array('id' => $this->code, 'module' =>$this->title, 'methods' => array(array('id' => $this->code, 'title' => MODULE_SHIPPING_KANGU_TEXT_WAY_NEW . $shipping_prazo . MODULE_SHIPPING_KANGU_TEXT_WAY_NEW11, 'cost' =>$shipping_cost += ($shipping + MODULE_SHIPPING_KANGU_HANDLING))));
		}else{
		$this->quotes = array('id' => $this->code, 'module' =>$this->title, 'methods' => array(array('id' => $this->code, 'title' => MODULE_SHIPPING_KANGU_TEXT_WAY_NEW . $shipping_prazo . MODULE_SHIPPING_KANGU_TEXT_WAY_NEW1, 'cost' =>$shipping_cost += ($shipping + MODULE_SHIPPING_KANGU_HANDLING))));
		}
	}



    if ($shipping > 0)
      return $this->quotes;
    else
      return $this->quotes['error'] = MODULE_SHIPPING_KANGU_INVALID_ZONE;
 
  }
 


  function check() 
  { 
    if (!isset($this->_check)) 
    { 
      $check_query = tep_db_query("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_KANGU_STATUS'");
	  $this->_check =tep_db_num_rows($check_query);
    } 
    return $this->_check; 
  } 

  function install() 
  {

    tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Entrega via kangu (cálculo online)', 'MODULE_SHIPPING_KANGU_STATUS', 'True', 'Ativar Entrega via kangu?', '6', '0', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");

	tep_db_query("insert into " . TABLE_CONFIGURATION . " (".
				"configuration_title, configuration_key, configuration_value, ".
				"configuration_description, configuration_group_id, sort_order, ".
				"date_added".
				") values (".
				"'Texto a ser exibido para o cliente na tela de opções de entrega', 'MODULE_SHIPPING_KANGU_TEXT_TITLE_NEW', 'kangu - Correios - Sedex', ".
				"'Texto a ser exibido para o cliente na tela de opções de entrega.', '6', '1', ".
				"now())");

	tep_db_query("insert into " . TABLE_CONFIGURATION . " (".
				"configuration_title, configuration_key, configuration_value, ".
				"configuration_description, configuration_group_id, sort_order, ".
				"set_function, date_added".
				") values (".
				"'Imagem da forma de entrega', 'MODULE_SHIPPING_KANGU_IMAGE', 'images/shipping_sedex.png', ".
				"'Imagem da forma de entrega.', '6', '1', ".
				"'tep_cfg_input_field_pickupimage(', now())");

	tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Taxa de manuseio/embalagem', 'MODULE_SHIPPING_KANGU_HANDLING', '0', 'Taxa de manuseio e embalagem para esta forma de envio (opcional).', '6', '0', now())");

	tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Largura Caixa', 'MODULE_SHIPPING_KANGU_PACK_WIDTH', '', 'Se escolheu caixa este campo é obrigatório', '6', '0', now())");

	tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Altura Caixa', 'MODULE_SHIPPING_KANGU_PACK_HEIGHT', '', 'Se escolheu caixa este campo é obrigatório', '6', '0', now())");

	tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Comprimento Caixa', 'MODULE_SHIPPING_KANGU_PACK_LENGHT', '', 'Se escolheu caixa este campo é obrigatório', '6', '0', now())");
	

	tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Mensagem na tela de frete', 'MODULE_SHIPPING_KANGU_MSG', 'Prazo de Entrega: 1 a 3 dias úteis após a postagem.', 'Mensagem que será exibida na tela de seleção da forma de envio.', '6', '0', now())");

	tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Secret Token', 'MODULE_SHIPPING_KANGU_SECRETTOKEN', '', 'Secret Token.', '6', '0', now())");
		
	tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Ordem de exibição', 'MODULE_SHIPPING_KANGU_SORT_ORDER', '256', 'Determina a ordem de exibição na tela de seleção da forma de envio.', '6', '0', now())"); 
 } 

  function remove() 
  { 
    $keys = ''; 
    $keys_array = $this->keys(); 
    for ($i=0; $i<sizeof($keys_array); $i++)     
      $keys .= "'" . $keys_array[$i] . "',"; 

    $keys = substr($keys, 0, -1); 

    tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key in (" . $keys . ")"); 

  } 




  
  function calcula_frete_kangu($cep_origem, $cep_destino, $peso, $seller_id)  {
	   global $order, $cart, $_GET, $HTTP_GET_VARS;

	   // marketplace
	   if (defined('ENABLE_MARKETPLACE') && ENABLE_MARKETPLACE == 'true' && defined('STATUS_MARKETPLACE') && STATUS_MARKETPLACE == 'true') {
	   if ($seller_id != "") {
			$add_query_products_seller = ' and p.seller_member_id = "'.(int)$seller_id.'" ';
	   }
	   }
	   // marketplace eof
		
	//    $products = $cart->get_products();
	$products = $order->products;
	   for($i=0, $x=sizeof($products); $i<$x; $i++){
		    if ($products[$i]['id'] == '') {
		    	$products[$i]['id'] = $HTTP_GET_VARS['products_id'];
		    }
	   		$pack_query = tep_db_query('SELECT b.name, b.comprimento, b.altura, b.largura from '.TABLE_PRODUCTS.' p, packages b WHERE products_id="'.(int)$products[$i]['id'].'" and p.pack_id = b.pack_id ' . $add_query_products_seller);
	   		$pack_result = tep_db_fetch_array($pack_query);
			
			if ( ($products[$i]['quantity'] > 1) && ($pack_result['comprimento'] != '') && ($pack_result['altura'] != '') && ($pack_result['largura'] != '') ) {
			$comprimento += $pack_result['comprimento']*$products[$i]['quantity'];
			$altura += $pack_result['altura']*$products[$i]['quantity'];
			$largura += $pack_result['largura']*$products[$i]['quantity'];
			}else{
			$comprimento += $pack_result['comprimento'];
			$altura += $pack_result['altura'];
			$largura += $pack_result['largura'];
			}
	   }

	   if ($comprimento != '') {
	   $comprimento_ok = $comprimento;
	   }elseif ( (defined('MODULE_SHIPPING_KANGU_PACK_LENGHT')) && (MODULE_SHIPPING_KANGU_PACK_LENGHT != '') ) {
	   $comprimento_ok = MODULE_SHIPPING_KANGU_PACK_LENGHT;
	   }else{
	   $comprimento_ok = '25';
	   }
	   if ($comprimento_ok <= '16') {
	   $comprimento_ok = '25';
	   }
	   
	   if ($altura != '') {
	   $altura_ok = $altura;
	   }elseif ( (defined('MODULE_SHIPPING_KANGU_PACK_HEIGHT')) && (MODULE_SHIPPING_KANGU_PACK_HEIGHT != '') ) {
	   $altura_ok = MODULE_SHIPPING_KANGU_PACK_HEIGHT;
	   }else{
	   $altura_ok = '16';
	   }
	   if ($altura_ok <= '2') {
	   $altura_ok = '16';
	   }
	   
	   if ($largura != '') {
	   $largura_ok = $largura;
	   }elseif ( (defined('MODULE_SHIPPING_KANGU_PACK_WIDTH')) && (MODULE_SHIPPING_KANGU_PACK_WIDTH != '') ) {
	   $largura_ok = MODULE_SHIPPING_KANGU_PACK_WIDTH;
	   }else{
	   $largura_ok = '16';
	   }
	   if ($largura_ok <= '11') {
	   $largura_ok = '16';
	   }

//echo 'comprimento_ok: ' . $comprimento_ok;
//echo 'altura_ok: ' . $altura_ok;
//echo 'largura_ok: ' . $largura_ok;
//echo 'peso: ' . $peso;
	
	if ($HTTP_GET_VARS['products_id']) {
		$price_query = tep_db_query('SELECT products_price from '.TABLE_PRODUCTS.'  WHERE products_id="'.(int)$HTTP_GET_VARS['products_id'].'" ');
		$price_result = tep_db_fetch_array($price_query);			
		$valor_decalaro = number_format(tep_db_prepare_input($price_result['products_price']), 2, '.', '');
	}else{
		$valor_decalaro = $cart->show_total();
	}
	
	if ($valor_decalaro < 17) {
		$valor_decalaro = 17.00;
	}
			  
	// marketplace
	if (defined('ENABLE_MARKETPLACE') && ENABLE_MARKETPLACE == 'true' && defined('STATUS_MARKETPLACE') && STATUS_MARKETPLACE == 'true') {
		if ($valor_decalaro > 17) {
			for ($i=0, $n=sizeof($products); $i<$n; $i++) {	
				if ($products[$i]['seller_member_id'] != ""){
					$product_price_descontar_valor_declarado += $products[$i]['final_price'];
				}
			}
			$valor_decalaro = $valor_decalaro - $product_price_descontar_valor_declarado;
		}
	}
	// marketplace eof
	
	// params
	$data = array();
	$data['cepOrigem'] = $cep_origem;
	$data['cepDestino'] = $cep_destino;
	$data['origem'] = STORE_NAME;
	$data['produtos'] = array(
	array(
	'peso'=>$peso,
	'altura'=> $altura_ok,
	'largura'=> $largura_ok,
	'comprimento'=> $comprimento_ok,
	'tipo' => 'C',
	'valor' => round($valor_decalaro, 2)
	)
	);
	$data['servicos'] = array('E','X');
	$json = json_encode($data);
		// print_r(json);
	// params eof
	
	// calculate
	$ch = curl_init();

	curl_setopt($ch, CURLOPT_URL, "https://portal.kangu.com.br/tms/transporte/simular");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($ch, CURLOPT_HEADER, FALSE);
	curl_setopt($ch, CURLOPT_POST, TRUE);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
	  "Accept: application/json",
	  "token: " . MODULE_SHIPPING_KANGU_SECRETTOKEN,
	  "Content-type: application/json"
	));
	$response = curl_exec($ch);
	curl_close($ch);

//	var_dump($response);
//	die;
	// calculate eof
	
	$response_calc_kangu = json_decode($response);
	$result_calculate = objectToArray($response_calc_kangu);
	  
//	  print_r($result_calculate[0]['transp_nome']);
//	  print_r($result_calculate);
//	  die;
	  
	  if (is_array($result_calculate)){
		  if (strstr($result_calculate[0]['transp_nome'], 'Sedex')){
			$result_array['name'] = utf8_decode($result_calculate[0]['descricao']);
			$result_array['id'] = $result_calculate[0]['idTransp'];
//			$result_array['status'] = $result_calculate[0]['idTransp'];
			$result_array['price'] = $result_calculate[0]['vlrFrete'];
			$result_array['delivery_time'] = $result_calculate[0]['prazoEnt'];
		  }
	  }
	  
//	  print_r($result_array);

	// return $result_calculate['ShippingSevicesArray'][0]['ShippingPrice'];
	return $result_array;
  }
 

  function keys() 
  { 
     $keys = array('MODULE_SHIPPING_KANGU_STATUS', 'MODULE_SHIPPING_KANGU_HANDLING', 'MODULE_SHIPPING_KANGU_SECRETTOKEN', 'MODULE_SHIPPING_KANGU_PACK_WIDTH', 'MODULE_SHIPPING_KANGU_PACK_HEIGHT', 'MODULE_SHIPPING_KANGU_PACK_LENGHT', 'MODULE_SHIPPING_KANGU_MSG', 'MODULE_SHIPPING_KANGU_SORT_ORDER', 'MODULE_SHIPPING_KANGU_TEXT_TITLE_NEW', 'MODULE_SHIPPING_KANGU_IMAGE'); 

     return $keys; 
   }

   function arredonda_peso($peso)
   { 
      $tipo=gettype($peso); //armazena tipo de variável do peso

      $peso=preg_replace("/,/",".",$peso); //substitui vírgula por ponto

      settype($peso,"float"); //força o peso ser um número decimal

      if (floor($peso)<$peso)
        $peso = ceil($peso);

      settype($peso,$tipo);
        return $peso; //retorna peso com valor arredondado e com mesmo tipo informado
   } 
}
?>