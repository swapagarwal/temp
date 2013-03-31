<?php

/**
  * SquirrelMail CAPTCHA Plugin HTML_QuickForm_CAPTCHA Backend
  * Copyright (c) 2006-2007 Philippe Jausions <Philippe.Jausions@11abacus.com>
  * Copyright (c) 2007-2011 Paul Lesniewski <paul@squirrelmail.org>
  * Licensed under the GNU GPL. For full terms see the file COPYING.
  *
  * @package plugins
  * @subpackage captcha
  *
  */


   if (file_exists('../../../../functions/global.php'))
   {
      define('SM_PATH', '../../../../');
      include_once(SM_PATH . 'include/constants.php');
      include_once(SM_PATH . 'functions/global.php');
   }
   else exit;


   global $challenge_type, $figlet_fonts,
          $captcha_font_path, $captcha_font,
          $captcha_font_size,
          $captcha_width, $captcha_height;


   if (!@include_once(SM_PATH . 'plugins/captcha/backends/quickform/quickform_config.php'))
      include_once(SM_PATH . 'plugins/captcha/backends/quickform/quickform_config_default.php');


   require_once('HTML/QuickForm.php');
   require_once('Text/CAPTCHA.php');
   require_once('HTML/QuickForm/CAPTCHA/Image.php');


   $captcha_type = 'CAPTCHA_Image';
   $captcha = new HTML_QuickForm('qfCaptcha');
   $options = array(
      'sessionVar'    => 'captcha_object',
      'callback'      => '',
      'width'         => $captcha_width,
      'height'        => $captcha_height,
      'imageOptions'  => array(
                               'font_size' => $captcha_font_size,
                               'font_path' => $captcha_font_path,
                               'font_file' => $captcha_font,
                              )
                   );


   $captcha_question =& $captcha->addElement($captcha_type, '', '', $options);
   if (PEAR::isError($captcha_question))
   {
      echo $captcha_type . ' :: ' . $captcha_question->getMessage();
      exit;
   }


   // target phrase doesn't seem to get generated until output is delivered
   // so we will capture the output and get the answer phrase
   //
   ob_start();
   $captcha->display();
   ob_end_clean();

   sqGetGlobalVar('captcha_object', $captcha_object, SQ_SESSION);
   $captcha_code = $captcha_object->_phrase;



// need to correctly initiate session before we can put anything in it;
// for SquirrelMail 1.5.2+.... ugh... copied code from include/init.php



/**
 * calculate SM_PATH and calculate the base_uri
 * assumptions made: init.php is only called from plugins or from the src dir.
 * files in the plugin directory may not be part of a subdirectory called "src"
 *
 */
if (isset($_SERVER['SCRIPT_NAME'])) {
    $a = explode('/',$_SERVER['SCRIPT_NAME']);
} elseif (isset($HTTP_SERVER_VARS['SCRIPT_NAME'])) {
    $a = explode('/',$HTTP_SERVER_VARS['SCRIPT_NAME']);
} else {
    $error = 'Unable to detect script environment. '
        .'Please test your PHP settings and send PHP core config, $_SERVER '
        .'and $HTTP_SERVER_VARS to SquirrelMail developers.';
    die($error);
}
$sSM_PATH = '';
for($i = count($a) -2;$i > -1; --$i) {
    $sSM_PATH .= '../';
    if ($a[$i] === 'src' || $a[$i] === 'plugins') {
        break;
    }
}

$base_uri = implode('/',array_slice($a,0,$i)). '/';



/** set the name of the session cookie */
if (!isset($session_name) || !$session_name) {
    $session_name = 'SQMSESSID';
}

/**
 * if session.auto_start is On then close the session
 */
$sSessionAutostartName = session_name();
$sCookiePath = null;
if ((isset($sSessionAutostartName) || $sSessionAutostartName == '') &&
     $sSessionAutostartName !== $session_name) {
    $sCookiePath = ini_get('session.cookie_path');
    $sCookieDomain = ini_get('session.cookie_domain');
    // reset the cookie
    sqsetcookie($sSessionAutostartName,'',time() - 604800,$sCookiePath,$sCookieDomain);
    @session_destroy();
    session_write_close();
}

/**
 * includes from classes stored in the session
 */
require(SM_PATH . 'class/mime.class.php');

ini_set('session.name' , $session_name);
session_set_cookie_params (0, $base_uri);
sqsession_is_active();



   sqsession_register($captcha_code, 'captcha_code');


   // now output image
   //
   header('Content-Type: image/jpeg');
   echo $captcha_object->getCAPTCHAAsJPEG();



