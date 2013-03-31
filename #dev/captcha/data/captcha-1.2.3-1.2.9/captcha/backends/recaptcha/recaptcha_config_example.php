<?php

/**
  * SquirrelMail CAPTCHA Plugin reCAPTCHA Backend
  * Copyright (c) 2007-2011 Paul Lesniewski <paul@squirrelmail.org>
  * Licensed under the GNU GPL. For full terms see the file COPYING.
  *
  * @package plugins
  * @subpackage captcha
  *
  */


   global $recaptcha_public_key, $recaptcha_private_key,
          $recaptcha_tabindex, $recaptcha_theme,
          $recaptcha_verify_proxy_host, $recaptcha_verify_proxy_port;



   // These are your reCAPTCHA public and private keys - DO NOT
   // confuse them!
   //
   // See: https://www.google.com/recaptcha/admin/create
   //
   $recaptcha_public_key = '';
   $recaptcha_private_key = '';



   // This is the desired theme that will be provided by reCAPTCHA
   // See http://recaptcha.net/apidocs/captcha/
   //
   // Current acceptable values are "clean", "red", "white", and "blackglass"
   //   
   // Note that this value is liable to be overridden in SquirrelMail
   // 1.5.2+ by a skin if it so desires
   //
   $recaptcha_theme = 'white';



   // This value usually should not be changed
   //
   // Note that this value is liable to be overridden in SquirrelMail
   // 1.5.2+ by a skin if it so desires
   //
   $recaptcha_tabindex = 3;



   // If your system resides behind a proxy, the connection that is
   // made from SquirrelMail directly to the reCAPTCHA server to
   // verify user input may need to be routed through your proxy.
   // If this is the case, you need to specify the proxy's host name
   // and port below.
   //
   $recaptcha_verify_proxy_host = '';
   $recaptcha_verify_proxy_port = 0;



