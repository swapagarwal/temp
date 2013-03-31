<?php

/**
  * SquirrelMail CAPTCHA Plugin reCAPTCHA Backend
  * Copyright (c) 2007-2011 Paul Lesniewski <paul@squirrelmail.org>
  * Licensed under the GNU GPL. For full terms see the file COPYING.
  *
  * @package plugins
  * @subpackage captcha
  *
  */



/**      
  * Validate that this backend is configured correctly 
  *         
  * @return boolean Whether or not there was a
  *                 configuration error for this backend.
  *      
  */   
function recaptcha_check_configuration()
{

   global $recaptcha_public_key, $recaptcha_private_key;

   if (empty($recaptcha_public_key) || empty($recaptcha_private_key))
   {
      do_err('CAPTCHA plugin reCAPTCHA backend is missing a reCAPTCHA key.  Please see https://www.google.com/recaptcha/admin/create', FALSE);
      return TRUE;
   }

}



/**
  * Show captcha inputs on login page
  *
  * @return string The output destined for the browser
  *
  */
function recaptcha_show_input_widgets()
{

   global $is_secure_connection, $recaptcha_theme, 
          $recaptcha_public_key, $recaptcha_tabindex,
          $squirrelmail_language;


   // reCAPTCHA only has a limited set of translations
   // available by default (TODO: we could solicit other
   // translations or probably find them already done on
   // the web and add those as custom translations using
   // the info here:
   // https://code.google.com/apis/recaptcha/docs/customization.html
   // but for now, we limit to the ones supplied by reCAPTCHA)
   //
   $recaptcha_translations = array(
      'en_US' => 'en',
      'en_GB' => 'en',
      'nl_NL' => 'nl',
      'fr_FR' => 'fr',
      'de_DE' => 'de',
      'pt_BR' => 'pt',
      'pt_PT' => 'pt',
      'ru_RU' => 'ru',
      'ru_UA' => 'ru',
      'es_ES' => 'es',
      'tr_TR' => 'tr',
   );
   if (!empty($recaptcha_translations[$squirrelmail_language]))
      $recaptcha_lang = $recaptcha_translations[$squirrelmail_language];
   else
      $recaptcha_lang = '';


   // determine if this is a secure connection... I suppose
   // these URIs might be better placed in a config file,
   // but supposedly they are static
   //
   if ($is_secure_connection)
      $recaptcha_uri = 'https://www.google.com/recaptcha/api';
   else
      $recaptcha_uri = 'http://www.google.com/recaptcha/api';



   // finish the reCAPTCHA URI...
   // 
   // would rather use checkForJavascript(), but in 1.4.x that
   // will ruin things horribly, and $javascript_on should be
   // available in both 1.4.x and 1.5.x
   // 
   global $javascript_on;
   if ($javascript_on) 
      $recaptcha_request = '/challenge';
   else
      $recaptcha_request = '/noscript';



   $recaptcha_query = '?k=' . $recaptcha_public_key;



   // from SM 1.5.2 an up, just use our template
   //
   if (check_sm_version(1, 5, 2))
   {
      global $oTemplate;
      $oTemplate->assign('recaptcha_uri', $recaptcha_uri);
      $oTemplate->assign('recaptcha_request', $recaptcha_request);
      $oTemplate->assign('recaptcha_query', $recaptcha_query);
      $oTemplate->assign('recaptcha_theme', $recaptcha_theme);
      $oTemplate->assign('recaptcha_tabindex', $recaptcha_tabindex);
      return $oTemplate->fetch('plugins/captcha/recaptcha.tpl');
   }



   // old style output...
   //

   // really crappy placement of new login_form hook in 1.5.1
   //
   if (check_sm_version(1, 5, 1) && !check_sm_version(1, 5, 2))
      $output = "</td></tr>\n";
   else
      $output = '';


   // build regular output
   //
   $output .="<tr><td colspan=\"2\"><br /><center>\n"
           . "<table width=\"350\">\n"
           . "<tr><td><center>\n";

/* =========== SquirrelMail's JavaScript test doesn't work until one page has been submitted
   =========== so this code will always try to show the non-JavaScript interface; leaving
   =========== this here in case we decide to change the JavaScript detection method 
   if ($javascript_on) 
   {

      if (!empty($recaptcha_theme) || !empty($recaptcha_tabindex))
         $output .="<script language=\"JavaScript\" type=\"text/javascript\">\n"
                 . "<!--\n"
                 . "   var RecaptchaOptions = {\n"
                 . (!empty($recaptcha_lang) ? "      lang : '" . $recaptcha_lang
                                             . (!empty($recaptcha_theme) || !empty($recaptcha_tabindex) ? "',\n" : "'\n")
                                             : '')
                 . (!empty($recaptcha_theme) ? "      theme : '" . $recaptcha_theme 
                                             . (!empty($recaptcha_tabindex) ? "',\n" : "'\n")
                                             : '')
                 . (!empty($recaptcha_tabindex) ? "      tabindex : " . $recaptcha_tabindex . "\n"
                                                : '')
                 . "   };\n"
                 . "//-->\n"
                 . "</script>\n";

      $output .="<script language=\"JavaScript\" type=\"text/javascript\" src=\""
              . $recaptcha_uri . $recaptcha_request . $recaptcha_query . "\"></script>\n";

   }


   // non-javascript widget
   //
   else
   {

      // iframe?!?  so much for older browser support...  also not sure
      // why they are using a textarea for the user input?!?
      //
      $output .="<iframe src=\"" 
              . $recaptcha_uri . $recaptcha_request . $recaptcha_query
              . "\" height=\"300\" width=\"500\" frameborder=\"0\"></iframe>\n"
              . "<textarea name=\"recaptcha_challenge_field\" rows=\"3\" cols=\"40\"></textarea>\n"
              . "<input type=\"hidden\" name=\"recaptcha_response_field\" value=\"manual_challenge\" />\n";

   }
=========== 
===========
=========== */


   // output both JavaScript and non-JavaScript code, let browser
   // decide (using <noscript> HTML tag)
   //
   if (!empty($recaptcha_theme) || !empty($recaptcha_tabindex))
      $output .="<script language=\"JavaScript\" type=\"text/javascript\">\n"
              . "<!--\n"
              . "   var RecaptchaOptions = {\n"
              . (!empty($recaptcha_lang) ? "      lang : '" . $recaptcha_lang
                                          . (!empty($recaptcha_theme) || !empty($recaptcha_tabindex) ? "',\n" : "'\n")
                                          : '')
              . (!empty($recaptcha_theme) ? "      theme : '" . $recaptcha_theme
                                          . (!empty($recaptcha_tabindex) ? "',\n" : "'\n")
                                          : '')
              . (!empty($recaptcha_tabindex) ? "      tabindex : " . $recaptcha_tabindex . "\n"
                                             : '')
              . "   };\n"
              . "//-->\n"
              . "</script>\n";

   $output .="<script language=\"JavaScript\" type=\"text/javascript\" src=\""
           . $recaptcha_uri . '/challenge' . $recaptcha_query . "\"></script>\n"

           // iframe?!?  so much for older browser support...  also not sure
           // why they are using a textarea for the user input?!?
           //
           . "<noscript><iframe src=\""
           . $recaptcha_uri . '/noscript' . $recaptcha_query
           . "\" height=\"300\" width=\"500\" frameborder=\"0\"></iframe>\n"
           . "<textarea name=\"recaptcha_challenge_field\" rows=\"3\" cols=\"40\"></textarea>\n"
           . "<input type=\"hidden\" name=\"recaptcha_response_field\" value=\"manual_challenge\" /></noscript>\n";



   $output .= "</center></td></tr>\n</table>\n</center>\n";


   // really crappy placement of new login_form hook in 1.5.1
   //
   if (check_sm_version(1, 5, 1) && !check_sm_version(1, 5, 2))
      $output .= '';
   else
      $output .= '</td></tr>';

   return $output;

}



