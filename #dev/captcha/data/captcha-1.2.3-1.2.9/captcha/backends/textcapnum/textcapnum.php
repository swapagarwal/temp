<?php

/**
  * SquirrelMail CAPTCHA Plugin Text_CAPTCHA_Numeral Backend
  * Copyright (c) 1998-2007 David Coallier <davidc@agoraproduction.com>
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
function textcapnum_check_configuration()
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
function textcapnum_show_input_widgets()
{

   require_once('Text/CAPTCHA/Numeral.php');


   $text_cap_num = new Text_CAPTCHA_Numeral;
   $operation = $text_cap_num->getOperation();
   $answer = $text_cap_num->getAnswer();


   sqsession_register($answer, 'captcha_answer');



   // from SM 1.5.2 an up, just use our template
   //
   if (check_sm_version(1, 5, 2))
   {
      global $oTemplate;
      $oTemplate->assign('operation', $operation);
      $output = $oTemplate->fetch('plugins/captcha/textcapnum.tpl');
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

              . sprintf(_("What is %s?"), $operation) 
              . ' <input type="text" autocomplete="off" name="captcha_response" value="" size="5" />'

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
function textcapnum_validate_captcha()
{

   // just bail if insufficient input is received
   //
   if (!sqGetGlobalVar('captcha_response', $captcha_response, SQ_FORM)
    || !sqGetGlobalVar('captcha_answer', $captcha_answer, SQ_SESSION)
    || empty($captcha_answer))
      return FALSE;


   sqsession_unregister('captcha_answer');


   // test for no user input
   //
   if ($captcha_response === '')
      return NULL;


   return $captcha_response == $captcha_answer;

}



