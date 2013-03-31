<?php

/**
  * SquirrelMail CAPTCHA Plugin HN Captcha Backend
  * Copyright (c) 2006-2007 Horst Nogajski <horst@nogajski.de>
  * Copyright (c) 2007-2011 Paul Lesniewski <paul@squirrelmail.org>
  * Licensed under the GNU GPL. For full terms see the file COPYING.
  *
  * @package plugins
  * @subpackage captcha
  *
  */

global $captcha_TTF_folder, $captcha_fonts, $captcha_secret_string,
       $captcha_secret_position, $captcha_chars, $captcha_minimum_size,
       $captcha_maximum_size, $captcha_maximum_rotation, $captcha_noise,
       $captcha_web_safe_colors, $captcha_refresh_link, $captcha_language,
       $captcha_maximum_attempts, $captcha_banned_addrs, 
       $captcha_collect_garbage_after, $captcha_maxlifetime, $captcha_debug,
       $captcha_counter_filename, $captcha_filename_prefix,
       $captcha_temp_folder;



// Folder Path where your captcha font files are stored; 
// must be readable by the web server
//
// Don't forget the trailing slash
//
//$captcha_TTF_folder = '/usr/share/X11/fonts/TTF/';
$captcha_TTF_folder = SM_PATH . 'plugins/captcha/backends/b2evo/b2evo_captcha_fonts/';


// List of fonts available therein
//
//$captcha_fonts = array('luximb.ttf', 'luximbi.ttf', 'luximr.ttf', 'luximri.ttf', 
//                       'luxirb.ttf', 'luxirbi.ttf', 'luxirr.ttf', 'luxirri.ttf',
//                       'luxisb.ttf', 'luxisbi.ttf', 'luxisr.ttf', 'luxisri.ttf');
$captcha_fonts = array('FreeSans.ttf', 'FreeSerif.ttf', 'VeraSe.ttf', 'Vera.ttf');


// Please change this string to something to help
// add custom entropy to your key generation
//
$captcha_secret_string = 'SquirrelMail CAPTCHA Plugin HN Captcha Backend Secret String';


// More help with entropy 
// Integer between 1 and 32
//
$captcha_secret_position = 18;


// The number of characters to use for the captcha
//
$captcha_chars = 5;


// The minimum size of each character in the captcha
//
$captcha_minimum_size = 20;


// The maximum size of each character in the captcha
//
$captcha_maximum_size = 30;


// The maximum angle of rotation for each character 
// in the captcha (in degrees, usually between 0 and 30)
//
$captcha_maximum_rotation = 25;


// Whether or not to use "noisy" background
//   TRUE  = noisy background
//   FALSE = grid background
//
$captcha_noise = TRUE;


// Use web safe colors (only 216 colors)
//
$captcha_web_safe_colors = TRUE;


// Show refresh link?
//
$captcha_refresh_link = FALSE;


// Language (TODO: synch with SM language settings?)
// Only appears to support "en" or "de"...
// The SM CAPTCHA plugin does NOT use this
//
$captcha_language = 'en';


// Maximum number of allowed attempts
// The SM CAPTCHA plugin does NOT use this
//
$captcha_maximum_attempts = 3;


// List of addresses that are banned
//
$captcha_banned_addrs = '/';


// Number of captchas to generate before garbage collection is done
//
$captcha_collect_garbage_after = 20;


// Maximum lifetime of a captcha (in seconds) before being 
// deleted during garbage collection
//
$captcha_maxlifetime = 60;


// Debug flag
//
$captcha_debug = FALSE;


// Path and name of garbage collector counter filename 
// This must be readable and writable by the web server
//
// You don't usually need to change this for use with SquirrelMail
//
$captcha_counter_filename = SM_PATH . 'plugins/captcha/backends/hn_captcha/images/captcha_plugin_hn_captcha_backend_image_garbage_collector_counter.txt';


// Prefix of captcha image filenames
//
$captcha_filename_prefix = 'captcha_plugin_hn_captcha_backend_image_';


// Temporary work directory where image files can be stored; 
// must be readable and writable by the web server
//
// Don't forget the trailing slash
//
// You don't usually need to change this for use with SquirrelMail
//
$captcha_temp_folder = SM_PATH . 'plugins/captcha/backends/hn_captcha/images/';