/**
  * Validate that correct captcha was sent
  *
  * @return mixed TRUE if the correct captcha response was sent,
  *               FALSE if the user input was incorrect, or NULL
  *               when no user input was given.
  *
  */
function recaptcha_validate_captcha()
{

   // just bail if insufficient input is received
   //
   if (!sqGetGlobalVar('recaptcha_challenge_field', $recaptcha_challenge_field, SQ_FORM)
    || !sqGetGlobalVar('recaptcha_response_field', $recaptcha_response_field, SQ_FORM)
    || !sqGetGlobalVar('REMOTE_ADDR', $remote_addr, SQ_SERVER))
      return FALSE;
   

   // test for no user input
   //
   if ($recaptcha_challenge_field === '' && $recaptcha_response_field === '')
      return NULL;


   global $recaptcha_private_key, $recaptcha_verify_proxy_port,
          $recaptcha_verify_proxy_host;
   $verify_uri = '/recaptcha/api/verify';
   $recapcha_verify_host = 'www.google.com';
   if (empty($recaptcha_verify_proxy_host))
      $recaptcha_verify_proxy_host = $recapcha_verify_host;
   else
      // would some proxy servers allow using https here?  older Squid does not
      $verify_uri = 'http://' . $recapcha_verify_host . $verify_uri;
   if (empty($recaptcha_verify_proxy_port))
      $recaptcha_verify_proxy_port = 80;


   // set up POST payload
   //
   $payload = 'privatekey=' . urlencode($recaptcha_private_key)
            . '&remoteip=' . urlencode($remote_addr)
            . '&challenge=' . urlencode($recaptcha_challenge_field)
            . '&response=' . urlencode($recaptcha_response_field);


   // ask reCAPTCHA server if response was correct
   //
   $verify_request = "POST $verify_uri HTTP/1.0\r\n"
                   . "Host: $recapcha_verify_host\r\n"
                   . "User-Agent: SquirrelMail CAPTCHA Plugin\r\n"
                   . "Content-Type: application/x-www-form-urlencoded\r\n"
                   . "Content-Length: " . strlen($payload) . "\r\n"
                   . "Connection: close\r\n"  // really only useful for HTTP 1.1, but...
                   . "\r\n" . $payload;


   if (!($SOCKET = @fsockopen($recaptcha_verify_proxy_host,
                              $recaptcha_verify_proxy_port, $errno, $errstr, 30)))
   {
      // TODO: indicate to user that the error was a connection problem?
      //
      fclose($SOCKET);
      return FALSE;
   }


   if (!@fwrite($SOCKET, $verify_request))
   {
      // TODO: indicate to user that the error was a socket problem?
      //
      fclose($SOCKET);
      return FALSE;
   }


   // get response
   //
   $verify_response = '';
   while (!feof($SOCKET)) $verify_response .= fgets($SOCKET, 4096);


   fclose($SOCKET);


   $verify_response = explode("\r\n\r\n", $verify_response, 2);

   if (empty($verify_response[1])) return FALSE;

   $verify_response = explode("\n", $verify_response[1]);

   if (strtoupper(trim($verify_response[0])) == 'TRUE')
      return TRUE;

   return FALSE;

}



