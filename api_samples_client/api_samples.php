<?php
  require('includes/application_top.php');

	////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	// settings
	
	$domain_url = 'http://shop.demoweb.ws';
	$usuario1 = 'teste';
	$senha1 = 'teste';
	
	////////////////////////////////////////////////////////////////////////////////////////////////////////////////	
  
	// sample add products
	
	if ($_GET['action'] == 'products_add') {
	
	$url = $domain_url . '/api_products_add.php';

	$data = array("products_status" => "1", // 1 = AVAILABLE or 0 = NOT AVAILABLE or 2 = PENDING (Only number is required) * FIELD REQUIRED
				  "products_model" => "CK2587XL", // Example: CK2587XL (Product identification code) * FIELD REQUIRED
				  "products_quantity" => "250", // Example: 250 (Only number is required) * FIELD REQUIRED
				  "categoria" => "162", // categorie_id get from api api_categories.php (Only number is required) * FIELD REQUIRED
				  "products_name_br" => "Anel de Prata 925 com Pedras de Zirconia Borboleta", // Example: Anel de Prata 925 com Pedras de Zirconia Borboleta (Recommended full product name) / Product Name in Portuguese only * FIELD REQUIRED
				  "products_name_en" => "Silver Ring with 925 Stones Zirconia Butterfly", // Example: Silver Ring with 925 Stones Zirconia Butterfly (Recommended full product name) / Product Name in English only
				  "products_name_es" => "Anillo de Plata 925 con Piedras de Zirconia Butterfly", // Example: Anillo de Plata 925 con Piedras de Zirconia Butterfly (Recommended full product name) / Product Name in Espanol only
				  "products_name_jp" => "Silver Ring with 925 Stones Zirconia Butterfly", // Example: Silver Ring with 925 Stones Zirconia Butterfly (Recommended full product name) / Product Name in Japanese only
				  "products_description_br" => "Descrição completa do produto em português", // Product description in Portuguese
				  "products_description_en" => "Product description in English", // Product description in English
				  "products_description_es" => "Descripción del producto en español", // Product description in Espanol
				  "products_description_jp" => "Product description in Japanese", // Product description in Japanese
				  "products_image" => "http://shop1.demoweb.ws/images/1061000_4Sm.jpg", // Main picture of the full size product. Filename (eg nomedaimagem.jpg) or full url (eg http://www.nomedosite.com.br/imagens/nomedaimagem.jpg). Filename must manually upload the images and full url is automatically captured the image file and saved on the server. Recommended size: 400x400 pixels ~ 800x800 pixels / File format: JPG / Correct Example: nome_do_arquivo_copia.jpg Wrong Example: File Name Cópia.jpg (Do not use special characters, space, semicolon at the images of the file name) * FIELD REQUIRED
				  "products_price" => "1542.56", // Example: 1542.56 (Do not use , "comma" only . "point" to indicate decimals) * FIELD REQUIRED
				  "seller_country_shipping_id" => 30, // Example: 30
				  "seller_zone_shipping_id" => 464, // Example: 464
				  "products_weight" => "0.150" // Example: 0.150 (0.150 = 150 grams / Fill only with numbers and point) * FIELD REQUIRED
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
		'Usuario1: ' . base64_encode($usuario1),
		'Senha1: ' . base64_encode($senha1),
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
	
	$url = $domain_url . '/api_products_edit.php?action=update_products';

	$data = array("products_id" => "442", // Product ID (Only number is required) * FIELD REQUIRED
				  "products_status" => "1", // 1 = AVAILABLE or 0 = NOT AVAILABLE or 2 = PENDING (Only number is required) * FIELD REQUIRED
				  "products_model" => "CK2587XL", // Example: CK2587XL (Product identification code) * FIELD REQUIRED
				  "products_quantity" => "250", // Example: 250 (Only number is required) * FIELD REQUIRED
				  "products_name_br" => "Anel de Prata 925 com Pedras de Zirconia Borboleta", // Example: Anel de Prata 925 com Pedras de Zirconia Borboleta (Recommended full product name) / Product Name in Portuguese only * FIELD REQUIRED
				  "products_name_en" => "Silver Ring with 925 Stones Zirconia Butterfly", // Example: Silver Ring with 925 Stones Zirconia Butterfly (Recommended full product name) / Product Name in English only
				  "products_name_es" => "Anillo de Plata 925 con Piedras de Zirconia Butterfly", // Example: Anillo de Plata 925 con Piedras de Zirconia Butterfly (Recommended full product name) / Product Name in Espanol only
				  "products_name_jp" => "Silver Ring with 925 Stones Zirconia Butterfly", // Example: Silver Ring with 925 Stones Zirconia Butterfly (Recommended full product name) / Product Name in Japanese only
				  "products_description_br" => "Descrição completa do produto em português", // Product description in Portuguese
				  "products_description_en" => "Product description in English", // Product description in English
				  "products_description_es" => "Descripción del producto en español", // Product description in Espanol
				  "products_description_jp" => "Product description in Japanese", // Product description in Japanese
				  "products_image" => "http://shop1.demoweb.ws/images/1061000_4Sm.jpg", // Main picture of the full size product. Filename (eg nomedaimagem.jpg) or full url (eg http://www.nomedosite.com.br/imagens/nomedaimagem.jpg). Filename must manually upload the images and full url is automatically captured the image file and saved on the server. Recommended size: 400x400 pixels ~ 800x800 pixels / File format: JPG / Correct Example: nome_do_arquivo_copia.jpg Wrong Example: File Name Cópia.jpg (Do not use special characters, space, semicolon at the images of the file name) * FIELD REQUIRED
				  "products_price" => "1542.56", // Example: 1542.56 (Do not use , "comma" only . "point" to indicate decimals) * FIELD REQUIRED
				  "seller_country_shipping_id" => 30, // Example: 30
				  "seller_zone_shipping_id" => 464, // Example: 464
				  "products_weight" => "0.150" // Example: 0.150 (0.150 = 150 grams / Fill only with numbers and point) * FIELD REQUIRED
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
		'Usuario1: ' . base64_encode($usuario1),
		'Senha1: ' . base64_encode($senha1),
		'Content-Length: ' . strlen($data_string))                                                                       
	);                                                                                                                   
																														 
	$result = curl_exec($ch);
	curl_close($ch);

	print_r($result);

	}
	
	// sample edit products eof

	////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	// sample edit products quantity
	
	if ($_GET['action'] == 'update_products_quantity') {
	
	$url = $domain_url . '/api_products_edit.php?action=update_products_quantity';

	$data = array("products_id" => "442", // Product ID (Only number is required) * FIELD REQUIRED
				  "products_quantity" => "250" // Example: 250 (Only number is required) * FIELD REQUIRED
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
		'Usuario1: ' . base64_encode($usuario1),
		'Senha1: ' . base64_encode($senha1),
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
	
	$url = $domain_url . '/api_products_edit.php?action=update_products_price';

	$data = array("products_id" => "442", // Product ID (Only number is required) * FIELD REQUIRED
				  "products_price" => "1542.56" // Example: 1542.56 (Do not use , "comma" only . "point" to indicate decimals) * FIELD REQUIRED
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
		'Usuario1: ' . base64_encode($usuario1),
		'Senha1: ' . base64_encode($senha1),
		'Content-Length: ' . strlen($data_string))                                                                       
	);                                                                                                                   
																														 
	$result = curl_exec($ch);
	curl_close($ch);

	print_r($result);

	}
	
	// sample edit products price eof

	////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	// sample manufacturers list
	
	if ($_GET['action'] == 'manufacturers') {
	
	$url = $domain_url . '/api_products_others.php?action=manufacturers';

	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);                                                                   
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
		'Content-Type: application/json',
		"Cache-Control: no-cache", 
		'Usuario1: ' . base64_encode($usuario1),
		'Senha1: ' . base64_encode($senha1))                                                                       
	);                                                                                                                   
																														 
	$result = curl_exec($ch);
	curl_close($ch);

	print_r($result);
	
	}

	// sample manufacturers list eof

	////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	// sample filter1 list
	
	if ($_GET['action'] == 'filter1') {
	
	$url = $domain_url . '/api_products_others.php?action=filter1';

	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);                                                                   
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
		'Content-Type: application/json',
		"Cache-Control: no-cache", 
		'Usuario1: ' . base64_encode($usuario1),
		'Senha1: ' . base64_encode($senha1))                                                                       
	);                                                                                                                   
																														 
	$result = curl_exec($ch);
	curl_close($ch);

	print_r($result);
	
	}

	// sample filter1 list eof

	////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	// sample uv list
	
	if ($_GET['action'] == 'uv') {
	
	$url = $domain_url . '/api_products_others.php?&action=uv';

	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);                                                                   
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
		'Content-Type: application/json',
		"Cache-Control: no-cache", 
		'Usuario1: ' . base64_encode($usuario1),
		'Senha1: ' . base64_encode($senha1))                                                                       
	);                                                                                                                   
																														 
	$result = curl_exec($ch);
	curl_close($ch);

	print_r($result);
	
	}

	// sample uv list eof

	////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	// sample pack list
	
	if ($_GET['action'] == 'pack') {
	
	$url = $domain_url . '/api_products_others.php?action=pack';

	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);                                                                   
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
		'Content-Type: application/json',
		"Cache-Control: no-cache", 
		'Usuario1: ' . base64_encode($usuario1),
		'Senha1: ' . base64_encode($senha1))                                                                       
	);                                                                                                                   
																														 
	$result = curl_exec($ch);
	curl_close($ch);

	print_r($result);
	
	}

	// sample pack list eof

	////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	// sample ncm list
	
	if ($_GET['action'] == 'ncm') {
	
	$url = $domain_url . '/api_products_others.php?action=ncm';

	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);                                                                   
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
		'Content-Type: application/json',
		"Cache-Control: no-cache", 
		'Usuario1: ' . base64_encode($usuario1),
		'Senha1: ' . base64_encode($senha1))                                                                       
	);                                                                                                                   
																														 
	$result = curl_exec($ch);
	curl_close($ch);

	print_r($result);
	
	}

	// sample ncm list eof

	////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	// sample cfop list
	
	if ($_GET['action'] == 'cfop') {
	
	$url = $domain_url . '/api_products_others.php?action=cfop';

	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);                                                                   
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
		'Content-Type: application/json',
		"Cache-Control: no-cache", 
		'Usuario1: ' . base64_encode($usuario1),
		'Senha1: ' . base64_encode($senha1))                                                                       
	);                                                                                                                   
																														 
	$result = curl_exec($ch);
	curl_close($ch);

	print_r($result);
	
	}

	// sample cfop list eof

	////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	// sample cst list
	
	if ($_GET['action'] == 'cst') {
	
	$url = $domain_url . '/api_products_others.php?action=cst';

	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);                                                                   
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
		'Content-Type: application/json',
		"Cache-Control: no-cache", 
		'Usuario1: ' . base64_encode($usuario1),
		'Senha1: ' . base64_encode($senha1))                                                                       
	);                                                                                                                   
																														 
	$result = curl_exec($ch);
	curl_close($ch);

	print_r($result);
	
	}

	// sample cst list eof

	////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	// sample origem list
	
	if ($_GET['action'] == 'origem') {
	
	$url = $domain_url . '/api_products_others.php?action=origem';

	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);                                                                   
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
		'Content-Type: application/json',
		"Cache-Control: no-cache", 
		'Usuario1: ' . base64_encode($usuario1),
		'Senha1: ' . base64_encode($senha1))                                                                       
	);                                                                                                                   
																														 
	$result = curl_exec($ch);
	curl_close($ch);

	print_r($result);
	
	}

	// sample origem list eof

	////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	// sample suppliers list
	
	if ($_GET['action'] == 'suppliers') {
	
	$url = $domain_url . '/api_products_others.php?action=suppliers';

	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);                                                                   
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
		'Content-Type: application/json',
		"Cache-Control: no-cache", 
		'Usuario1: ' . base64_encode($usuario1),
		'Senha1: ' . base64_encode($senha1))                                                                       
	);                                                                                                                   
																														 
	$result = curl_exec($ch);
	curl_close($ch);

	print_r($result);
	
	}

	// sample suppliers list eof

	////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	// sample add manufacturers
	
	if ($_GET['action'] == 'add_manufacturers') {
	
	$url = $domain_url . '/api_products_others.php?action=add_manufacturers';

	$data = array("manufacturers_name" => "Main name of manufacturer", // Main name of manufacturer * FIELD REQUIRED
				  "manufacturers_banner_status" => "1", // 1 = ACTIVE or 0 = INACTIVE (Only number is required) * FIELD REQUIRED
				  "manufacturers_description" => "Full description of manufacturer", // Full description of manufacturer
				  "manufacturers_url" => "URL link of manufacturer" // URL link of manufacturer Example: http://www.sitename.com
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
		'Usuario1: ' . base64_encode($usuario1),
		'Senha1: ' . base64_encode($senha1),
		'Content-Length: ' . strlen($data_string))                                                                       
	);                                                                                                                   
																														 
	$result = curl_exec($ch);
	curl_close($ch);

	print_r($result);

	}
	
	// sample add manufacturers eof

	////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	// sample edit manufacturers
	
	if ($_GET['action'] == 'edit_manufacturers') {
	
	$url = $domain_url . '/api_products_others.php?action=edit_manufacturers';

	$data = array("manufacturers_id" => "", // ID number of manufacturer * FIELD REQUIRED
				  "manufacturers_name" => "Main name of manufacturer", // Main name of manufacturer * FIELD REQUIRED
				  "manufacturers_banner_status" => "1", // 1 = ACTIVE or 0 = INACTIVE (Only number is required) * FIELD REQUIRED
				  "manufacturers_description" => "Full description of manufacturer", // Full description of manufacturer
				  "manufacturers_url" => "URL link of manufacturer" // URL link of manufacturer Example: http://www.sitename.com
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
		'Usuario1: ' . base64_encode($usuario1),
		'Senha1: ' . base64_encode($senha1),
		'Content-Length: ' . strlen($data_string))                                                                       
	);                                                                                                                   
																														 
	$result = curl_exec($ch);
	curl_close($ch);

	print_r($result);

	}
	
	// sample edit manufacturers eof

	////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	// sample add uv
	
	if ($_GET['action'] == 'add_uv') {
	
	$url = $domain_url . '/api_products_others.php?action=add_uv';

	$data = array("uv_name_text" => "Main name of unity of sale" // Main name of unity of sale * FIELD REQUIRED
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
		'Usuario1: ' . base64_encode($usuario1),
		'Senha1: ' . base64_encode($senha1),
		'Content-Length: ' . strlen($data_string))                                                                       
	);                                                                                                                   
																														 
	$result = curl_exec($ch);
	curl_close($ch);

	print_r($result);

	}
	
	// sample add uv eof

	////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	// sample edit uv
	
	if ($_GET['action'] == 'edit_uv') {
	
	$url = $domain_url . '/api_products_others.php?action=edit_uv';

	$data = array("uv_id" => "ID of unity of sale", // ID of unity of sale * FIELD REQUIRED
				  "uv_name_text" => "Main name of unity of sale" // Main name of unity of sale * FIELD REQUIRED
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
		'Usuario1: ' . base64_encode($usuario1),
		'Senha1: ' . base64_encode($senha1),
		'Content-Length: ' . strlen($data_string))                                                                       
	);                                                                                                                   
																														 
	$result = curl_exec($ch);
	curl_close($ch);

	print_r($result);

	}
	
	// sample edit uv eof

	////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	// sample add packages
	
	if ($_GET['action'] == 'add_pack') {
	
	$url = $domain_url . '/api_products_others.php?action=add_pack';

	$data = array("name" => "Main name of pack", // Main name of pack * FIELD REQUIRED
				  "comprimento" => "Length of pack", // Length of pack * FIELD REQUIRED
				  "altura" => "Height of pack", // Height of pack * FIELD REQUIRED
				  "largura" => "Width of pack" // Width of pack * FIELD REQUIRED
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
		'Usuario1: ' . base64_encode($usuario1),
		'Senha1: ' . base64_encode($senha1),
		'Content-Length: ' . strlen($data_string))                                                                       
	);                                                                                                                   
																														 
	$result = curl_exec($ch);
	curl_close($ch);

	print_r($result);

	}
	
	// sample add packages eof

	////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	// sample edit packages
	
	if ($_GET['action'] == 'edit_pack') {
	
	$url = $domain_url . '/api_products_others.php?action=edit_pack';

	$data = array("pack_id" => "ID of pack", // ID of pack * FIELD REQUIRED
				  "name" => "Main name of pack", // Main name of pack * FIELD REQUIRED
				  "comprimento" => "Length of pack", // Length of pack * FIELD REQUIRED
				  "altura" => "Height of pack", // Height of pack * FIELD REQUIRED
				  "largura" => "Width of pack" // Width of pack * FIELD REQUIRED
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
		'Usuario1: ' . base64_encode($usuario1),
		'Senha1: ' . base64_encode($senha1),
		'Content-Length: ' . strlen($data_string))                                                                       
	);                                                                                                                   
																														 
	$result = curl_exec($ch);
	curl_close($ch);

	print_r($result);

	}
	
	// sample edit packages eof

	////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	// sample add ncm
	
	if ($_GET['action'] == 'add_ncm') {
	
	$url = $domain_url . '/api_products_others.php?action=add_ncm';

	$data = array("ncm_name_text" => "Main name of ncm", // Main name of ncm * FIELD REQUIRED
				  "ncm_code" => "Code of ncm" // Code of ncm * FIELD REQUIRED
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
		'Usuario1: ' . base64_encode($usuario1),
		'Senha1: ' . base64_encode($senha1),
		'Content-Length: ' . strlen($data_string))                                                                       
	);                                                                                                                   
																														 
	$result = curl_exec($ch);
	curl_close($ch);

	print_r($result);

	}
	
	// sample add ncm eof

	////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	// sample edit ncm
	
	if ($_GET['action'] == 'edit_ncm') {
	
	$url = $domain_url . '/api_products_others.php?action=edit_ncm';

	$data = array("ncm_id" => "ID of ncm", // ID of ncm * FIELD REQUIRED
				  "ncm_name_text" => "Main name of ncm", // Main name of ncm * FIELD REQUIRED
				  "ncm_code" => "Code of ncm" // Code of ncm * FIELD REQUIRED
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
		'Usuario1: ' . base64_encode($usuario1),
		'Senha1: ' . base64_encode($senha1),
		'Content-Length: ' . strlen($data_string))                                                                       
	);                                                                                                                   
																														 
	$result = curl_exec($ch);
	curl_close($ch);

	print_r($result);

	}
	
	// sample edit ncm eof

	////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	// sample add cfop
	
	if ($_GET['action'] == 'add_cfop') {
	
	$url = $domain_url . '/api_products_others.php?action=add_cfop';

	$data = array("cfop_name_text" => "Main name of cfop", // Main name of cfop * FIELD REQUIRED
				  "cfop_code" => "Code of cfop" // Code of cfop * FIELD REQUIRED
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
		'Usuario1: ' . base64_encode($usuario1),
		'Senha1: ' . base64_encode($senha1),
		'Content-Length: ' . strlen($data_string))                                                                       
	);                                                                                                                   
																														 
	$result = curl_exec($ch);
	curl_close($ch);

	print_r($result);

	}
	
	// sample add cfop eof

	////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	// sample edit cfop
	
	if ($_GET['action'] == 'edit_cfop') {
	
	$url = $domain_url . '/api_products_others.php?action=edit_cfop';

	$data = array("cfop_id" => "ID of cfop", // ID of cfop * FIELD REQUIRED
				  "cfop_name_text" => "Main name of cfop", // Main name of cfop * FIELD REQUIRED
				  "cfop_code" => "Code of cfop" // Code of cfop * FIELD REQUIRED
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
		'Usuario1: ' . base64_encode($usuario1),
		'Senha1: ' . base64_encode($senha1),
		'Content-Length: ' . strlen($data_string))                                                                       
	);                                                                                                                   
																														 
	$result = curl_exec($ch);
	curl_close($ch);

	print_r($result);

	}
	
	// sample edit cfop eof

	////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	// sample add suppliers
	
	if ($_GET['action'] == 'add_suppliers') {
	
	$url = $domain_url . '/api_products_others.php?action=add_suppliers';

	$data = array("suppliers_group_name" => "Main name of suppliers", // Main name of suppliers * FIELD REQUIRED
				  "suppliers_description" => "Description of suppliers" // Description of suppliers * FIELD REQUIRED
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
		'Usuario1: ' . base64_encode($usuario1),
		'Senha1: ' . base64_encode($senha1),
		'Content-Length: ' . strlen($data_string))                                                                       
	);                                                                                                                   
																														 
	$result = curl_exec($ch);
	curl_close($ch);

	print_r($result);

	}
	
	// sample add suppliers eof

	////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	// sample edit suppliers
	
	if ($_GET['action'] == 'edit_suppliers') {
	
	$url = $domain_url . '/api_products_others.php?action=edit_suppliers';

	$data = array("suppliers_id" => "ID of suppliers", // ID of suppliers * FIELD REQUIRED
				  "suppliers_group_name" => "Main name of suppliers", // Main name of suppliers * FIELD REQUIRED
				  "suppliers_description" => "Description of suppliers" // Description of suppliers * FIELD REQUIRED
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
		'Usuario1: ' . base64_encode($usuario1),
		'Senha1: ' . base64_encode($senha1),
		'Content-Length: ' . strlen($data_string))                                                                       
	);                                                                                                                   
																														 
	$result = curl_exec($ch);
	curl_close($ch);

	print_r($result);

	}
	
	// sample edit suppliers eof

	////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	// sample list categories and sub-categories
	
	if ($_GET['action'] == 'categories_list') {
	
	$url = $domain_url . '/api_categories.php?action=categories_list';

	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);                                                                   
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
		'Content-Type: application/json',
		"Cache-Control: no-cache", 
		'Usuario1: ' . base64_encode($usuario1),
		'Senha1: ' . base64_encode($senha1))                                                                       
	);                                                                                                                   
																														 
	$result = curl_exec($ch);
	curl_close($ch);

	print_r($result);
	
	}

	// sample list categories and sub-categories eof

	////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	// sample add categories and sub-categories
	
	if ($_GET['action'] == 'add_categories') {
	
	$url = $domain_url . '/api_categories.php?action=add_categories';

	$data = array("categories_name" => "Categorie or Sub-Categorie Name", // Categorie or Sub-Categorie Name * FIELD REQUIRED
				  "categories_status" => "1", // 1 = ACTIVE or 0 = INACTIVE (Only number is required) * FIELD REQUIRED
				  "main_category" => "0", // Main Category of Sub-Category (Only number is required) * FIELD REQUIRED
				  "sort_order" => "", // Sort Order (Only number is required)
				  "meta_title" => "Meta Title", // Meta Title
				  "meta_description" => "Meta Description", // Meta Description
				  "meta_keywords" => "Meta Keywords"
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
		'Usuario1: ' . base64_encode($usuario1),
		'Senha1: ' . base64_encode($senha1),
		'Content-Length: ' . strlen($data_string))                                                                       
	);                                                                                                                   
																														 
	$result = curl_exec($ch);
	curl_close($ch);

	print_r($result);

	}
	
	// sample add categories and sub-categories eof

	////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	// sample edit categories and sub-categories
	
	if ($_GET['action'] == 'edit_categories') {
	
	$url = $domain_url . '/api_categories.php?action=edit_categories';

	$data = array("categories_id" => "182", // Categorie or Sub-Categorie ID (Only number is required) * FIELD REQUIRED
				  "categories_name" => "Categorie or Sub-Categorie Name", // Categorie or Sub-Categorie Name * FIELD REQUIRED
				  "categories_status" => "1", // 1 = ACTIVE or 0 = INACTIVE (Only number is required) * FIELD REQUIRED
				  "sort_order" => "", // Sort Order (Only number is required)
				  "meta_title" => "Meta Title", // Meta Title
				  "meta_description" => "Meta Description", // Meta Description
				  "meta_keywords" => "Meta Keywords"
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
		'Usuario1: ' . base64_encode($usuario1),
		'Senha1: ' . base64_encode($senha1),
		'Content-Length: ' . strlen($data_string))                                                                       
	);                                                                                                                   
																														 
	$result = curl_exec($ch);
	curl_close($ch);

	print_r($result);

	}
	
	// sample edit categories and sub-categories eof

	////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	// sample edit status categories and sub-categories
	
	if ($_GET['action'] == 'edit_status_categories') {
	
	$url = $domain_url . '/api_categories.php?action=edit_status_categories';

	$data = array("categories_id" => "182", // Categorie or Sub-Categorie ID (Only number is required) * FIELD REQUIRED
				  "categories_status" => "1" // 1 = ACTIVE or 0 = INACTIVE (Only number is required) * FIELD REQUIRED
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
		'Usuario1: ' . base64_encode($usuario1),
		'Senha1: ' . base64_encode($senha1),
		'Content-Length: ' . strlen($data_string))                                                                       
	);                                                                                                                   
																														 
	$result = curl_exec($ch);
	curl_close($ch);

	print_r($result);

	}
	
	// sample edit status categories and sub-categories eof

	////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	// sample list orders
	
	if ($_GET['action'] == 'orders_list') {
	
	$add_query_order = '';
	$cID = '';
	if ($cID != '') {
		$add_query_order .= '&cID='.$cID;
	}
	$postalcode = '';
	if ($postalcode != '') {
		$add_query_order .= '&postalcode='.$postalcode;
	}
	$cName = '';
	if ($cName != '') {
		$add_query_order .= '&cName='.$cName;
	}
	$email = '';
	if ($email != '') {
		$add_query_order .= '&email='.$email;
	}
	$status = '';
	if ($status != '') {
		$add_query_order .= '&status='.$status;
	}
	$payment = '';
	if ($payment != '') {
		$add_query_order .= '&payment='.$payment;
	}
	$assinatura_recorrente = '';
	if ($assinatura_recorrente != '') {
		$add_query_order .= '&assinatura_recorrente='.$assinatura_recorrente;
	}
	$cancel_assinatura_recorrente = '';
	if ($cancel_assinatura_recorrente != '') {
		$add_query_order .= '&cancel_assinatura_recorrente='.$cancel_assinatura_recorrente;
	}
	$date_from = '';
	if ($date_from != '') {
		$add_query_order .= '&date_from='.$date_from;
	}	
	$date_to = '';
	if ($date_to != '') {
		$add_query_order .= '&date_to='.$date_to;
	}	
	
	$url = $domain_url . '/api_orders.php?action=orders_list'.$add_query_order;

	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);                                                                   
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
		'Content-Type: application/json',
		"Cache-Control: no-cache", 
		'Usuario1: ' . base64_encode($usuario1),
		'Senha1: ' . base64_encode($senha1))                                                                       
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
	$oID = '12302006081624';
	if ($oID != '') {
		$add_query_order .= '&oID='.$oID;
	}
	
	$url = $domain_url . '/api_orders.php?action=orders_id'.$add_query_order;

	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);                                                                   
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
		'Content-Type: application/json',
		"Cache-Control: no-cache", 
		'Usuario1: ' . base64_encode($usuario1),
		'Senha1: ' . base64_encode($senha1))                                                                       
	);                                                                                                                   
																														 
	$result = curl_exec($ch);
	curl_close($ch);

	print_r($result);
	
	}

	// sample list orders id eof

	////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	// sample list orders status
	
	if ($_GET['action'] == 'orders_status') {
	
	$url = $domain_url . '/api_orders.php?action=orders_status';

	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);                                                                   
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
		'Content-Type: application/json',
		"Cache-Control: no-cache", 
		'Usuario1: ' . base64_encode($usuario1),
		'Senha1: ' . base64_encode($senha1))                                                                       
	);                                                                                                                   
																														 
	$result = curl_exec($ch);
	curl_close($ch);

	print_r($result);
	
	}

	// sample list orders status eof

	////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	// sample edit orders
	
	if ($_GET['action'] == 'update_orders') {
	
	$url = $domain_url . '/api_orders.php?action=update_orders';

	$data = array("oID" => "12302006081632", // Order ID (Only number is required) * FIELD REQUIRED
				  "status" => "116", // Use the API to list the status and get name and id (Only number is required) * FIELD REQUIRED
				  "comments" => "Teste", // Use the API to list the email templates
//				  "notify" => "on", // Use the on to enable notify by email, also change the status or leave blank
//				  "notify_comments" => "on", // Use the on to enable notify comments, also change the status or leave blank
				  "restock" => "", // Use the on to enable restock, also change the status to cancel or leave blank
				  "repayment" => "", // Use the true to enable repayment or leave blank
				  "reorder" => "", // Use the true to enable reorder or leave blank
				  "assinatura_recorrente" => "", // Use the 1 to enable recurring subscription or leave blank
				  "cancel_assinatura_recorrente" => "", // Use the 1 to enable cancel recurring subscription or leave blank
				  "confirm_fraud" => "", // Use the true to enable confirm fraud or leave blank
				  "customer_status_account" => "" // Use the true to enable block customer account or leave blank
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
		'Usuario1: ' . base64_encode($usuario1),
		'Senha1: ' . base64_encode($senha1),
		'Content-Length: ' . strlen($data_string))                                                                       
	);                                                                                                                   
																														 
	$result = curl_exec($ch);
	curl_close($ch);

	print_r($result);

	}
	
	// sample edit orders eof

	////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	// sample customers list
	
	if ($_GET['action'] == 'customers') {

	$add_query_order = '';
	$search = '';
	if ($search != '') {
		$add_query_order .= '&search='.$search;
	}
	$date_from = '';
	if ($date_from != '') {
		$add_query_order .= '&date_from='.$date_from;
	}
	$date_to = '';
	if ($date_to != '') {
		$add_query_order .= '&date_to='.$date_to;
	}
	$status = '';
	if ($status != '') {
		$add_query_order .= '&status='.$status;
	}
	$customers_groups_id = '';
	if ($customers_groups_id != '') {
		$add_query_order .= '&customers_groups_id='.$customers_groups_id;
	}
	$customers_language = '';
	if ($customers_language != '') {
		$add_query_order .= '&customers_language='.$customers_language;
	}
	
	$url = $domain_url . '/api_customers.php?action=customers'.$add_query_order;

	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);                                                                   
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
		'Content-Type: application/json',
		"Cache-Control: no-cache", 
		'Usuario1: ' . base64_encode($usuario1),
		'Senha1: ' . base64_encode($senha1))                                                                       
	);                                                                                                                   
																														 
	$result = curl_exec($ch);
	curl_close($ch);

	print_r($result);
	
	}

	// sample customers list eof

	////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	// sample customers groups list
	
	if ($_GET['action'] == 'customers_groups') {
	
	$url = $domain_url . '/api_customers.php?action=customers_groups';

	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);                                                                   
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
		'Content-Type: application/json',
		"Cache-Control: no-cache", 
		'Usuario1: ' . base64_encode($usuario1),
		'Senha1: ' . base64_encode($senha1))                                                                       
	);                                                                                                                   
																														 
	$result = curl_exec($ch);
	curl_close($ch);

	print_r($result);
	
	}

	// sample customers groups list eof

	////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	// sample customers id list
	
	if ($_GET['action'] == 'customers_id') {

	$add_query_order = '';
	$cID = '';
	if ($cID != '') {
		$add_query_order .= '&cID='.$cID;
	}
	
	$url = $domain_url . '/api_customers.php?action=customers_id'.$add_query_order;

	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);                                                                   
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
		'Content-Type: application/json',
		"Cache-Control: no-cache", 
		'Usuario1: ' . base64_encode($usuario1),
		'Senha1: ' . base64_encode($senha1))                                                                       
	);                                                                                                                   
																														 
	$result = curl_exec($ch);
	curl_close($ch);

	print_r($result);
	
	}

	// sample customers id list eof

	////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	// sample add customers
	
	if ($_GET['action'] == 'add_customers') {
	
	$url = $domain_url . '/api_customers.php?action=add_customers';

	$data = array("customers_firstname" => "Customers Firstname", // Customers Firstname * FIELD REQUIRED
				  "customers_lastname" => "Customers Lastname", // Customers Lastname * FIELD REQUIRED
				  "customers_email_address" => "email@mformula.com.br", // E-mail address * FIELD REQUIRED
				  "customers_password" => "teste", // Password * FIELD REQUIRED
				  "customers_telephone" => "(11) 3230-6255", // Telephone Example: (11) 3230-6255 * FIELD REQUIRED
				  "customers_telephone_commercial" => "(11) 3230-6255", // Telephone Commercial Example: (11) 3230-6255
				  "customers_telephone_mobile" => "(11) 3230-6255", // Telephone Mobile Example: (11) 3230-6255
				  "skype" => "", // Skype name
				  "msn" => "", // MSN
				  "customers_fax" => "", // Telephone Fax Example: (11) 3230-6255
				  "customers_newsletter" => "1", // Use the 1 to YES or 0 to NO (Only number is required) * FIELD REQUIRED
				  "customers_groups_id" => "", // Check the API to get the list of customers groups (Only number is required) * FIELD REQUIRED
				  "customers_language" => "portugues", // english, espanol, japanese or portugues * FIELD REQUIRED
				  "customers_gender" => "m", // m or f * FIELD REQUIRED
				  "customers_dob" => "01/02/1980", // DD/MM/YYYY * FIELD REQUIRED
				  "entry_street_address" => "Av Paulista", // Street address * FIELD REQUIRED
				  "entry_number" => "1500", // Number Street Address * FIELD REQUIRED
				  "entry_completion" => "", // Completion Street Address
				  "entry_suburb" => "Jardins", // Suburb
				  "entry_postcode" => "04206000", // Post Code
				  "entry_city" => "Sao Paulo", // City * FIELD REQUIRED
				  "entry_state" => "Sao Paulo", // Check the API to get the list of State * FIELD REQUIRED
				  "entry_country_id" => "30", // Check the API to get the list of Country (Only number is required) * FIELD REQUIRED
				  "entry_rg" => "", // RG
				  "entry_cpf" => "28240621856", // CPF
				  "entry_company" => "", // Company Name
				  "entry_cnpj" => "", // CNPJ
				  "entry_ie" => "", // IE
				  "person_kind" => "pf" // pj or pf * FIELD REQUIRED
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
		'Usuario1: ' . base64_encode($usuario1),
		'Senha1: ' . base64_encode($senha1),
		'Content-Length: ' . strlen($data_string))                                                                       
	);                                                                                                                   
																														 
	$result = curl_exec($ch);
	curl_close($ch);

	print_r($result);

	}
	
	// sample add customers eof

	////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	// sample customers country list
	
	if ($_GET['action'] == 'customers_country') {

	$url = $domain_url . '/api_customers.php?action=customers_country';

	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);                                                                   
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
		'Content-Type: application/json',
		"Cache-Control: no-cache", 
		'Usuario1: ' . base64_encode($usuario1),
		'Senha1: ' . base64_encode($senha1))                                                                       
	);                                                                                                                   
																														 
	$result = curl_exec($ch);
	curl_close($ch);

	print_r($result);
	
	}

	// sample customers country list eof

	////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	// sample customers state list
	
	if ($_GET['action'] == 'customers_state') {

	$add_query_order = '';
	$country_id = '';
	if ($country_id != '') {
		$add_query_order .= '&country_id='.$country_id;
	}
	
	$url = $domain_url . '/api_customers.php?action=customers_state'.$add_query_order;

	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);                                                                   
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
		'Content-Type: application/json',
		"Cache-Control: no-cache", 
		'Usuario1: ' . base64_encode($usuario1),
		'Senha1: ' . base64_encode($senha1))                                                                       
	);                                                                                                                   
																														 
	$result = curl_exec($ch);
	curl_close($ch);

	print_r($result);
	
	}

	// sample customers state list eof

	////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    // sample list product options and values

	if ($_GET['action'] == 'list_products_options_values') {
		
	$url = $domain_url . '/api_products_others.php?action=list_products_options_values&products_id='.$_GET['products_id'];

	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);                                                                   
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
		'Content-Type: application/json',
		"Cache-Control: no-cache", 
		'Usuario1: ' . base64_encode($usuario1),
		'Senha1: ' . base64_encode($senha1),
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
		
	$url = $domain_url . '/api_products_others.php?action=add_products_options_values';
		
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

	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);                                                                   
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
		'Content-Type: application/json',
		"Cache-Control: no-cache", 
		'Usuario1: ' . base64_encode($usuario1),
		'Senha1: ' . base64_encode($senha1),
		'Content-Length: ' . strlen($data_string))
	);                                                                                                                    
																														 
	$result = curl_exec($ch);
	curl_close($ch);

	print_r($result);
		
	}
    // add list product options and values eof

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
		'Usuario1: ' . base64_encode($usuario1),
		'Senha1: ' . base64_encode($senha1),
		'Content-Length: ' . strlen($data_string))
	);                                                                                                                 
																														 
	$result = curl_exec($ch);
	curl_close($ch);

	print_r($result);
	
	}

	// sample list products eof

	////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	// sample countries
	
	if ($_GET['action'] == 'countries') {
	
	$url = $domain_url . '/api_products_others.php?action=countries';

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
	
	$url = $domain_url . '/api_products_others.php?action=zones';

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

	////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
  require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>
