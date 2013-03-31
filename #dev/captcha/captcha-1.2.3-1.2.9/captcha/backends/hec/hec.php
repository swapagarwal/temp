<?php

/**
  * SquirrelMail CAPTCHA Plugin HEC Backend
  * Copyright (c) 2006-2007 Julien Pachet
  * Copyright (c) 2006-2007 Horst Nogajski <horst@nogajski.de>
  * Copyright (c) 2006-2007 Ben Franske <ben@franske.com>
  * Copyright (c) 2006-2007 Ran Geva <ran@rangeva.com>
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
function hec_check_configuration()
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
function hec_show_input_widgets()
{

   global $CAPTCHA_CONFIG;
   require_once(SM_PATH . 'plugins/captcha/backends/hec/b2evo_captcha.class.php');


   // make sure temporary work directory exists
   //
   $work_dir = $CAPTCHA_CONFIG['tempfolder'];
   if (!@is_dir($work_dir)) mkdir($work_dir);


   $captcha = new b2evo_captcha($CAPTCHA_CONFIG);



   // from SM 1.5.2 an up, just use our template
   //
   if (check_sm_version(1, 5, 2))
   {
      global $oTemplate;
      $oTemplate->assign('captcha_html_contents', $captcha->Convert_Captcha(), FALSE);
      $output = $oTemplate->fetch('plugins/captcha/hec.tpl');
   }



   // old style output...
   //
   else 
   {

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

              . $captcha->Convert_Captcha() . "<br />\n"
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


   sqsession_register($captcha->GetHash(), 'captcha_hash');
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
function hec_validate_captcha()
{

   // just bail if insufficient input is received
   //
   if (!sqGetGlobalVar('captcha_response', $captcha_response, SQ_FORM)
    || !sqGetGlobalVar('captcha_hash', $captcha_hash, SQ_SESSION)
    || empty($captcha_hash))
      return FALSE;


   global $CAPTCHA_CONFIG;
   require_once(SM_PATH . 'plugins/captcha/backends/hec/b2evo_captcha.class.php');
   $captcha = new b2evo_captcha($CAPTCHA_CONFIG);


   sqsession_unregister('captcha_hash');


   // test for no user input
   //
   if ($captcha_response === '')
      return NULL;


   return $captcha->validate_submit($captcha_hash, $captcha_response);

}



