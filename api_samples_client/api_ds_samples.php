<?php
  require('includes/application_top.php');

	////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	// settings
	
	$domain_url = 'https://shoptest2.mformula.info';
    $email = '';
	$token = '';
	$secret = '';
	
	////////////////////////////////////////////////////////////////////////////////////////////////////////////////	  
    // sample list product options and values

	if ($_GET['action'] == 'list_products_options_values') {
		
	$url = $domain_url . '/api_ds_products_others.php?action=list_products_options_values&products_id='.$_GET['products_id'];

	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);                                                                   
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
		'Content-Type: application/json',
		"Cache-Control: no-cache", 
		'Token: ' . base64_encode($token),
		'Secret: ' . base64_encode($secret),
		'E-mail: ' . base64_encode($email),
		'Content-Length: ' . strlen($data_string))
	);                                                                                                                    
																														 
	$result = curl_exec($ch);
	curl_close($ch);

	print_r($result);
		
	}

    // sample list product options and values eof

	////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	// sample list categories and sub-categories
	
	if ($_GET['action'] == 'categories_list') {
		
	$url = $domain_url . '/api_ds_categories.php?action=categories_list';

	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);                                                                   
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
		'Content-Type: application/json',
		"Cache-Control: no-cache", 
		'Token: ' . base64_encode($token),
		'Secret: ' . base64_encode($secret),
		'E-mail: ' . base64_encode($email))
	);
        
	$result = curl_exec($ch);
	curl_close($ch);

	print_r($result);
	
	}

	// sample list categories and sub-categories eof

	////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	// sample list orders
	
	if ($_GET['action'] == 'orders_list') {
	
	$add_query_order = '';
	if ($_GET['status'] != '') {
		$add_query_order .= '&status='.$_GET['status'];
	}else{
		$add_query_order .= '';
	}
	
	$url = $domain_url . '/api_ds_orders.php?action=orders_list'.$add_query_order;

	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);                                                                   
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
		'Content-Type: application/json',
		"Cache-Control: no-cache", 
		'Token: ' . base64_encode($token),
		'Secret: ' . base64_encode($secret),
		'E-mail: ' . base64_encode($email))
	);
        
	$result = curl_exec($ch);
	curl_close($ch);

	print_r($result);
	
	}

	// sample list orders eof

	////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	// sample list orders id
	
	if ($_GET['action'] == 'orders_id') {
	
	$add_query_order = '';
	if ($_GET['oID'] != '') {
		$add_query_order .= '&oID='.$_GET['oID'];
	}
		
	$url = $domain_url . '/api_ds_orders.php?action=orders_id'.$add_query_order;

	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);                                                                   
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
		'Content-Type: application/json',
		"Cache-Control: no-cache", 
		'Token: ' . base64_encode($token),
		'Secret: ' . base64_encode($secret),
		'E-mail: ' . base64_encode($email),
		'Content-Length: ' . strlen($data_string))
	);                                                                                                                 $result = curl_exec($ch);
	curl_close($ch);

	print_r($result);
	
	}

	// sample list orders id eof

	////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	// sample list products
	
	if ($_GET['action'] == 'list_products') {
	
	$add_query_order = '';
	if ($_GET['status'] != '') {
		$add_query_order .= '&status='.$_GET['status'];
	}
	if ($_GET['search_model'] != '') {
		$add_query_order .= '&search_model='.$_GET['search_model'];
	}
	if ($_GET['search'] != '') {
		$add_query_order .= '&search='.$_GET['search'];
	}
	if ($_GET['category'] != '') {
		$add_query_order .= '&category='.$_GET['category'];
	}
	if ($_GET['sort_order'] != '') {
		$add_query_order .= '&sort_order='.$_GET['sort_order'];
	}
	
	$url = $domain_url . '/api_ds_products_others.php?action=list_products'.$add_query_order;

	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);                                                                   
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
		'Content-Type: application/json',
		"Cache-Control: no-cache", 
		'Token: ' . base64_encode($token),
		'Secret: ' . base64_encode($secret),
		'E-mail: ' . base64_encode($email))
	);
        
	$result = curl_exec($ch);
	curl_close($ch);

	print_r($result);
	
	}

	// sample list products eof

	////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	// sample manufacturers list
	
	if ($_GET['action'] == 'manufacturers') {
	
	$url = $domain_url . '/api_ds_products_others.php?action=manufacturers';

	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);                                                                   
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
		'Content-Type: application/json',
		"Cache-Control: no-cache", 
		'Token: ' . base64_encode($token),
		'Secret: ' . base64_encode($secret),
		'E-mail: ' . base64_encode($email),
		'Content-Length: ' . strlen($data_string))
	);
        
	$result = curl_exec($ch);
	curl_close($ch);

	print_r($result);
	
	}

	// sample manufacturers list eof

	////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	// sample pack list
	
	if ($_GET['action'] == 'pack') {
	
	$url = $domain_url . '/api_ds_products_others.php?action=pack';

	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);                                                                   
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
		'Content-Type: application/json',
		"Cache-Control: no-cache", 
		'Token: ' . base64_encode($token),
		'Secret: ' . base64_encode($secret),
		'E-mail: ' . base64_encode($email),
		'Content-Length: ' . strlen($data_string))
	);
        
	$result = curl_exec($ch);
	curl_close($ch);

	print_r($result);
	
	}

	// sample pack list eof

	////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	// sample countries
	
	if ($_GET['action'] == 'countries') {
	
	$url = $domain_url . '/api_ds_products_others.php?action=countries';

	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);                                                                   
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
		'Content-Type: application/json',
		"Cache-Control: no-cache", 
		'Token: ' . base64_encode($token),
		'Secret: ' . base64_encode($secret),
		'E-mail: ' . base64_encode($email),
		'Content-Length: ' . strlen($data_string))
	);
        
	$result = curl_exec($ch);
	curl_close($ch);

	print_r($result);
	
	}

	// sample countries eof

	////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	// sample zones
	
	if ($_GET['action'] == 'zones') {
	
	$url = $domain_url . '/api_ds_products_others.php?action=zones';

	$data = array("countries_id" => $_GET['countries_id'] // Country ID (Only number is required) * FIELD REQUIRED
				  );
				  
	$data_string = json_encode($data);  

	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);                                                                   
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
		'Content-Type: application/json',
		"Cache-Control: no-cache", 
		'Token: ' . base64_encode($token),
		'Secret: ' . base64_encode($secret),
		'E-mail: ' . base64_encode($email),
		'Content-Length: ' . strlen($data_string))
	);
        
	$result = curl_exec($ch);
	curl_close($ch);

	print_r($result);

	}
	
	// sample zones eof

	////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	// sample payment_method
	
	if ($_GET['action'] == 'payment_method') {
	
	$url = $domain_url . '/api_ds_orders.php?action=payment_method&country='.$_GET['country'];
        
    $data_products[0] = array("products_id" => $_GET['products_id'], // Example: 130 (Only number is required) * FIELD REQUIRED
                              "products_quantity" => $_GET['products_quantity']  // Example: 1 (Only number is required) * FIELD REQUIRED
                             );
        
    $data_products[1] = array("products_id" => $_GET['products_id1'], // Example: 130 (Only number is required) * FIELD REQUIRED
                              "products_quantity" => $_GET['products_quantity1']  // Example: 1 (Only number is required) * FIELD REQUIRED
                             );

	$data = array("products" => $data_products  // * FIELD REQUIRED
				  );
				  
	$data_string = json_encode($data); 

	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);                                                                   
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
		'Content-Type: application/json',
		"Cache-Control: no-cache", 
		'Token: ' . base64_encode($token),
		'Secret: ' . base64_encode($secret),
		'E-mail: ' . base64_encode($email),
		'Content-Length: ' . strlen($data_string))
	);
        
	$result = curl_exec($ch);
	curl_close($ch);

	print_r($result);

	}
	
	// sample payment_method eof

	////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	// sample calculate_shipping
	
	if ($_GET['action'] == 'calculate_shipping') {
	
	$url = $domain_url . '/api_ds_orders.php?action=calculate_shipping&country='.$_GET['country'].'&post_code='.$_GET['post_code'];
        
    $data_products[0] = array("products_id" => $_GET['products_id'], // Example: 130 (Only number is required) * FIELD REQUIRED
                              "products_quantity" => $_GET['products_quantity']  // Example: 1 (Only number is required) * FIELD REQUIRED
                             );
        
    $data_products[1] = array("products_id" => $_GET['products_id1'], // Example: 130 (Only number is required) * FIELD REQUIRED
                              "products_quantity" => $_GET['products_quantity1']  // Example: 1 (Only number is required) * FIELD REQUIRED
                             );

	$data = array("products" => $data_products  // * FIELD REQUIRED
				  );        
        
	$data_string = json_encode($data);  

	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);                                                                   
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
		'Content-Type: application/json',
		"Cache-Control: no-cache", 
		'Token: ' . base64_encode($token),
		'Secret: ' . base64_encode($secret),
		'E-mail: ' . base64_encode($email),
		'Content-Length: ' . strlen($data_string))
	);
        
	$result = curl_exec($ch);
	curl_close($ch);

	print_r($result);

	}
	
	// sample calculate_shipping eof

	////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    // sample add_orders
	if ($_GET['action'] == 'add_orders') {
	
	$url = $domain_url . '/api_ds_orders.php?action=add_orders';
        
//    $data_attributes[0] = array("option_id" => "35",
//                                "value_id" => "55",
//                                "value" => utf8_encode("XS")
//								);
        
    $data_products[0] = array("products_id" => "215", // Example: 130 (Only number is required) * FIELD REQUIRED
                              "products_quantity" => "1",  // Example: 1 (Only number is required) * FIELD REQUIRED
                              "attributes" => array($data_attributes[0])
                             );
        
//    $data_attributes[1] = array("option_id" => "35",
//                                "value_id" => "37",
//                                "value" => utf8_encode("M")
//								);
        
    $data_products[1] = array("products_id" => "215", // Example: 130 (Only number is required) * FIELD REQUIRED
                              "products_quantity" => "1",  // Example: 1 (Only number is required) * FIELD REQUIRED
                              "attributes" => array($data_attributes[1])
                             );

	$data = array("products" => $data_products,  // * FIELD REQUIRED
				  "delivery_firstname" => utf8_encode("Name"), // Example: Name (Firstname) * FIELD REQUIRED
				  "delivery_lastname" => utf8_encode("Surname"), // Example: Surname (Lastname) * FIELD REQUIRED
				  "delivery_street_address" => utf8_encode("Street address"), // Example: Street address (Street Address) * FIELD REQUIRED
				  "delivery_number" => "123", // Example: 123 (Delivery Number) * FIELD REQUIRED
				  "delivery_suburb" => utf8_encode("Suburb"), // Example: Suburb (Suburb) * FIELD REQUIRED
				  "delivery_city" => utf8_encode("Sao Paulo"), // Example: Sao Paulo (City) * FIELD REQUIRED
				  "delivery_postcode" => "04267000", // Example: 04267000 (Post Code) * FIELD REQUIRED
				  "delivery_country" => utf8_encode("Brazil"), // Example: Brazil (Country) * FIELD REQUIRED
				  "delivery_state" => utf8_encode("SP"), // Example: SP (State) * FIELD REQUIRED
				  "payment_method" => "paypal_standard", // Example: paypal_standard (Payment Method) * FIELD REQUIRED
				  "shipping_method" => "sedex" // Example: sedex (Shipping Method) * FIELD REQUIRED
				  );
				  
	$data_string = json_encode($data); 
//	print_r($data_string);
//	die;

	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);                                                                   
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
		'Content-Type: application/json',
		"Cache-Control: no-cache", 
		'Token: ' . base64_encode($token),
		'Secret: ' . base64_encode($secret),
		'E-mail: ' . base64_encode($email),
		'Content-Length: ' . strlen($data_string))
	);
        
	$result = curl_exec($ch);
	curl_close($ch);

	print_r($result);

	}
    // sample add_orders eof

	////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
  require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>
