<?

   if (file_exists('../../../../functions/global.php'))
   {
      define('SM_PATH', '../../../../');
      include_once(SM_PATH . 'include/constants.php');
      include_once(SM_PATH . 'functions/global.php');
   }
   else exit;

//---------------------------------------------------------------
//This program is free software; you can redistribute it and/or
//modify it under the terms of the GNU General Public License
//as published by the Free Software Foundation; either version 2
//of the License, or (at your option) any later version.
//
//This program is distributed in the hope that it will be useful,
//but WITHOUT ANY WARRANTY; without even the implied warranty of
//MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
//GNU General Public License for more details.
//
//Meezerk's CAPTCHA - A Computer Assisted Program for Telling 
//                    Computers and Humans Apart
//Copyright (C) 2004  Daniel Foster  dan_software@meezerk.com
//---------------------------------------------------------------

//Select size of image
$size_x = "150";
$size_y = "100";

//generate random string
$code = mt_rand("100000","999999");



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



//store captcha code in session vars
sqsession_register($code, 'captcha_code');

//create image to play with
$image = imageCreate($size_x,$size_y);


//add content to image
//------------------------------------------------------


//make background white - first colour allocated is background
$background = imageColorAllocate($image,255,255,255);



//select grey content number
$text_number1 = mt_rand("0","150");
$text_number2 = mt_rand("0","150");
$text_number3 = mt_rand("0","150");

//allocate colours
$white = imageColorAllocate($image,255,255,255);
$black = imageColorAllocate($image,0,0,0);
$text  = imageColorAllocate($image,$text_number1,$text_number2,$text_number3);



//get number of dots to draw
$total_dots = ($size_x * $size_y)/15;

//draw many many dots that are the same colour as the text
for($counter = 0; $counter < $total_dots; $counter++) {
  //get positions for dot
  $pos_x = mt_rand("0",$size_x);
  $pos_y = mt_rand("0",$size_y);

  //draw dot
  imageSetPixel($image,$pos_x,$pos_y,$text);
};



//draw border
imageRectangle($image,0,0,$size_x-1,$size_y-1,$black);



//get coordinates of position for string
//on the font 5 size, each char is 15 pixels high by 9 pixels wide
//with 6 digits at a width of 9, the code is 54 pixels wide

if (function_exists('bcmod')) 
   $func = 'bcmod';
else
   $func = 'my_bcmod';

$pos_x = $func($code,$size_x-60) +3;
$pos_y = $func($code,$size_y-15);

//draw random number
imageString($image,  5,  $pos_x,  $pos_y,  $code,  $text);


//------------------------------------------------------
//end add content to image


//send browser headers
header("Content-Type: image/jpeg");


//send image to browser
echo imageJPEG($image);


//destroy image
imageDestroy($image);



/**
 * my_bcmod - get modulus (substitute for bcmod)
 * string my_bcmod ( string left_operand, int modulus )
 * left_operand can be really big, but be carefull with modulus :(
 * by Andrius Baranauskas and Laurynas Butkus :) Vilnius, Lithuania
 **/
function my_bcmod( $x, $y )
{
    // how many numbers to take at once? carefull not to exceed (int)
    $take = 5;    
    $mod = '';

    do
    {
        $a = (int)$mod.substr( $x, 0, $take );
        $x = substr( $x, $take );
        $mod = $a % $y;   
    }
    while ( strlen($x) );

    return (int)$mod;
}

