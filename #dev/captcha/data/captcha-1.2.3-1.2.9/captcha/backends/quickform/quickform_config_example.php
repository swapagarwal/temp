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


global $challenge_type, $figlet_fonts,
       $captcha_font_path, $captcha_font, 
       $captcha_font_size,
       $captcha_width, $captcha_height;



// This is the type of challenge that is to be presented to the user
//
//   1 = Mathematical Equation
//   2 = FIGlet (ASCII art)
//   3 = Image
//   4 = Spelled-out Numerals
//   5 = Random selection of any of the above
//   
$challenge_type = 5;



// Full path to a list of FIGlet (ASCII art) fonts, from
// which one will be picked randomly
//
// More FIGlet fonts are available from these places:
//
//   http://www.figlet.org/
//   http://www-personal.umich.edu/~knassen/figfonts/other/other.html  
//   http://www.jave.de/figlet/fonts.html
//   http://www-personal.umich.edu/~knassen/figsamples.html
//
$figlet_fonts = array(
          SM_PATH . 'plugins/captcha/backends/quickform/figlet_fonts/banner.flf',
          SM_PATH . 'plugins/captcha/backends/quickform/figlet_fonts/big.flf',
          SM_PATH . 'plugins/captcha/backends/quickform/figlet_fonts/block.flf',
          SM_PATH . 'plugins/captcha/backends/quickform/figlet_fonts/bubble.flf',
          SM_PATH . 'plugins/captcha/backends/quickform/figlet_fonts/digital.flf',
          SM_PATH . 'plugins/captcha/backends/quickform/figlet_fonts/ivrit.flf',
          SM_PATH . 'plugins/captcha/backends/quickform/figlet_fonts/lean.flf',
          SM_PATH . 'plugins/captcha/backends/quickform/figlet_fonts/mini.flf',
          SM_PATH . 'plugins/captcha/backends/quickform/figlet_fonts/script.flf',
          SM_PATH . 'plugins/captcha/backends/quickform/figlet_fonts/shadow.flf',
          SM_PATH . 'plugins/captcha/backends/quickform/figlet_fonts/slant.flf',
          SM_PATH . 'plugins/captcha/backends/quickform/figlet_fonts/smscript.flf',
          SM_PATH . 'plugins/captcha/backends/quickform/figlet_fonts/smshadow.flf',
          SM_PATH . 'plugins/captcha/backends/quickform/figlet_fonts/smslant.flf',
          SM_PATH . 'plugins/captcha/backends/quickform/figlet_fonts/standard.flf',
          SM_PATH . 'plugins/captcha/backends/quickform/figlet_fonts/term.flf',
                     );



// The height and width of CAPTCHA images
//
$captcha_height = 80;
$captcha_width = 200;



// The font size to use in CAPTCHA images
//
$captcha_font_size = 24;



// The path to the location of your font files
//
//$captcha_font_path = '/usr/share/X11/fonts/TTF/';
$captcha_font_path = SM_PATH . 'plugins/captcha/backends/b2evo/b2evo_captcha_fonts/';



// The font to use in CAPTCHA images
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



