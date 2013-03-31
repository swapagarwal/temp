<?php

/**
  * SquirrelMail CAPTCHA Plugin Text_CAPTCHA Backend
  * Copyright (c) 20072-2011 Paul Lesniewski <paul@squirrelmail.org>
  * Licensed under the GNU GPL. For full terms see the file COPYING.
  *
  * @package plugins
  * @subpackage captcha
  *
  */


global $captcha_font_path, $captcha_font, $captcha_font_size,
       $captcha_width, $captcha_height;



// The height and width of the CAPTCHA image
//
$captcha_height = 80;
$captcha_width = 200;



// The font size to use in the CAPTCHA
//
$captcha_font_size = 24;



// The path to the location of your font files
//
//$captcha_font_path = '/usr/share/X11/fonts/TTF/';
$captcha_font_path = SM_PATH . 'plugins/captcha/backends/b2evo/b2evo_captcha_fonts/';



// The font to use in the CAPTCHA
//
//$captcha_font = 'luximb.ttf';
//$captcha_font = 'luximbi.ttf';
//$captcha_font = 'luximr.ttf';
//$captcha_font = 'luximri.ttf';
//$captcha_font = 'luxirb.ttf';
//$captcha_font = 'luxirbi.ttf';
//$captcha_font = 'luxirr.ttf';
//$captcha_font = 'luxirri.ttf';
//$captcha_font = 'luxisb.ttf';
//$captcha_font = 'luxisbi.ttf';
//$captcha_font = 'luxisr.ttf';
//$captcha_font = 'luxisri.ttf';
//$captcha_font = 'FreeSans.ttf';
//$captcha_font = 'FreeSerif.ttf';
//$captcha_font = 'VeraSe.ttf';
$captcha_font = 'Vera.ttf';



