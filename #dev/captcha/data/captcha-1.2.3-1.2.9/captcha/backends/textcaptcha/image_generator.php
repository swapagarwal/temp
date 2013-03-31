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


sqsession_register($captcha->getPhrase(), 'captcha_code');


$png = $captcha->getCAPTCHAAsPNG();


if (PEAR::isError($png)) 
{
   echo 'Error generating CAPTCHA image output';
   exit;
}


header('Content-Type: image/png');
echo $png;



