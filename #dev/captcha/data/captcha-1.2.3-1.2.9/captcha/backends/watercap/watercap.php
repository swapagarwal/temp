<?php

/**
  * SquirrelMail CAPTCHA Plugin WaterCap Captcha Backend
  * Copyright (c) 2006-2007 Simon Jarvis
  * Copyright (c) 2007 Pavel Simakov
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
function watercap_check_configuration()
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
function watercap_show_input_widgets()
{

   // from SM 1.5.2 an up, just use our template
   //
   if (check_sm_version(1, 5, 2))
   {
      $image_source = sqm_baseuri() 
                    . 'plugins/captcha/backends/watercap/image_generator-1.5.2plus.php?sq=' . time();

      global $oTemplate;
      $oTemplate->assign('image_source', $image_source);
      $output = $oTemplate->fetch('plugins/captcha/watercap.tpl');
   }



   // old style output...
   //
   else
   {

      $image_source = sqm_baseuri() 
                    . 'plugins/captcha/backends/watercap/image_generator.php?sq=' . time();

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
              . ' <input type="text" autocomplete="off" name="captcha_response" value="" size="10" />'

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
function watercap_validate_captcha()
{

   // just bail if insufficient input is received
   //
   if (!sqGetGlobalVar('captcha_response', $captcha_response, SQ_FORM)
    || !sqGetGlobalVar('captcha_code', $captcha_code, SQ_SESSION)
    || empty($captcha_code))
      return FALSE;


   sqsession_unregister('captcha_code');


   // test for no user input
   //
   if ($captcha_response === '')
      return NULL;


   return strtoupper($captcha_response) == strtoupper($captcha_code);

}



