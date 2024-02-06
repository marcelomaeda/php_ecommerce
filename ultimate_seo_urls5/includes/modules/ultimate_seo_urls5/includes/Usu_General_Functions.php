<?php
/*
  $Id: Usu_General_Functions.php 86 2009-06-28 17:49:32Z Rob $
*/
    
  function osc_href_link($page = '', $parameters = '', $connection = 'NONSSL', $add_session_id = true, $search_engine_safe = true) {

    if (!tep_not_null($page)) {
      die('</td></tr></table></td></tr></table><br><br><font color="#ff0000"><b>Error!</b></font><br><br><b>Unable to determine the page link!<br><br>');
    }

    if ($connection == 'NONSSL') {
      $link = HTTP_SERVER . DIR_WS_HTTP_CATALOG;
    } elseif ($connection == 'SSL') {
      if (ENABLE_SSL == true) {
        $link = HTTPS_SERVER . DIR_WS_HTTPS_CATALOG;
      } else {
        $link = HTTP_SERVER . DIR_WS_HTTP_CATALOG;
      }
    } else {
      die('</td></tr></table></td></tr></table><br><br><font color="#ff0000"><b>Error!</b></font><br><br><b>Unable to determine connection method on a link!<br><br>Known methods: NONSSL SSL</b><br><br>');
    }

    if (tep_not_null($parameters)) {
      $link .= $page . '?' . tep_output_string($parameters);
      $separator = '&';
    } else {
      $link .= $page;
      $separator = '?';
    }

    while ( (substr($link, -1) == '&') || (substr($link, -1) == '?') ) $link = substr($link, 0, -1);

// Add the session ID when moving from different HTTP and HTTPS servers, or when SID is defined
    if ( ($add_session_id == true) && (usu::$session_started == true) && (SESSION_FORCE_COOKIE_USE == 'False') ) {
      if (tep_not_null(usu::$sid)) {
        $_sid = usu::$sid;
      } elseif ( ( (usu::$request_type == 'NONSSL') && ($connection == 'SSL') && (ENABLE_SSL == true) ) || ( (usu::$request_type == 'SSL') && ($connection == 'NONSSL') ) ) {
        if (HTTP_COOKIE_DOMAIN != HTTPS_COOKIE_DOMAIN) {
          $_sid = tep_session_name() . '=' . tep_session_id();
        }
      }
    }

    if ( (SEARCH_ENGINE_FRIENDLY_URLS == 'true') && ($search_engine_safe == true) ) {
      while (strstr($link, '&&')) $link = str_replace('&&', '&', $link);

      $link = str_replace('?', '/', $link);
      $link = str_replace('&', '/', $link);
      $link = str_replace('=', '/', $link);

      $separator = '?';
    }

    if (isset($_sid)) {
      $link .= $separator . tep_output_string($_sid);
    }
    usu::$performance['std_url_array'][] = $link;
    if ( defined( 'SEO_URLS_USE_W3C_VALID' ) && ( SEO_URLS_USE_W3C_VALID == 'true' ) ) {
      return htmlspecialchars( utf8_encode( $link ) );
    }
    return $link;
  } // End method






function normalize_special_characters( $str )
{
    # Quotes cleanup
    $str = preg_replace( "/".chr(ord("`"))."/", "'", $str );        # `
    $str = preg_replace( "/".chr(ord("´"))."/", "'", $str );        # ´
    $str = preg_replace( "/".chr(ord("„"))."/", ",", $str );        # „
    $str = preg_replace( "/".chr(ord("`"))."/", "'", $str );        # `
    $str = preg_replace( "/".chr(ord("´"))."/", "'", $str );        # ´
    $str = preg_replace( "/".chr(ord("“"))."/", "\"", $str );        # “
    $str = preg_replace( "/".chr(ord("”"))."/", "\"", $str );        # ”
    $str = preg_replace( "/".chr(ord("´"))."/", "'", $str );        # ´

    $unwanted_array = array(    'Š'=>'S', 'š'=>'s', 'Ž'=>'Z', 'ž'=>'z', 'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E',
                                'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U',
                                'Ú'=>'U', 'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss', 'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a', 'æ'=>'a', 'ç'=>'c',
                                'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o',
                                'ö'=>'o', 'ø'=>'o', 'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'ý'=>'y', 'þ'=>'b', 'ÿ'=>'y' );
    $str = strtr( $str, $unwanted_array );

    # Bullets, dashes, and trademarks
    $str = preg_replace( "/".chr(149)."/", "&#8226;", $str );    # bullet •
    $str = preg_replace( "/".chr(150)."/", "&ndash;", $str );    # en dash
    $str = preg_replace( "/".chr(151)."/", "&mdash;", $str );    # em dash
    $str = preg_replace( "/".chr(153)."/", "&#8482;", $str );    # trademark
    $str = preg_replace( "/".chr(169)."/", "&copy;", $str );    # copyright mark
    $str = preg_replace( "/".chr(174)."/", "&reg;", $str );        # registration mark

    return $str;
}

?>