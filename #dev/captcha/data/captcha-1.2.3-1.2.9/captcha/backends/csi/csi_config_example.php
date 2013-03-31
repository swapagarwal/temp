<?php

/**
  * SquirrelMail CAPTCHA Plugin CaptchaSecurityImages Backend
  * Copyright (c) 2006-2007 Simon Jarvis
  * Copyright (c) 2007-2011 Paul Lesniewski <paul@squirrelmail.org>
  * Licensed under the GNU GPL. For full terms see the file COPYING.
  *
  * @package plugins
  * @subpackage captcha
  *
  */


   global $captcha_width, $captcha_height,
          $captcha_number_characters, $captcha_font;



   // This is the number of characters you want to appear in your CAPTCHAs
   //
   $captcha_number_characters = 5;



   // This is the font for your CAPTCHAs
   //
   // This must be the filename of a font file that is located in the
   // CaptchaSecurityImages backend directory
   //
   $captcha_font = 'monofont.ttf';



   // This is how wide the CAPTCHA image will be
   //
   // Note that this value is liable to be overridden in SquirrelMail
   // 1.5.2+ by a skin if it so desires
   //
   $captcha_width = 120;



   // This is how high the CAPTCHA image will be
   //
   // Note that this value is liable to be overridden in SquirrelMail
   // 1.5.2+ by a skin if it so desires
   //
   $captcha_height = 40;



