<?php

   if (file_exists('../../../../functions/global.php'))
   {
      define('SM_PATH', '../../../../');
      include_once(SM_PATH . 'include/constants.php');
      include_once(SM_PATH . 'functions/global.php');
   }
   else exit;


/*
============================
QuickCaptcha 1.0 - A bot-thwarting text-in-image web tool.
Copyright (c) 2006 Web 1 Marketing, Inc.

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.
============================
See settings.php for common settings. You shouldn't need to change
anything in this file.
============================
*/


if (!@include_once(SM_PATH . 'plugins/captcha/backends/quickcaptcha/quickcaptcha_config.php'))
   include_once(SM_PATH . 'plugins/captcha/backends/quickcaptcha/quickcaptcha_config_default.php');


// not used in this environment
$success = $failure = '';


// Keep #'s reasonable.
$min_thickness = max(1,$min_thickness);
$max_thickness = min(20,$max_thickness);
// Make radii into height/width
$min_radius *= 2;
$max_radius *= 2;
// Renormalize contrast
$contrast = 255 * ($contrast / 100.0);
$o_contrast = 1.3 * $contrast;

$width = 15 * imagefontwidth (5);
$height = 2.5 * imagefontheight (5);
$image = imagecreatetruecolor ($width, $height);
imagealphablending($image, true);
$black = imagecolorallocatealpha($image,0,0,0,0);

// Build the  validation string
$max = strlen($acceptedChars)-1;
$password = NULL;
for($i=0; $i < $stringlength; $i++) {
	$cnum[$i] = $acceptedChars{mt_rand(0, $max)};
	$password .= $cnum[$i];
}

// Add string to image
$rotated = imagecreatetruecolor (70, 70);
$x = 0;
for ($i = 0; $i < $stringlength; $i++) {
	$buffer = imagecreatetruecolor (20, 20);
	$buffer2 = imagecreatetruecolor (40, 40);
	
	// Get a random color
	$red = mt_rand(0,255);
	$green = mt_rand(0,255);
	$blue = 255 - sqrt($red * $red + $green * $green);
	$color = imagecolorallocate ($buffer, $red, $green, $blue);

	// Create character
	imagestring($buffer, 5, 0, 0, $cnum[$i], $color);

	// Resize character
	imagecopyresized ($buffer2, $buffer, 0, 0, 0, 0, 25 + mt_rand(0,12), 25 + mt_rand(0,12), 20, 20);

	// Rotate characters a little
	$rotated = imagerotate($buffer2, mt_rand(-25, 25),imagecolorallocatealpha($buffer2,0,0,0,0)); 
	imagecolortransparent ($rotated, imagecolorallocatealpha($rotated,0,0,0,0));

	// Move characters around a little
	$y = mt_rand(1, 3);
	$x += mt_rand(2, 6); 
	imagecopymerge ($image, $rotated, $x, $y, 0, 0, 40, 40, 100);
	$x += 22;

	imagedestroy ($buffer); 
	imagedestroy ($buffer2); 
}

// Draw polygons
if ($num_polygons > 0) for ($i = 0; $i < $num_polygons; $i++) {
	$vertices = array (
		mt_rand(-0.25*$width,$width*1.25),mt_rand(-0.25*$width,$width*1.25),
		mt_rand(-0.25*$width,$width*1.25),mt_rand(-0.25*$width,$width*1.25),
		mt_rand(-0.25*$width,$width*1.25),mt_rand(-0.25*$width,$width*1.25)
	);
	$color = imagecolorallocatealpha ($image, mt_rand(0,$o_contrast), mt_rand(0,$o_contrast), mt_rand(0,$o_contrast), $object_alpha);
	imagefilledpolygon($image, $vertices, 3, $color);  
}

// Draw random circles
if ($num_ellipses > 0) for ($i = 0; $i < $num_ellipses; $i++) {
	$x1 = mt_rand(0,$width);
	$y1 = mt_rand(0,$height);
	$color = imagecolorallocatealpha ($image, mt_rand(0,$o_contrast), mt_rand(0,$o_contrast), mt_rand(0,$o_contrast), $object_alpha);
//	$color = imagecolorallocate($image, mt_rand(0,$o_contrast), mt_rand(0,$o_contrast), mt_rand(0,$o_contrast));
	imagefilledellipse($image, $x1, $y1, mt_rand($min_radius,$max_radius), mt_rand($min_radius,$max_radius), $color);  
}

// Draw random lines
if ($num_lines > 0) for ($i = 0; $i < $num_lines; $i++) {
	$x1 = mt_rand(-$width*0.25,$width*1.25);
	$y1 = mt_rand(-$height*0.25,$height*1.25);
	$x2 = mt_rand(-$width*0.25,$width*1.25);
	$y2 = mt_rand(-$height*0.25,$height*1.25);
	$color = imagecolorallocatealpha ($image, mt_rand(0,$o_contrast), mt_rand(0,$o_contrast), mt_rand(0,$o_contrast), $object_alpha);
	imagesetthickness ($image, mt_rand($min_thickness,$max_thickness));
	imageline($image, $x1, $y1, $x2, $y2 , $color);  
}

// Draw random dots
if ($num_dots > 0) for ($i = 0; $i < $num_dots; $i++) {
	$x1 = mt_rand(0,$width);
	$y1 = mt_rand(0,$height);
	$color = imagecolorallocatealpha ($image, mt_rand(0,$o_contrast), mt_rand(0,$o_contrast), mt_rand(0,$o_contrast),$object_alpha);
	imagesetpixel($image, $x1, $y1, $color);
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



sqsession_register($password, 'captcha_private_string');

header('Content-type: image/png');
imagepng($image);
imagedestroy($image);
  
