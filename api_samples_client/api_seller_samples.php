<?php
  require('includes/application_top.php');

	////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	// settings
	
//	$domain_url = 'http://sandbox.mktplace.eu';
//    $email = '';
//	$token = '';
//	$secret = '';
	
	////////////////////////////////////////////////////////////////////////////////////////////////////////////////	
  
	// sample add products
	
	if ($_GET['action'] == 'products_add') {
	
	$url = $domain_url . '/api_seller_products_add.php';

	$data = array("category" => "113", // categorie_id get from api api_categories.php (Only number is required) * FIELD REQUIRED
				  "products_quantity" => "250", // Example: 250 (Only number is required) * FIELD REQUIRED
				  "products_model" => "CK2587XL", // Example: CK2587XL (Product identification code) * FIELD REQUIRED
				  "products_price" => "200.00", // Example: 1542.56 (Do not use , "comma" only . "point" to indicate decimals) * FIELD REQUIRED
				  "products_weight" => "0.150", // Example: 0.150 (0.150 = 150 grams / Fill only with numbers and point) * FIELD REQUIRED
				  "products_stock_status" => "0", // 0 = DELIVERY_IMMEDIATE or 2 = PRODUCT_AVALIABLE_IN (Only number is required)
				  "products_stock_status_avaliable_in" => "0", // Example: 10 AVALIABLE_IN_DAYS (Only number is required)
				  "products_free_shipping" => "0", // 0 = NO or 1 = YES (Only number is required)
				  "products_image" => "http://shoptest1.mformula.info/images/AV2E-ApolloScooterAV2ELiion405.jpg", // Main picture of the full size product. Filename (eg nomedaimagem.jpg) or full url (eg http://www.nomedosite.com.br/imagens/nomedaimagem.jpg). Filename must manually upload the images and full url is automatically captured the image file and saved on the server. Recommended size: 400x400 pixels ~ 800x800 pixels / File format: JPG / Correct Example: nome_do_arquivo_copia.jpg Wrong Example: File Name Cópia.jpg (Do not use special characters, space, semicolon at the images of the file name) * FIELD REQUIRED
				  "products_name_br" => "Anel de Prata 925 com Pedras de Zirconia Borboleta", // Example: Anel de Prata 925 com Pedras de Zirconia Borboleta (Recommended full product name) / Product Name in Portuguese only * FIELD REQUIRED
				  "products_name_en" => "Silver Ring with 925 Stones Zirconia Butterfly", // Example: Silver Ring with 925 Stones Zirconia Butterfly (Recommended full product name) / Product Name in English only
				  "products_name_es" => "Anillo de Plata 925 con Piedras de Zirconia Butterfly", // Example: Anillo de Plata 925 con Piedras de Zirconia Butterfly (Recommended full product name) / Product Name in Espanol only
				  "products_name_jp" => "Silver Ring with 925 Stones Zirconia Butterfly", // Example: Silver Ring with 925 Stones Zirconia Butterfly (Recommended full product name) / Product Name in Japanese only
				  "seller_country_shipping_id" => 30, // Example: 30
				  "seller_zone_shipping_id" => 464, // Example: 464
				  "products_description_br" => "Descrição completa do produto em português", // Product description in Portuguese
				  "products_description_en" => "Product description in English", // Product description in English
				  "products_description_es" => "Descripción del producto en español", // Product description in Espanol
				  "products_description_jp" => "Product description in Japanese" // Product description in Japanese
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
	
	// sample add products eof

	////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	// sample edit products
	
	if ($_GET['action'] == 'update_products') {
	
	$url = $domain_url . '/api_seller_products_edit.php?action=update_products';

	$data = array("products_id" => "432", // Product ID (Only number is required) * FIELD REQUIRED
		          "category" => "113", // categorie_id get from api api_categories.php (Only number is required) * FIELD REQUIRED
				  "products_quantity" => "250", // Example: 250 (Only number is required) * FIELD REQUIRED
				  "products_model" => "CK2587XL", // Example: CK2587XL (Product identification code) * FIELD REQUIRED
				  "products_price" => "200.00", // Example: 1542.56 (Do not use , "comma" only . "point" to indicate decimals) * FIELD REQUIRED
				  "products_weight" => "0.150", // Example: 0.150 (0.150 = 150 grams / Fill only with numbers and point) * FIELD REQUIRED
				  "products_stock_status" => "0", // 0 = DELIVERY_IMMEDIATE or 2 = PRODUCT_AVALIABLE_IN (Only number is required)
				  "products_stock_status_avaliable_in" => "0", // Example: 10 AVALIABLE_IN_DAYS (Only number is required)
				  "products_free_shipping" => "0", // 0 = NO or 1 = YES (Only number is required)
				  "products_image" => "http://shoptest1.mformula.info/images/AV2E-ApolloScooterAV2ELiion405.jpg", // Main picture of the full size product. Filename (eg nomedaimagem.jpg) or full url (eg http://www.nomedosite.com.br/imagens/nomedaimagem.jpg). Filename must manually upload the images and full url is automatically captured the image file and saved on the server. Recommended size: 400x400 pixels ~ 800x800 pixels / File format: JPG / Correct Example: nome_do_arquivo_copia.jpg Wrong Example: File Name Cópia.jpg (Do not use special characters, space, semicolon at the images of the file name) * FIELD REQUIRED
				  "products_name_br" => "Anel de Prata 925 com Pedras de Zirconia Borboleta", // Example: Anel de Prata 925 com Pedras de Zirconia Borboleta (Recommended full product name) / Product Name in Portuguese only * FIELD REQUIRED
				  "products_name_en" => "Silver Ring with 925 Stones Zirconia Butterfly", // Example: Silver Ring with 925 Stones Zirconia Butterfly (Recommended full product name) / Product Name in English only
				  "products_name_es" => "Anillo de Plata 925 con Piedras de Zirconia Butterfly", // Example: Anillo de Plata 925 con Piedras de Zirconia Butterfly (Recommended full product name) / Product Name in Espanol only
				  "products_name_jp" => "Silver Ring with 925 Stones Zirconia Butterfly", // Example: Silver Ring with 925 Stones Zirconia Butterfly (Recommended full product name) / Product Name in Japanese only
				  "seller_country_shipping_id" => 30, // Example: 30
				  "seller_zone_shipping_id" => 464, // Example: 464
				  "products_description_br" => "Descrição completa do produto em português", // Product description in Portuguese
				  "products_description_en" => "Product description in English", // Product description in English
				  "products_description_es" => "Descripción del producto en español", // Product description in Espanol
				  "products_description_jp" => "Product description in Japanese" // Product description in Japanese
				  );
				  
	$data_string = json_encode($data);  
//	 print_r($data_string);
//	 die;

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
	
	// sample edit products eof

	////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    // sample list product options and values

	if ($_GET['action'] == 'list_products_options_values') {
		
	$url = $domain_url . '/api_seller_products_others.php?action=list_products_options_values&products_id='.$_GET['products_id'];

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

    // add list product options and values
	if ($_GET['action'] == 'add_products_options_values') {
		
	$url = $domain_url . '/api_seller_products_others.php?action=add_products_options_values';
		
	$data_options_values[0] = array("products_options_values_id" => "35"
								   );
	$data_options_values[1] = array("products_options_values_id" => "30"
								   );
	$data_options[0] = array("products_options_id" => "4",
							 "products_options_values" => $data_options_values
							);

	$data = array("products_id" => "430", // Product ID (Only number is required) * FIELD REQUIRED
				  "products_options" => $data_options
				  );
				  
	$data_string = json_encode($data);  
// 	print_r($data_string);
// 	die;

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
    // add list product options and values eof

	////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	// sample edit products quantity
	
	if ($_GET['action'] == 'update_products_quantity') {
	
	$url = $domain_url . '/api_seller_products_edit.php?action=update_products_quantity';

	$data = array("products_id" => "432", // Product ID (Only number is required) * FIELD REQUIRED
				  "products_quantity" => "350" // Example: 250 (Only number is required) * FIELD REQUIRED
				  );
				  
	$data_string = json_encode($data);  
//	 print_r($data_string);
//	 die;

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
	
	// sample edit products quantity eof

	////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	// sample edit products price
	
	if ($_GET['action'] == 'update_products_price') {
	
	$url = $domain_url . '/api_seller_products_edit.php?action=update_products_price';

	$data = array("products_id" => "432", // Product ID (Only number is required) * FIELD REQUIRED
				  "products_price" => "150.56" // Example: 1542.56 (Do not use , "comma" only . "point" to indicate decimals) * FIELD REQUIRED
				  );
				  
	$data_string = json_encode($data); 
// 	 print_r($data_string);
// 	 die;

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
	
	// sample edit products price eof

	////////////////////////////////////////////////////////////////////////////////////////////////////////////////


	// sample list categories and sub-categories
	
	if ($_GET['action'] == 'categories_list') {
		
	$url = $domain_url . '/api_seller_categories.php?action=categories_list';

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
	
	$url = $domain_url . '/api_seller_orders.php?action=orders_list'.$add_query_order;

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
		
	$url = $domain_url . '/api_seller_orders.php?action=orders_id'.$add_query_order;

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

	// sample list orders id eof

	////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	// sample list orders status
	
	if ($_GET['action'] == 'orders_status') {
	
	$url = $domain_url . '/api_seller_orders.php?action=orders_status';

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

	// sample list orders status eof

	////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	// sample edit orders
	
	if ($_GET['action'] == 'update_orders') {
	
	$url = $domain_url . '/api_seller_orders.php?action=update_orders';

	$data = array("oID" => $_GET['oID'], // Order ID (Only number is required) * FIELD REQUIRED
				  "product_id" => $_GET['pID'], // The the product_id (Only number is required) * FIELD REQUIRED
				  "Tracking_Id" => $_GET['tID'] // The tracking id
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
	
	// sample edit orders eof

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
	
	$url = $domain_url . '/api_seller_products_others.php?action=list_products'.$add_query_order;

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

	// sample list products contacts
	
	if ($_GET['action'] == 'list_products_contacts') {
	
	$url = $domain_url . '/api_seller_products_others.php?action=list_products_contacts';

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

	// sample list products contacts eof

	////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	// sample edit products contacts
	
	if ($_GET['action'] == 'update_products_contacts') {
	
	$url = $domain_url . '/api_seller_products_others.php?action=update_products_contacts';

	$data = array("pc_id" => $_GET['pc_id'], // PC ID (Only number is required) * FIELD REQUIRED
				  "answer" => $_GET['answer'] // The answer
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
	
	// sample edit products contacts eof

	////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	// sample add product specials
	
	if ($_GET['action'] == 'add_product_specials') {
	
	$url = $domain_url . '/api_seller_products_others.php?action=add_product_specials';

	$data = array("products_id" => $_GET['products_id'], // Products ID (Only number is required) * FIELD REQUIRED
				  "specials_price" => $_GET['specials_price'], // Special Price (Example: 20 or 20%) * FIELD REQUIRED
				  "total_days" => $_GET['total_days'] // Total Days. 5, 10, 15, 20, 25 or 30 (Only number is required) * FIELD REQUIRED
				  );
				  
	$data_string = json_encode($data);  
// 	print_r($data_string);
// 	die;

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
	
	// sample add product specials eof

	////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	// sample add product featured
	
	if ($_GET['action'] == 'add_product_featured') {
	
	$url = $domain_url . '/api_seller_products_others.php?action=add_product_featured';

	$data = array("products_id" => $_GET['products_id'], // Products ID (Only number is required) * FIELD REQUIRED
				  "total_days" => $_GET['total_days'] // Total Days. 5, 10, 15, 20, 25 or 30 (Only number is required) * FIELD REQUIRED
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
	
	// sample add product featured eof

	////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	// sample delete product specials
	
	if ($_GET['action'] == 'delete_product_specials') {
	
	$url = $domain_url . '/api_seller_products_others.php?action=delete_product_specials';

	$data = array("products_id" => $_GET['products_id'] // Products ID (Only number is required) * FIELD REQUIRED
				  );
				  
	$data_string = json_encode($data);  
// 	print_r($data_string);
// 	die;

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
	
	// sample delete product specials eof

	////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	// sample delete product featured
	
	if ($_GET['action'] == 'delete_product_featured') {
	
	$url = $domain_url . '/api_seller_products_others.php?action=delete_product_featured';

	$data = array("products_id" => $_GET['products_id'] // Products ID (Only number is required) * FIELD REQUIRED
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
	
	// sample delete product featured eof

	////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	// sample manufacturers list
	
	if ($_GET['action'] == 'manufacturers') {
	
	$url = $domain_url . '/api_seller_products_others.php?action=manufacturers';

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
	
	$url = $domain_url . '/api_seller_products_others.php?action=pack';

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
	
	$url = $domain_url . '/api_seller_products_others.php?action=countries';

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
	
	$url = $domain_url . '/api_seller_products_others.php?action=zones';

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
	
  require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>
