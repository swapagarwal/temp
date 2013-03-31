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


   if (file_exists('../../../../functions/global.php'))
   {
      define('SM_PATH', '../../../../');
      include_once(SM_PATH . 'functions/global.php');
   }
   else exit;


   global $challenge_type, $figlet_fonts,
          $captcha_font_path, $captcha_font,
          $captcha_font_size,
          $captcha_width, $captcha_height;


   if (!@include_once(SM_PATH . 'plugins/captcha/backends/quickform/quickform_config.php'))
      include_once(SM_PATH . 'plugins/captcha/backends/quickform/quickform_config_default.php');


   require_once('HTML/QuickForm.php');
   require_once('Text/CAPTCHA.php');
   require_once('HTML/QuickForm/CAPTCHA/Image.php');


   $captcha_type = 'CAPTCHA_Image';
   $captcha = new HTML_QuickForm('qfCaptcha');
   $options = array(
      'sessionVar'    => 'captcha_object',
      'callback'      => '',
      'width'         => $captcha_width,
      'height'        => $captcha_height,
      'imageOptions'  => array(
                               'font_size' => $captcha_font_size,
                               'font_path' => $captcha_font_path,
                               'font_file' => $captcha_font,
                              )
                   );


   $captcha_question =& $captcha->addElement($captcha_type, '', '', $options);
   if (PEAR::isError($captcha_question))
   {
      echo $captcha_type . ' :: ' . $captcha_question->getMessage();
      exit;
   }


   // target phrase doesn't seem to get generated until output is delivered
   // so we will capture the output and get the answer phrase
   //
   ob_start();
   $captcha->display();
   ob_end_clean();

   sqGetGlobalVar('captcha_object', $captcha_object, SQ_SESSION);
   $captcha_code = $captcha_object->_phrase;
   sqsession_register($captcha_code, 'captcha_code');


   // now output image
   //
   header('Content-Type: image/jpeg');
   echo $captcha_object->getCAPTCHAAsJPEG();



