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
    $str = preg_replace( "/".chr(ord("�"))."/", "'", $str );        # �
    $str = preg_replace( "/".chr(ord("�"))."/", ",", $str );        # �
    $str = preg_replace( "/".chr(ord("`"))."/", "'", $str );        # `
    $str = preg_replace( "/".chr(ord("�"))."/", "'", $str );        # �
    $str = preg_replace( "/".chr(ord("�"))."/", "\"", $str );        # �
    $str = preg_replace( "/".chr(ord("�"))."/", "\"", $str );        # �
    $str = preg_replace( "/".chr(ord("�"))."/", "'", $str );        # �

    $unwanted_array = array(    '�'=>'S', '�'=>'s', '�'=>'Z', '�'=>'z', '�'=>'A', '�'=>'A', '�'=>'A', '�'=>'A', '�'=>'A', '�'=>'A', '�'=>'A', '�'=>'C', '�'=>'E', '�'=>'E',
                                '�'=>'E', '�'=>'E', '�'=>'I', '�'=>'I', '�'=>'I', '�'=>'I', '�'=>'N', '�'=>'O', '�'=>'O', '�'=>'O', '�'=>'O', '�'=>'O', '�'=>'O', '�'=>'U',
                                '�'=>'U', '�'=>'U', '�'=>'U', '�'=>'Y', '�'=>'B', '�'=>'Ss', '�'=>'a', '�'=>'a', '�'=>'a', '�'=>'a', '�'=>'a', '�'=>'a', '�'=>'a', '�'=>'c',
                                '�'=>'e', '�'=>'e', '�'=>'e', '�'=>'e', '�'=>'i', '�'=>'i', '�'=>'i', '�'=>'i', '�'=>'o', '�'=>'n', '�'=>'o', '�'=>'o', '�'=>'o', '�'=>'o',
                                '�'=>'o', '�'=>'o', '�'=>'u', '�'=>'u', '�'=>'u', '�'=>'y', '�'=>'y', '�'=>'b', '�'=>'y' );
    $str = strtr( $str, $unwanted_array );

    # Bullets, dashes, and trademarks
    $str = preg_replace( "/".chr(149)."/", "&#8226;", $str );    # bullet �
    $str = preg_replace( "/".chr(150)."/", "&ndash;", $str );    # en dash
    $str = preg_replace( "/".chr(151)."/", "&mdash;", $str );    # em dash
    $str = preg_replace( "/".chr(153)."/", "&#8482;", $str );    # trademark
    $str = preg_replace( "/".chr(169)."/", "&copy;", $str );    # copyright mark
    $str = preg_replace( "/".chr(174)."/", "&reg;", $str );        # registration mark

    return $str;
}

?>