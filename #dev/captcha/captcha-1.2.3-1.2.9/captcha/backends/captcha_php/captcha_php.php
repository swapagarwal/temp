<?php

/**
  * SquirrelMail CAPTCHA Plugin Captcha PHP Backend
  * Copyright (c) 2002-2007 milky <http_from3.20.mario17@spamgourmet.org>
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
function captcha_php_check_configuration()
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
function captcha_php_show_input_widgets()
{

   global $captcha_temp_directory;
   require_once(SM_PATH . 'plugins/captcha/backends/captcha_php/captcha.php');



   // make sure temporary work directory exists
   //
   if (!@is_dir($captcha_temp_directory)) mkdir($captcha_temp_directory);



   // prepare image text
   //
   $pw = captcha::mkpass();
   $hash = captcha::hash($pw);
   $alt = htmlentities(captcha::textual_riddle($pw));


   // prepare image
   //
   $img = captcha::image($pw, 200, 60, CAPTCHA_INVERSE, CAPTCHA_MAXSIZE);

   if (!sqGetGlobalVar('HTTP_USER_AGENT', $http_user_agent, SQ_SERVER))
      $http_user_agent = '';

   if (CAPTCHA_DATA_URLS && !strpos("MSIE", $http_user_agent)) 
      $img_fn = "data:image/jpeg;base64," . base64_encode($img);
   else 
      $img_fn = CAPTCHA_BASE_URL . "?_tcf=" . captcha::store_image($img);



   // from SM 1.5.2 an up, just use our template
   //
   if (check_sm_version(1, 5, 2))
   {
      global $oTemplate;
      $oTemplate->assign('image_source', $img_fn);
      $oTemplate->assign('image_alt', $alt);
      $output = $oTemplate->fetch('plugins/captcha/captcha_php.tpl');
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

              . '<img src="' . $img_fn . '" alt="' . $alt . '" title="" height="60" width="200" /><br /><br />' 
              //. '<img src="' . $img_fn . '" alt="' . _("This is a CAPTCHA image; please enter the text you see in this image into the input box below") . '" title="" /><br /><br />'
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


   sqsession_register($hash, 'captcha_hash');
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
function captcha_php_validate_captcha()
{

   // just bail if insufficient input is received
   //
   if (!sqGetGlobalVar('captcha_response', $captcha_response, SQ_FORM)
    || !sqGetGlobalVar('captcha_hash', $captcha_hash, SQ_SESSION)
    || empty($captcha_hash))
      return FALSE;


   require_once(SM_PATH . 'plugins/captcha/backends/captcha_php/captcha.php');


   sqsession_unregister('captcha_hash');


   // test for no user input
   //
   if ($captcha_response === '')
      return NULL;


   return $captcha_hash == captcha::hash($captcha_response);

}



