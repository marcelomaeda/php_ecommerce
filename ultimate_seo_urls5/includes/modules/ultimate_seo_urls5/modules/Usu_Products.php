<?php

 /**

 *

 * ULTIMATE Seo Urls 5

 *

 * 

 * @package Ultimate Seo Urls 5

 * @license http://www.opensource.org/licenses/gpl-2.0.php GNU Public License

 * @link http://www.fwrmedia.co.uk

 * @copyright Copyright 2008-2009 FWR Media

 * @copyright Portions Copyright 2005 Bobby Easland

 * @author Robert Fisher, FWR Media, http://www.fwrmedia.co.uk 

 * @lastdev $Author:: Rob                                              $:  Author of last commit

 * @lastmod $Date:: 2009-10-07 12:46:19 +0100 (Wed, 07 Oct 2009)       $:  Date of last commit

 * @version $Rev:: 92                                                  $:  Revision of last commit

 * @Id $Id:: Usu_Products.php 92 2009-10-07 11:46:19Z Rob              $:  Full Details   

 */



class Usu_Products extends aDataMap {



  public $dependency = 'products_id';

  public $dependency_tags = array('-p-' => FILENAME_PRODUCT_INFO, '-pr-' => FILENAME_PRODUCT_REVIEWS, '-pri-' => FILENAME_PRODUCT_REVIEWS_INFO, '-pq-' => FILENAME_PRODUCT_QUICKVIEW, '-pc-' => FILENAME_PRODUCT_CONTACT);

  private $page_relations = array(FILENAME_PRODUCT_INFO => 1, FILENAME_PRODUCT_REVIEWS => 1, FILENAME_PRODUCT_REVIEWS_INFO => 1, FILENAME_PRODUCT_QUICKVIEW => 1, FILENAME_PRODUCT_CONTACT => 1);

  private $markers = array('-p-' => 'products_id', '-pr-' => 'products_id', '-pri-' => 'products_id', '-pq-' => 'products_id', '-pc-' => 'products_id');

  private $query;

  private $base_query;

  private $link_text;

  private $products_id;

  

  public function __construct(){

    $this->base_query = "SELECT products_name FROM " . TABLE_PRODUCTS_DESCRIPTION . " WHERE products_id=':pid' AND language_id=':languages_id' LIMIT 1";

    usu::$registry->merge('seo_pages', $this->page_relations);

    usu::$registry->merge('markers', $this->markers);

    usu::$registry->addPageDependency( array(FILENAME_PRODUCT_INFO => 'products_id', FILENAME_PRODUCT_REVIEWS => 'products_id', FILENAME_PRODUCT_REVIEWS_INFO => 'products_id', FILENAME_PRODUCT_QUICKVIEW => 'products_id', FILENAME_PRODUCT_CONTACT => 'products_id') );   

  }

  

  protected function acquire($dependency, $fullpath){   

    $this->products_id = (int)$dependency;

    // Bypass the query if already in the registry

    if ( false !== isset(usu::$registry->{$this->dependency}[$this->products_id]) ){

      usu::$performance['queries_saved']++;

      return true;

    }

    $placeholders = array( ':pid', ':languages_id' );

    // $values are already type cast

    $values = array( $this->products_id, usu::$languages_id );

    $this->query = str_replace($placeholders, $values, $this->base_query);

    $result = usu::query( $this->query );

    $this->query = null;

    $row = tep_db_fetch_array( $result );

    tep_db_free_result( $result );

    if ( false === $row ){

      return false;

    }

	

	if ( defined( 'SEO_ADD_CPATH_TO_PRODUCT_URLS' ) && ( SEO_ADD_CPATH_TO_PRODUCT_URLS == 'true' ) ) {

		$product_path = tep_get_product_path($this->products_id);

		$categorie_id = explode("_", $product_path);

		

		if ($categorie_id[3]) {

		$cat_path_name = tep_get_categories_name($categorie_id[0]) . ' - ' . tep_get_categories_name($categorie_id[1]) . ' - ' . tep_get_categories_name($categorie_id[2]) . ' - ' . tep_get_categories_name($categorie_id[3]) . ' - ';

		}elseif ($categorie_id[2]) {

		$cat_path_name = tep_get_categories_name($categorie_id[0]) . ' - ' . tep_get_categories_name($categorie_id[1]) . ' - ' . tep_get_categories_name($categorie_id[2]) . ' - ';

		}elseif ($categorie_id[1]) {

		$cat_path_name = tep_get_categories_name($categorie_id[0]) . ' - ' . tep_get_categories_name($categorie_id[1]) . ' - ';

		}else{

		$cat_path_name = tep_get_categories_name($product_path) . ' - ';

		}

		

	}

	

	
	if (strlen($cat_path_name . $row['products_name']) >= 255){
    $this->link_text = $this->linkText(substr($cat_path_name . $row['products_name'],0,254));		
	}else{
    $this->link_text = $this->linkText($cat_path_name . $row['products_name']);		
	}



    if ( false === isset(usu::$registry->{$this->dependency}) ){

      usu::$registry->{$this->dependency} = array();

    }

    usu::$registry->attach($this->dependency, $this->products_id, $this->getProperties());

  } // End method

   

   protected function getProperties(){

     $properties = get_object_vars($this);

     unset($properties['page_relations']);

     return $properties;  

   } // End method

   

   public function buildLink($page, $valuepair, &$url, &$added_qs, $parameters){

     if ( (false === array_key_exists(1, $valuepair)) || ($valuepair[0] != $this->dependency) 

                                                      || (false !== strpos(urldecode($valuepair[1]), '{')) ){

       return false;

     }

     if ( !isset(usu::$registry->vars[$valuepair[0]][$valuepair[1]]) ){

       if ( false === $this->acquire( $valuepair[1], $fullpath = false ) ){

         return false;

       }

     } else {

       usu::$performance['queries_saved']++;

     }

     $reg_item = usu::$registry->vars[$valuepair[0]][$valuepair[1]];

     switch( true ){

       case ( $page == FILENAME_PRODUCT_INFO && (false === strpos($valuepair[1], '{')) ):

         $url = $this->linkCreate(FILENAME_PRODUCT_INFO, normalize_special_characters($reg_item['link_text']), '-p-', $valuepair[1]); 

         break;

       case ( $page == FILENAME_PRODUCT_REVIEWS ):

         $url = $this->linkCreate(FILENAME_PRODUCT_REVIEWS, normalize_special_characters($reg_item['link_text']), '-pr-', $valuepair[1]);

         break;

       case ( $page == FILENAME_PRODUCT_REVIEWS_INFO ):

         $url = $this->linkCreate(FILENAME_PRODUCT_REVIEWS_INFO, normalize_special_characters($reg_item['link_text']), '-pri-', $valuepair[1]);

         break;

       case ( $page == FILENAME_PRODUCT_QUICKVIEW ):

         $url = $this->linkCreate(FILENAME_PRODUCT_QUICKVIEW, normalize_special_characters($reg_item['link_text']), '-pq-', $valuepair[1]);

         break;

       case ( $page == FILENAME_PRODUCT_CONTACT ):

         $url = $this->linkCreate(FILENAME_PRODUCT_CONTACT, normalize_special_characters($reg_item['link_text']), '-pc-', $valuepair[1]);

         break;

       default:

         $added_qs[filter_var($valuepair[0], FILTER_SANITIZE_STRING)] = usu::cleanse($valuepair[1]);

         break;

     } # end switch

   }

}  

?>