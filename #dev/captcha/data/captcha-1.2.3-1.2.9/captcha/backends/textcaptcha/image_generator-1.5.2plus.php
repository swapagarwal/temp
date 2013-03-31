<?php

/**
  * SquirrelMail CAPTCHA Plugin Text_CAPTCHA Backend
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
else
   exit;



if (!@include_once(SM_PATH . 'plugins/captcha/backends/textcaptcha/textcaptcha_config.php'))
   include_once(SM_PATH . 'plugins/captcha/backends/textcaptcha/textcaptcha_config_default.php');



global $captcha_font_path, $captcha_font, $captcha_font_size,
       $captcha_height, $captcha_width;


$captcha_options = array(
                         'font_size' => $captcha_font_size, 
                         'font_path' => $captcha_font_path,
                         'font_file' => $captcha_font,
                        );


require_once('Text/CAPTCHA.php');


$captcha = Text_CAPTCHA::factory('Image');
$return_value = $captcha->init($captcha_width, $captcha_height, null, $captcha_options);


if (PEAR::isError($return_value)) 
{
   echo 'Error generating CAPTCHA image';
   exit;
}



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



sqsession_register($captcha->getPhrase(), 'captcha_code');


$png = $captcha->getCAPTCHAAsPNG();


if (PEAR::isError($png)) 
{
   echo 'Error generating CAPTCHA image output';
   exit;
}


header('Content-Type: image/png');
echo $png;



