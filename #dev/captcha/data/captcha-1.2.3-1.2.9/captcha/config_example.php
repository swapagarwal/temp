<?php

/**
  * SquirrelMail CAPTCHA Plugin
  * Copyright (c) 2007-2011 Paul Lesniewski <paul@squirrelmail.org>
  * Licensed under the GNU GPL. For full terms see the file COPYING.
  *
  * @package plugins
  * @subpackage captcha
  *
  */


   global $captcha_backend, $log_CAPTCHA_events,
          $show_captcha_countries, $do_not_show_captcha_countries,
          $hide_captcha_ips, $show_captcha_ips;



   // If you'd like to log correct and incorrect CAPTCHA entries,
   // turn this on.  Note that logging is accomplished by using
   // the Squirrel Logger plugin, so you'll need to have that
   // installed and configured with an additional event type called
   // "CAPTCHA".
   //
   $log_CAPTCHA_events = 0;



   // This setting must be set to the desired backend.
   // The available backends and any requirements they
   // have are as follows:
   //
   //
   //   b2evo         b2evo captcha
   //                 See: http://sourceforge.net/projects/b2evo-captcha
   //                 Requires GD PHP extension (http://php.net/manual/ref.image.php)
   //                 Requires web server read and WRITE permissions on
   //                 the directory: plugins/captcha/backends/b2evo/images
   //                 The configuration file for this backend requires a custom
   //                 value for $secret_key to be configured before use.
   //                 (This version of b2evo is modified to prevent previous
   //                 easy cracks of the CAPTCHA value based on the image name.)
   //
   //   captcha_php   Captcha PHP
   //                 See: http://freshmeat.net/p/captchaphp
   //                 Requires GD PHP extension (http://php.net/manual/ref.image.php)
   //                 Requires web server read and WRITE permissions on
   //                 the directory: plugins/captcha/backends/captcha_php/images
   //                 Added some security fixes
   //
   //   csi           Captcha Security Images
   //                 See: http://www.white-hat-web-design.co.uk/articles/php-captcha.php
   //                 Requires GD PHP extension (http://php.net/manual/ref.image.php)
   //                 May not be secure; images generated are probably too simple;
   //                 easy to reverse engineer.
   //
   //   freecap       freeCap
   //                 See: http://www.puremango.co.uk/cm_php_captcha_script_113.php
   //                 Requires GD PHP extension (http://php.net/manual/ref.image.php)
   //
   //   hec           HTML Encoded Captcha
   //                 See: http://www.omgili.com/captcha.php
   //                 Requires GD PHP extension (http://php.net/manual/ref.image.php)
   //
   //   hn_captcha    HN Captcha
   //                 See: http://www.nogajski.de/horst/php/captcha/
   //                 Requires GD PHP extension (http://php.net/manual/ref.image.php)
   //                 Requires web server read and WRITE permissions on
   //                 the directory: plugins/captcha/backends/hn_captcha/images
   //                 Found itself with just two stars on the "weak list" at
   //                 http://ocr-research.org.ua/list/ppage/1.html
   //
   //   meezerk       Meezerk Captcha
   //                 See: http://www.php.meezerk.com/index.php?page=captcha
   //                 Requires GD PHP extension (http://php.net/manual/ref.image.php)
   //                 Appears to be too simple; probably easily hacked
   //
   //   opencaptcha   OpenCaptcha
   //                 See: http://chriscraig.net/blog/2007/01/31/opencaptcha-released/
   //                 Requires GD PHP extension (http://php.net/manual/ref.image.php)
   //
   //   phpcaptcha    PHP Captcha
   //                 See: http://blog.keremerkan.net/
   //                 Requires ImageMagick (http://www.imagemagick.org)
   //                 Requires MagickWand for PHP (http://www.magickwand.org)
   //                 Uses more complex image manipulation than GD libraries
   //                 can accomplish; written by a SquirrelMail contributor!
   //
   //   quickcaptcha  QuickCaptcha
   //                 See: http://www.web1marketing.com/resources/tools/quickcaptcha/
   //                 Requires GD PHP extension (http://php.net/manual/ref.image.php)
   //
   //   quickform     Pear HTML_QuickForm_CAPTCHA
   //                 See: http://pear.php.net/package/HTML_QuickForm_CAPTCHA
   //                 Requires Pear packages:
   //                    HTML_Common
   //                    HTML_QuickForm
   //                    Text_Password
   //                    Text_CAPTCHA
   //                    HTML_QuickForm_CAPTCHA
   //                 Optional Pear packages:
   //                    Image_Text (highly recommended)
   //                    Numbers_Words (recommended)
   //                    Text_Figlet (recommended)
   //                 Currently, some of these packages are in "alpha" or
   //                 "beta" state, so command-line installation looks like:
   //                    $ pear config-set preferred_state alpha
   //                    $ pear install <package>
   //                    $ pear config-set preferred_state stable
   //                 Or:
   //                    $ pear config-set preferred_state beta
   //                    $ pear install <package>
   //                    $ pear config-set preferred_state stable
   //                 Depending on the type of configured CAPTCHA, may or 
   //                 may not also require the GD PHP extension 
   //                 (http://php.net/manual/ref.image.php)
   //
   //   recaptcha     Remotely hosted, harnesses human work
   //                 See: http://recaptcha.net
   //                 to help digitize books
   //                 No server requirements
   //
   //   textcapnum    Pear Text_CAPTCHA_Numeral
   //                 See: http://pear.php.net/package/Text_CAPTCHA_Numeral
   //                 PHP 5+
   //                 Requires Pear packages:
   //                    Text_CAPTCHA_Numeral
   //                 Intended for security through obfuscation; generated
   //                 challenges are easily parsed by automated processes.
   //
   //   textcaptcha   Pear Text_CAPTCHA
   //                 See: http://pear.php.net/package/Text_CAPTCHA
   //                 Requires Pear packages:
   //                    Text_Password
   //                    Text_CAPTCHA
   //                 Optional Pear packages:
   //                    Image_Text (highly recommended)
   //                    Numbers_Words
   //                    Text_Figlet
   //                 Currently, some of these packages are in "alpha" or
   //                 "beta" state, so command-line installation looks like:
   //                    $ pear config-set preferred_state alpha
   //                    $ pear install <package>
   //                    $ pear config-set preferred_state stable
   //                 Or:
   //                    $ pear config-set preferred_state beta
   //                    $ pear install <package>
   //                    $ pear config-set preferred_state stable
   //                 Depending on the type of configured CAPTCHA, may or 
   //                 may not also require the GD PHP extension 
   //                 (http://php.net/manual/ref.image.php)
   //
   //   watercap      WaterCap
   //                 See: http://www.softwaresecretweapons.com/jspwiki/Wiki.jsp?page=WaterCap_Strong_PHP_CAPTCHA_With_Negative_Spaces_And_Shadows
   //                 Requires GD PHP extension (http://php.net/manual/ref.image.php)
   //
   //
   // NOTE that most of these have been modified slightly for use with this 
   // SquirrelMail plugin and also to patch security issues where necessary, 
   // which is NOT to say that all of these are foolproof or 100% secure
   //
   $captcha_backend = '';



   // You may configure this plugin to show the CAPTCHA input
   // only for users logging in from certain countries if you
   // also install the User Information plugin and configure
   // it with a IP-to-country module.
   //
   // If you do so, you can specify a list of countries for
   // which the CAPTCHA input should always be shown by listing
   // the relevant country codes as an array in
   // $show_captcha_countries.  All other countries will not
   // see the CAPTCHA input.
   //
   // Or, you can decide to show the CAPTCHA input for all but
   // a certain few countries by specifying those that should
   // not see it in $do_not_show_captcha_countries.
   //
   // If both of these lists have something in them, behavior
   // may not be as expected - be careful.
   //
   // The country codes (ISO 3166) to use can be found here:
   // http://www.iso.org/iso/country_codes
   //
   // $show_captcha_countries = array('US', 'KR', 'CN');
   //
   // $do_not_show_captcha_countries = array('GB', 'UK', 'FR', 'ES');
   //
   //
   $show_captcha_countries = array();
   $do_not_show_captcha_countries = array();



   // You may configure this plugin not to show the CAPTCHA
   // input only for users logging in from certain IP
   // addresses if you also install the User Information plugin.
   //
   // If you do so, you can specify a list of IP addresses or
   // IP address ranges for which the CAPTCHA input should
   // not be shown by listing the relevant IP addresses as
   // an array in $hide_captcha_ips.  All other IP addresses
   // will see the CAPTCHA input as usual.
   //
   // Or, more unusually, you can decide to show the CAPTCHA
   // input for a certain set or range of IP addresses by
   // specifying those that should see it in $show_captcha_ips.
   //
   // If both of these lists have something in them, behavior
   // may not be as expected - be careful.
   //
   // The IP addresses may be specified as full addresses,
   // with the * glob/wildcard (stands for zero or more digits
   // or dots) or CIDR notation may be used.
   //
   // $hide_captcha_ips = array('192.168.0.0/24', '10.10.10.*', '71.71.71.71');
   //
   // $show_captcha_ips = array('209.209.209.209', '151.*', '71.0.0.0/8');
   //
   //
   $hide_captcha_ips = array();
   $show_captcha_ips = array();



