<?php

global $data_dir;


//
// Change these settings to change the way the captcha 
// generation works and match your server settings
//


// The minimum number of characters to use for the captcha
// Set to the same as maxchars to use fixed length captchas
//
$minchars = 5;


// The maximum number of characters to use for the captcha
// Set to the same as minchars to use fixed length captchas
//
$maxchars = 6;


// The minimum character font size to use for the captcha
// Set to the same as maxsize to use fixed font size
//
$minsize = 10;


// The maximum character font size to use for the captcha
// Set to the same as minsize to use fixed font size
//
$maxsize = 15;


// The maximum rotation (in degrees) for each character
//
$maxrotation = 25;


// Use background noise instead of a grid
//
$noise = TRUE;


// Use web safe colors (only 216 colors)
//
$websafecolors = TRUE;


// Enable debug messages
//
$debug = FALSE;


// Filename of garbage collector counter which is stored in the tempfolder
//
$counter_filename = 'captcha_plugin_hec_backend_image_garbage_collector_counter.txt';


// Prefix of captcha image filenames
//
$filename_prefix = 'captcha_plugin_hec_backend_image_';


// Number of captchas to generate before garbage collection is done
//
$collect_garbage_after = 50;


// Maximum lifetime of a captcha (in seconds) before being deleted during garbage collection
//
$maxlifetime = 600;


// Make all letters uppercase (does not preclude symbols)
//
$case_sensitive = FALSE;


// Folder Path where your captcha font files are stored; 
// must be readable by the web server
//
// Don't forget the trailing slash
//
// You don't usually need to change this for use with SquirrelMail
//
$TTF_folder = SM_PATH . 'plugins/captcha/backends/hec/Captcha_Fonts/';


// Temporary work directory where image files can be stored; 
// must be readable and writable by the web server
//
// Don't forget the trailing slash
//
// You don't usually need to change this for use with SquirrelMail
//
$tempfolder = $data_dir . '/captcha_plugin_hec_backend_images/';



//////////////////////////////////////////
//DO NOT EDIT ANYTHING BELOW THIS LINE!
//
//

//$folder_root = substr(__FILE__,0,(strpos(__FILE__,'.php')));
$folder_root = '.';

global $CAPTCHA_CONFIG;
$CAPTCHA_CONFIG = array('tempfolder'=>$tempfolder,'TTF_folder'=>$TTF_folder,'minchars'=>$minchars,'maxchars'=>$maxchars,'minsize'=>$minsize,'maxsize'=>$maxsize,'maxrotation'=>$maxrotation,'noise'=>$noise,'websafecolors'=>$websafecolors,'debug'=>$debug,'counter_filename'=>$counter_filename,'filename_prefix'=>$filename_prefix,'collect_garbage_after'=>$collect_garbage_after,'maxlifetime'=>$maxlifetime,'case_sensitive'=>$case_sensitive);

