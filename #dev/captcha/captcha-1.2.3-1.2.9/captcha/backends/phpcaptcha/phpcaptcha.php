<?php

/**
  * SquirrelMail CAPTCHA Plugin PHP Captcha Backend
  * Copyright (c) 2007 Kerem Erkan <kerem@keremerkan.net>
  * Copyright (c) 2007-2011 Paul Lesniewski <paul@squirrelmail.org>
  * Licensed under the GNU GPL. For full terms see the file COPYING.
  *
  * @package plugins
  * @subpackage captcha
  *
  */



/**
  * Validate that this backend is configured correctly
  *
  * @return boolean Whether or not there was a
  *                 configuration error for this backend.
  *
  */
function phpcaptcha_check_configuration()
{

   // nothing to do; we could remove this function entirely,
   // but leaving it here just as an example

}



/**
  * Show captcha inputs on login page
  *
  * @return string The output destined for the browser
  *
  */
function phpcaptcha_show_input_widgets()
{

   // from SM 1.5.2 an up, just use our template
   //
   if (check_sm_version(1, 5, 2))
   {
      $image_source = sqm_baseuri() 
                    . 'plugins/captcha/backends/phpcaptcha/image-1.5.2plus.php?sq=' . time();

      global $oTemplate;
      $oTemplate->assign('image_source', $image_source);
      $output = $oTemplate->fetch('plugins/captcha/phpcaptcha.tpl');
   }



   // old style output...
   //
   else
   {

      $image_source = sqm_baseuri() 
                    . 'plugins/captcha/backends/phpcaptcha/image.php?sq=' . time();

      sq_change_text_domain('captcha');

      // really crappy placement of new login_form hook in 1.5.1
      //
      if (check_sm_version(1, 5, 1) && !check_sm_version(1, 5, 2))
         $output = "</td></tr>\n";
      else
         $output = '';


      // build regular output
      //
      $output .="<tr><td colspan=\"2\"><br /><center>\n"
              . "<table width=\"350\">\n"
              . "<tr><td><center>\n"

              . '<img src="' . $image_source . '" alt="' . _("This is a CAPTCHA image; please enter the text you see in this image into the input box below") . '" title="" /><br /><br />' 
              . _("Enter the text you see in the image above:")
              . ' <input type="text" autocomplete="off" name="captcha" value="" size="10" />'

              . "\n</center></td></tr>\n</table>\n</center>\n";


      // really crappy placement of new login_form hook in 1.5.1
      //
      if (check_sm_version(1, 5, 1) && !check_sm_version(1, 5, 2))
         $output .= '';
      else
         $output .= '</td></tr>';

      sq_change_text_domain('squirrelmail');

   }


   return $output;

}



/**
  * Validate that correct captcha was sent
  *
  * @return mixed TRUE if the correct captcha response was sent,
  *               FALSE if the user input was incorrect, or NULL
  *               when no user input was given.
  *
  */
function phpcaptcha_validate_captcha()
{

   // just bail if insufficient input is received
   //
   if (!sqGetGlobalVar('captcha', $post_captcha, SQ_FORM)
    || !sqGetGlobalVar('captcha', $session_captcha, SQ_SESSION)
    || empty($session_captcha))
      return FALSE;


   include_once(SM_PATH . 'plugins/captcha/backends/phpcaptcha/functions.php');
   $captcha_result = phpcaptcha_check_captcha();


   sqsession_unregister('captcha');


   // test for no user input
   //
   if ($post_captcha === '')
      return NULL;


   return ($captcha_result === 0);

}



