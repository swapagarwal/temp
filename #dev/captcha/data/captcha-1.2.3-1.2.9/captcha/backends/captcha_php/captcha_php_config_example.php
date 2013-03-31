<?php

/**
  * SquirrelMail CAPTCHA Plugin Captcha PHP Backend
  * Copyright (c) 2002-2007 milky <http_from3.20.mario17@spamgourmet.org>
  * Copyright (c) 2007-2011 Paul Lesniewski <paul@squirrelmail.org>
  * Licensed under the GNU GPL. For full terms see the file COPYING.
  *
  * @package plugins
  * @subpackage captcha
  *
  */


   global $captcha_font_directory, $captcha_inverse, $captcha_timeout,
          $captcha_maxsize, $captcha_data_urls, $captcha_temp_directory;



// Location of fonts
//
$captcha_font_directory = SM_PATH . 'plugins/captcha/backends/captcha_php';



// Inverse colors?  
//    White = 0
//    Black = 1
//
$captcha_inverse = 0;



// Maximum lifespan of generated images (in seconds) before becoming 
// subject to garbage collection
//
$captcha_timeout = 5000;



// Preferred image size
//
$captcha_maxsize = 4500;



// RFC2397-URLs exclude MSIE users
//
$captcha_data_urls = 0;



// Temporary work directory; web server must 
// have read and write permissions for this directory
//
$captcha_temp_directory = SM_PATH . 'plugins/captcha/backends/captcha_php/images';



