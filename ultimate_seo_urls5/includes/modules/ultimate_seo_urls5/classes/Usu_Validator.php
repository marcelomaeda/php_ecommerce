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
 * @author Robert Fisher, FWR Media, http://www.fwrmedia.co.uk 
 * @lastdev $Author:: Rob                                              $:  Author of last commit
 * @lastmod $Date:: 2009-10-05 12:34:21 +0100 (Mon, 05 Oct 2009)       $:  Date of last commit
 * @version $Rev:: 90                                                  $:  Revision of last commit
 * @Id $Id:: Usu_Validator.php 90 2009-10-05 11:34:21Z Rob             $:  Full Details   
 */

  class Usu_Validator {
    
    private $basename;
    private $filestring;
    private $querystring;
    private $request_uri;
    
    public function __construct(){
      $this->disectUri();
    }
    
    private function disectUri(){
      // get the base filename
      $this->basename = basename($_SERVER['SCRIPT_NAME']);
      // Confirm we have an seo registered page if not return false
      if ( false === array_key_exists($this->basename, usu::$registry->seo_pages) ){
        return false;
      }
      // Remove the osCsid and sanitise
      $this->sanitizeQuerystring($_SERVER['QUERY_STRING']);
      // Attempt to format $_SERVER['REQUEST_URI'] for Windows/IIS
      $this->iis_request_uri();
      // Remove the directory path from the URI
      if ( DIR_WS_CATALOG == '/' ){
        $no_directorypath = ltrim($this->request_uri, '/');
      } else {
        $no_directorypath = str_replace(DIR_WS_CATALOG, '', $this->request_uri);
      }
      // Remove the querystring (if there)
      if ( false !== strpos($no_directorypath, '?') ){
        $this->filestring = substr_replace($no_directorypath, '', strpos($no_directorypath, '?'));
      // Querystring should not start with & but remove anyway (if there)
      } elseif ( false !== strpos($no_directorypath, '&') ){
        $this->filestring = substr_replace($no_directorypath, '', strpos($no_directorypath, '&'));
      // Looks clean with no query string
      } else {
        $this->filestring = $no_directorypath;
      }
      // Return false if .. $this->filestring is empty .. or .. the querystring is empty and the filestring ends in .php 
      if ( (false === tep_not_null($this->filestring)) || ( (substr($this->filestring, -4, 4) == '.php') && (false === tep_not_null($this->querystring)) ) ){
        return false;
      }
      // Check to see the type of URI we are dealing with
      switch( $this->filestring ){
        // broken osCommerce urls
        case ( substr_count($this->filestring, '/') > 1 ):
          $this->filestring = str_replace($this->basename . '/', '', $this->filestring);
          $newget = $this->extractByDirSeparator();
          $this->parsePath();
          break;
        // Non rewrite seo urls
        case ( false !== strpos($this->filestring, '/') ):
          $this->filestring = str_replace($this->basename . '/', '', $this->filestring);
          $extractqs = $this->extractByMarkers();
          $this->querystring = $extractqs . '&' . $this->querystring; 
          $this->parsePath();
          break;
        // Rewrite seo urls
        case ( false !== strpos($this->filestring, '.html') ):
          $this->filestring = str_replace('/', '', $this->filestring);
          $this->extractByMarkers(); 
          $this->parsePath();
          break;
        // Standard files
        case substr($this->filestring, -4) == '.php':
          // If there is querystring but not an seo get key then don't validate
          foreach ( usu::$registry->vars['page_dependencies'][$this->basename] as $getkey => $dummy ){
            if ( false !== strpos( $this->querystring, $getkey) ){
              // Serve standard osC uri when the products_id has attributes
              if ( ($getkey == 'products_id') && (false !== strpos(urldecode($this->querystring), '}')) ){
                return false;
              }
              $this->parsePath();
              break;
            }
          }
          return false;
          break;
        default:
          break;
      }
    } // End method
    
    /**
    * Attempt to build $_SERVER['REQUEST_URI'] for Windows
    * This is very dirty as I have no means to test on IIS
    */
    private function iis_request_uri(){
      if ( array_key_exists('REQUEST_URI', $_SERVER) ){
        return $this->request_uri = $_SERVER['REQUEST_URI'];
      }
      // Are we dealing with Windows
      if ( (false !== stristr(PHP_OS, 'winnt')) || (false !== stristr(PHP_OS, 'win32')) ){
        $uri = basename($_SERVER['SCRIPT_NAME']);
        $rawpath = '';
        switch( true ){
          case ( array_key_exists('ORIG_PATH_INFO', $_SERVER) && (strlen($_SERVER['ORIG_PATH_INFO']) > 1) ):
            $rawpath = $_SERVER['ORIG_PATH_INFO'];
            break;
          case ( (false !== @getenv('ORIG_PATH_INFO')) && strlen(getenv('ORIG_PATH_INFO')) > 1 ):
            $rawpath = getenv('ORIG_PATH_INFO');
            break;
          case ( (false !== @getenv('PATH_INFO')) && strlen(getenv('PATH_INFO')) > 1):
            $rawpath = getenv('PATH_INFO');
            break;
          case ( array_key_exists('PATH_INFO', $_SERVER) && (strlen($_SERVER['PATH_INFO']) > 1) ):
            $rawpath = $_SERVER['PATH_INFO'];
            break;
        }
        if ( DIR_WS_CATALOG != '/' && (false !== strpos($rawpath, DIR_WS_CATALOG)) ){
          $rawpath = str_replace(DIR_WS_CATALOG, '/', $rawpath);
        }
        if ( false !== strpos($rawpath, basename($_SERVER['SCRIPT_NAME'])) ){
          $rawpath = str_replace(basename($_SERVER['SCRIPT_NAME']), '', $rawpath);
        }
        if ( false !== strpos($rawpath, '//') ){
          $rawpath = str_replace('//', '/', $rawpath);
        }
        $uri .= $rawpath;
        return $this->request_uri = $uri; 
      }
    }


    /**
    * Remove the session and sanitise remaining _GET variables
    * 
    * @param string $get - the querystring
    */
    private function sanitizeQuerystring($get){     
      $get_array = explode('&', $get);
      $newqs = '';
      foreach ( $get_array as $index => $stringpair ){
        if ( false === strpos($stringpair, tep_session_name()) ){
          $pair = explode('=', $stringpair);
          if ( count($pair) == 2 ){
            $stringpair = filter_var($pair[0], FILTER_SANITIZE_STRING) . '=' . usu::cleanse($pair[1]); 
          } else {
            $stringpair = filter_var($stringpair, FILTER_SANITIZE_STRING);
          }
          $newqs .= '&' . $stringpair;  
        }
      }
      $this->querystring = ltrim($newqs, '&');
    }

    /**
    * Break up an seo url into component parts
    */
    private function extractByMarkers(){
      global $HTTP_GET_VARS;
      foreach ( usu::$registry->vars['markers'] as $marker => $qskey ){
        if ( false !== strpos($this->filestring, $marker) ){
          // Found an seo marker so explode into two component parts
          $tmp = explode($marker, $this->filestring);
          // assign the key=>value pair to _GET
          $value =  (false !== strpos($tmp[1], '.html')) ? usu::cleanse(str_replace('.html', '', $tmp[1])) : usu::cleanse($tmp[1]); 
          $_GET[$qskey] = $value;
          $HTTP_GET_VARS[$qskey] = $value;

          return $qskey . '=' .  $value;
        } 
      }
      return false;
    }

    /**
    * Check that we have an seo url
    */
    private function isSeoUrl($linkstring){
      $linkstring = str_replace('.html', '', $linkstring);
      foreach ( usu::$registry->vars['markers'] as $marker => $getkey ){
        if ( false !== strpos($linkstring, $marker) ){
          // Found an seo marker so explode into two component parts
          $linkarray = explode($marker, $linkstring);
          // we seem to have found an seo url with the right values .. last check to ensure the value is valid
          if ( (count($linkarray) == 2) && is_numeric(str_replace('_', '', $linkarray[1])) ){
            return true;
          }
        }
      }
      // fell through to here so is not an seo url 
      return false;
    }
    
    // extract _GET from the "experimental" osC search engine friendly urls
    private function extractByDirSeparator(){
    global $HTTP_GET_VARS;  
      $tmp = explode('/', $this->filestring);
      $count = count($tmp);
      for ( $i=0; $i<$count; $i=$i+2 ){
        $newget[filter_var($tmp[$i], FILTER_SANITIZE_STRING)] = usu::cleanse($tmp[$i+1]);
        // assign cleansed key=>value pair to _GET
        $_GET[filter_var($tmp[$i], FILTER_SANITIZE_STRING)] = usu::cleanse($tmp[$i+1]);
        $HTTP_GET_VARS[filter_var($tmp[$i], FILTER_SANITIZE_STRING)] = usu::cleanse($tmp[$i+1]);
      }
      // Newly created _GET array added to the querystring and converted to _GET string
      $getstring = http_build_query($newget) . '&' . $this->querystring;
      $this->querystring = rtrim($getstring, '&');
    }
    
    private function parsePath(){
      // get a brand new seo url
      $newlink = tep_href_link($this->basename,  $this->querystring);
      // new seo url excluding all before the last /
      $stripleft = ltrim(strrchr($newlink, '/'), '/');
      // remove any querystring
      $compare = str_replace(strrchr($stripleft, '?'), '', $stripleft);
      // If we haven't returned a valid seo url then the product/category etc does not exist
      if ( false === $this->isSeoUrl($compare) ){
        $this->error404();
      }
      // we have a valid seo url return but the new seo url does not match the request .. so 301 redirect                                                                        
      if ( false === (urldecode($this->filestring) == $compare) ){
        $this->redirect($newlink);
      }
    }
    
    private function redirect($link){
      // header redirects can not contain &amp; (which are written by W3C option)
      if ( false !== strpos($link, '&amp;') ){
        $link = str_replace('&amp;', '&', $link);
      }
      // write/close the session before redirect
      session_write_close();
      header("HTTP/1.0 301 Moved Permanently");
      header('Location: ' . $link);
      // always exit after an "attempted" redirect to stop the script "falling through"
      exit;
    }

    // we have decided the page does not exist so we will show our custom 404 error page and header
    private function error404(){
      session_write_close();
      header("HTTP/1.0 404 Not Found");
      include_once usu::$usuPath . 'includes' . DIRECTORY_SEPARATOR . 'notfound_404.php';
      exit;
    } 
  }
?>