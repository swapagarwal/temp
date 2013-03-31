<?php

   if (file_exists('../../../../functions/global.php'))
   {
      define('SM_PATH', '../../../../');
      include_once(SM_PATH . 'include/constants.php');
      include_once(SM_PATH . 'functions/global.php');
   } 
   else exit;


/*
* File: CaptchaSecurityImages.php
* Author: Simon Jarvis
* Copyright: 2006 Simon Jarvis
* Date: 03/08/06
* Updated: 07/02/07
* Requirements: PHP 4/5 with GD and FreeType libraries
* Link: http://www.white-hat-web-design.co.uk/articles/php-captcha.php
* 
* This program is free software; you can redistribute it and/or 
* modify it under the terms of the GNU General Public License 
* as published by the Free Software Foundation; either version 2 
* of the License, or (at your option) any later version.
* 
* This program is distributed in the hope that it will be useful, 
* but WITHOUT ANY WARRANTY; without even the implied warranty of 
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the 
* GNU General Public License for more details: 
* http://www.gnu.org/licenses/gpl.html
*
*/

class CaptchaSecurityImages {

	var $font;

	function generateCode($characters) {
		/* list all possible characters, similar looking characters and vowels have been removed */
		$possible = '23456789bcdfghjkmnpqrstvwxyz';
		$code = '';
		$i = 0;
		while ($i < $characters) { 
			$code .= substr($possible, mt_rand(0, strlen($possible)-1), 1);
			$i++;
		}
		return $code;
	}

	function CaptchaSecurityImages($width='120',$height='40',$characters='6',$font='') {

		if (empty($font)) 
			$font = SM_PATH . 'plugins/captcha/backends/csi/monofont.ttf';
		else
			$font = SM_PATH . 'plugins/captcha/backends/csi/' . $font;
		$this->font = $font;

		$code = $this->generateCode($characters);
		/* font size will be 75% of the image height */
		$font_size = $height * 0.75;
		$image = @imagecreate($width, $height) or die('Cannot initialize new GD image stream');
		/* set the colours */
		$background_color = imagecolorallocate($image, 255, 255, 255);
		$text_color = imagecolorallocate($image, 20, 40, 100);
		$noise_color = imagecolorallocate($image, 100, 120, 180);
		/* generate random dots in background */
		for( $i=0; $i<($width*$height)/3; $i++ ) {
			imagefilledellipse($image, mt_rand(0,$width), mt_rand(0,$height), 1, 1, $noise_color);
		}
		/* generate random lines in background */
		for( $i=0; $i<($width*$height)/150; $i++ ) {
			imageline($image, mt_rand(0,$width), mt_rand(0,$height), mt_rand(0,$width), mt_rand(0,$height), $noise_color);
		}
		/* create textbox and add text */
		$textbox = imagettfbbox($font_size, 0, $this->font, $code) or die('Error in imagettfbbox function');
		$x = ($width - $textbox[4])/2;
		$y = ($height - $textbox[5])/2;
		imagettftext($image, $font_size, 0, $x, $y, $text_color, $this->font , $code) or die('Error in imagettftext function');



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



		sqsession_register($code, 'security_code');
		/* output captcha image to browser */
		header('Content-Type: image/png');
		imagepng($image);
		imagedestroy($image);
	}

}


if (!sqGetGlobalVar('width', $width, SQ_GET)) 
   $width = '120';
if (!sqGetGlobalVar('height', $height, SQ_GET)) 
   $height = '40';
if (!sqGetGlobalVar('characters', $characters, SQ_GET)) 
   $characters = '6';
if (!sqGetGlobalVar('font', $font, SQ_GET)) 
   $font = 'monofont.ttf';


$captcha = new CaptchaSecurityImages($width, $height, $characters, $font);


