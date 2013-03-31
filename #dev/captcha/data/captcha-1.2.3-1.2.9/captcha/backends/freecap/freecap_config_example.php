<?php

/**
  * SquirrelMail CAPTCHA Plugin freeCap Backend
  * Copyright (c) 2005-2007 Howard Yeend
  * Copyright (c) 2007-2011 Paul Lesniewski <paul@squirrelmail.org>
  * Licensed under the GNU GPL. For full terms see the file COPYING.
  *
  * @package plugins
  * @subpackage captcha
  *
  */


   global $site_tags, $tag_string, $tag_pos, $rand_func, $seed_func,
          $hash_func, $output, $use_dict, $dict_location, $max_word_length,
          $col_type, $max_attempts, $font_locations, $bg_type,
          $blur_bg, $bg_images, $merge_type, $morph_bg;


//$tag_string = 'freeCap v1.41 - puremango.co.uk';
//$tag_string = 'SquirrelMail CAPTCHA Plugin, freeCap Backend';
$tag_string = '';


// try to avoid the 'free p*rn' method of CAPTCHA circumvention
// see www.wikipedia.com/captcha for more info
//
$site_tags[0] = "To avoid spam, please do NOT enter the text if";
$site_tags[1] = "this site is not puremango.co.uk";
//
// or more simply:
//$site_tags[0] = "for use only on puremango.co.uk";
// reword or add lines as you please
// or if you don't want any text:
//
$site_tags = null;


// where to write the above:
// 0=top
// 1=bottom
// 2=both
//
$tag_pos = 1;


// functions to call for random number generation
// mt_rand produces 'better' random numbers
// but if your server doesn't support it, it's fine to use rand instead
//
$rand_func = "mt_rand";
$seed_func = "mt_srand";


// which type of hash to use?
// possible values: "sha1", "md5", "crc32"
// sha1 supported by PHP4.3.0+
// md5 supported by PHP3+
// crc32 supported by PHP4.0.1+
//
$hash_func = "sha1";


// image type:
// possible values: "jpg", "png", "gif"
// jpg doesn't support transparency (transparent bg option ends up white)
// png isn't supported by old browsers (see http://www.libpng.org/pub/png/pngstatus.html)
// gif may not be supported by your GD Lib.
//
$output = "png";


// 0=generate pseudo-random string, 1=use dictionary
// dictionary is easier to recognise
// - both for humans and computers, so use random string if you're paranoid.
//
$use_dict = 1;
//
// if your server is NOT set up to deny web access to files beginning ".ht"
// then you should ensure the dictionary file is kept outside the web directory
// eg: if www.foo.com/index.html points to c:\website\www\index.html
// then the dictionary should be placed in c:\website\dict.txt
// test your server's config by trying to access the dictionary through a web browser
// you should NOT be able to view the contents.
// can leave this blank if not using dictionary
//
$dict_location = SM_PATH . 'plugins/captcha/backends/freecap/.ht_freecap_words';


// used to calculate image width, and for non-dictionary word generation
//
$max_word_length = 6;


// text colour
// 0=one random colour for all letters
// 1=different random colour for each letter
//
$col_type = 1;


// maximum times a user can refresh the image
// on a 6500 word dictionary, I think 15-50 is enough to not annoy users and make BF unfeasble.
// further notes re: BF attacks in "avoid brute force attacks" section, below
// on the other hand, those attempting OCR will find the ability to request new images
// very useful; if they can't crack one, just grab an easier target...
// for the ultra-paranoid, setting it to <5 will still work for most users
//
$max_attempts = 20;


// list of fonts to use
// font size should be around 35 pixels wide for each character.
// you can use my GD fontmaker script at www.puremango.co.uk to create your own fonts
// There are other programs to can create GD fonts, but my script allows a greater
// degree of control over exactly how wide each character is, and is therefore
// recommended for 'special' uses. For normal use of GD fonts,
// the GDFontGenerator @ http://www.philiplb.de is excellent for convering ttf to GD
//
// the fonts included with freeCap *only* include lowercase alphabetic characters
// so are not suitable for most other uses
// to increase security, you really should add other fonts
//
$font_locations = Array(
    SM_PATH . 'plugins/captcha/backends/freecap/.ht_freecap_font1.gdf',
    SM_PATH . 'plugins/captcha/backends/freecap/.ht_freecap_font2.gdf',
    SM_PATH . 'plugins/captcha/backends/freecap/.ht_freecap_font3.gdf',
    SM_PATH . 'plugins/captcha/backends/freecap/.ht_freecap_font4.gdf',
    SM_PATH . 'plugins/captcha/backends/freecap/.ht_freecap_font5.gdf',
);


// background:
// 0=transparent (if jpg, white)
// 1=white bg with grid
// 2=white bg with squiggles
// 3=morphed image blocks
//
// 'random' background from v1.3 didn't provide any extra security (according to 2 independent experts)
// many thanks to http://ocr-research.org.ua and http://sam.zoy.org/pwntcha/ for testing
// for jpgs, 'transparent' is white
//
$bg_type = 2;
//
// should we blur the background? (looks nicer, makes text easier to read, takes longer)
//
$blur_bg = false;
//
// for bg_type 3, which images should we use?
// if you add your own, make sure they're fairly 'busy' images (ie a lot of shapes in them)
//
$bg_images = Array(
    SM_PATH . 'plugins/captcha/backends/freecap/.ht_freecap_im1.jpg',
    SM_PATH . 'plugins/captcha/backends/freecap/.ht_freecap_im2.jpg',
    SM_PATH . 'plugins/captcha/backends/freecap/.ht_freecap_im3.jpg',
    SM_PATH . 'plugins/captcha/backends/freecap/.ht_freecap_im4.jpg',
    SM_PATH . 'plugins/captcha/backends/freecap/.ht_freecap_im5.jpg',
);


//
// for non-transparent backgrounds only:
//
//      if 0, merges CAPTCHA with bg
//      if 1, write CAPTCHA over bg
//
        $merge_type = 0;
//
//      should we morph the bg? (recommend yes, but takes a little longer to compute)
//
        $morph_bg = true;



