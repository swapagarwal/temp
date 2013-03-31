<?php


   // length of captcha code in number of characters
   //
   $captcha_length = 5;


   if (file_exists('../../../../functions/global.php'))
   {
      define('SM_PATH', '../../../../');
      include_once(SM_PATH . 'functions/global.php');
      include_once(SM_PATH . 'functions/strings.php');
   }
   else exit;


/*
*
* Name: WaterCap CAPTCHA Image Generator 
* Author: Pavel Simakov
* Copyright: 2007 Pavel Simakov
* Version: 0.9
* Requirements: PHP 4/5 with GD and FreeType libraries
* Link: http://www.softwaresecretweapons.com/jspwiki/Wiki.jsp?page=WaterCap_Strong_PHP_CAPTCHA_With_Negative_Spaces_And_Shadows
*
* Based on prior work of: Simon Jarvis
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

class WaterCap {
 
   var $font = '';

 
   function WaterCap ($code, $width='250', $height='60') {
	  
// choose your font...
//
//      $this->font = '../res/monofont.ttf';
//      $this->font = '/usr/share/X11/fonts/TTF/luximb.ttf';
//      $this->font = '/usr/share/X11/fonts/TTF/luximbi.ttf';
//      $this->font = '/usr/share/X11/fonts/TTF/luximr.ttf';
//      $this->font = '/usr/share/X11/fonts/TTF/luximri.ttf';
//      $this->font = '/usr/share/X11/fonts/TTF/luxirb.ttf';
//      $this->font = '/usr/share/X11/fonts/TTF/luxirbi.ttf';
//      $this->font = '/usr/share/X11/fonts/TTF/luxirr.ttf';
//      $this->font = '/usr/share/X11/fonts/TTF/luxirri.ttf';
//      $this->font = '/usr/share/X11/fonts/TTF/luxisb.ttf';
//      $this->font = '/usr/share/X11/fonts/TTF/luxisbi.ttf';
//      $this->font = '/usr/share/X11/fonts/TTF/luxisr.ttf';
//      $this->font = '/usr/share/X11/fonts/TTF/luxisri.ttf';
//      $this->font = SM_PATH . 'plugins/captcha/backends/b2evo/b2evo_captcha_fonts/FreeSans.ttf';
//      $this->font = SM_PATH . 'plugins/captcha/backends/b2evo/b2evo_captcha_fonts/FreeSerif.ttf';
//      $this->font = SM_PATH . 'plugins/captcha/backends/b2evo/b2evo_captcha_fonts/VeraSe.ttf';
      $this->font = SM_PATH . 'plugins/captcha/backends/b2evo/b2evo_captcha_fonts/Vera.ttf';


      /* seed random number gen to produce the same noise pattern time after time */
      mt_srand(crc32($code));	

      /* init image */
      $font_size = $height * 0.85;
      $image = @imagecreate($width, $height) or die('Cannot initialize new GD image stream');

      /* set the colours */
      $background_color = imagecolorallocate($image, 255, 255, 255);
      $text_color = imagecolorallocate($image, 20, 40, 100);
      $noise_color = imagecolorallocate($image, 100, 120, 180);

      /* create textbox and add text */
      $textbox = imagettfbbox($font_size, 0, $this->font, $code) or die('Error in imagettfbbox function');
      $x = ($width - $textbox[4])/2;
      $y = ($height - $textbox[5])/2;
      $d = -1;
      imagettftext($image, $font_size, 0, $x, $y, $text_color, $this->font , $code) or die('Error in imagettftext function');
      imagettftext(
	    $image, $font_size, 0, $x + $d, $y + $d, $noise_color, $this->font , $code
      ) or die('Error in imagettftext function');
      imagettftext(
	    $image, $font_size, 0, $x + 2 * $d + 1, $y + 2 * $d + 1, $noise_color, $this->font , $code
      ) or die('Error in imagettftext function');
      imagettftext(
	    $image, $font_size, 0, $x + 2 * $d, $y + 2 * $d, $background_color, $this->font , $code
      ) or die('Error in imagettftext function');

      /* mix in background dots */
      for( $i=0; $i<($width*$height)/10; $i++ ) { 
            imagefilledellipse($image, mt_rand(0,$width), mt_rand(0,$height), 1, 1, $background_color);		 
      }

      /* mix in text and noise dots */
      for( $i=0; $i<($width*$height)/25; $i++ ) { 
         imagefilledellipse($image, mt_rand(0,$width), mt_rand(0,$height), 1, 1, $noise_color);		 
	 imagefilledellipse($image, mt_rand(0,$width), mt_rand(0,$height), 1, 1, $text_color);		 
      }

      /* rotate a bit to add fuzziness */
      $image = imagerotate($image, 1, $background_color);

      /* output */
      header("Content-Type: image/png");
      imagepng($image);
      imagedestroy($image);
   }
}



function generateCode($number_characters) {
      /* list all possible characters, similar looking characters and vowels have been removed */
      // lower case letters such as g, p, q, y get cut off
      //$possible = '23456789bcdfghjkmnpqrstvwxyz';
      $possible = '23456789ABCDEFGHKMNPRSTVWXYZ';


      sq_mt_randomize();
      $code = '';
      $i = 0;
      while ($i < $number_characters) { 
         $code .= substr($possible, mt_rand(0, strlen($possible)-1), 1);
         $i++;
      }
      return $code;
   }




$captcha_code = generateCode($captcha_length);
sqsession_register($captcha_code, 'captcha_code');

$captcha = new WaterCap($captcha_code);


