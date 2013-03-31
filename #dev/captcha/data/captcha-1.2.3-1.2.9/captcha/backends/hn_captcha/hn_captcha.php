<?php

/**
  * SquirrelMail CAPTCHA Plugin HN Captcha Backend
  * Copyright (c) 2006-2007 Horst Nogajski <horst@nogajski.de>
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
function hn_captcha_check_configuration()
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
function hn_captcha_show_input_widgets()
{

   global $captcha_TTF_folder, $captcha_fonts, $captcha_secret_string,
          $captcha_secret_position, $captcha_chars, $captcha_minimum_size,
          $captcha_maximum_size, $captcha_maximum_rotation, $captcha_noise,
          $captcha_web_safe_colors, $captcha_refresh_link, $captcha_language,
          $captcha_maximum_attempts, $captcha_banned_addrs, 
          $captcha_collect_garbage_after, $captcha_maxlifetime, $captcha_debug,
          $captcha_counter_filename, $captcha_filename_prefix,
          $captcha_temp_folder;


   require_once(SM_PATH . 'plugins/captcha/backends/hn_captcha/hn_captcha.class.php');
   require_once(SM_PATH . 'plugins/captcha/backends/hn_captcha/hn_captcha.class.x1.php');


   $captcha = new hn_captcha_X1(array(
       'tempfolder' => $captcha_temp_folder,
       'TTF_folder' => $captcha_TTF_folder,
       'TTF_RANGE' => $captcha_fonts,
       'chars' => $captcha_chars,
       'minsize' => $captcha_minimum_size,
       'maxsize' => $captcha_maximum_size,
       'maxrotation' => $captcha_maximum_rotation,
       'noise' => $captcha_noise,
       'websafecolors' => $captcha_web_safe_colors,
       'refreshlink' => $captcha_refresh_link,
       'lang' => $captcha_language,
       'maxtry' => $captcha_maximum_attempts,
       'badguys_url' => $captcha_banned_addrs,
       'secretstring' => $captcha_secret_string,
       'secretposition' => $captcha_secret_position,
       'debug' => $captcha_debug,
       'counter_filename' => $captcha_counter_filename,
       'prefix' => $captcha_filename_prefix,
       'collect_garbage_after' => $captcha_collect_garbage_after,
       'maxlifetime' => $captcha_maxlifetime,
   ));



/* TODO: use this?
   if($captcha->garbage_collector_error)
   {
      // Error! (Counter-file or deleting lost images)
      //
      echo "<p><br><b>An ERROR has occured!</b><br>Here you might send email-notification to webmaster or something like that.</p>";
   }
*/



   list($image_source, $image_size) = $captcha->display_captcha(FALSE, TRUE);



   // from SM 1.5.2 an up, just use our template
   //
   if (check_sm_version(1, 5, 2))
   {
      global $oTemplate;
      $oTemplate->assign('image_source', $image_source);
      $oTemplate->assign('image_size', $image_size);
      $output = $oTemplate->fetch('plugins/captcha/hn_captcha.tpl');
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

              . '<img src="' . $image_source . '" alt="' . _("This is a CAPTCHA image; please enter the text you see in this image into the input box below") . '" title="" ' . $image_size . '/><br /><br />' 
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


   sqsession_register($captcha->public_key, 'captcha_public_key');
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
function hn_captcha_validate_captcha()
{

   // just bail if insufficient input is received
   //
   if (!sqGetGlobalVar('captcha_response', $captcha_response, SQ_FORM))
      return FALSE;


   global $captcha_TTF_folder, $captcha_fonts, $captcha_secret_string,
          $captcha_secret_position, $captcha_chars, $captcha_minimum_size,
          $captcha_maximum_size, $captcha_maximum_rotation, $captcha_noise,
          $captcha_web_safe_colors, $captcha_refresh_link, $captcha_language,
          $captcha_maximum_attempts, $captcha_banned_addrs, 
          $captcha_collect_garbage_after, $captcha_maxlifetime, $captcha_debug,
          $captcha_counter_filename, $captcha_filename_prefix,
          $captcha_temp_folder;


   require_once(SM_PATH . 'plugins/captcha/backends/hn_captcha/hn_captcha.class.php');
   require_once(SM_PATH . 'plugins/captcha/backends/hn_captcha/hn_captcha.class.x1.php');


   $captcha = new hn_captcha_X1(array(
       'tempfolder' => $captcha_temp_folder,
       'TTF_folder' => $captcha_TTF_folder,
       'TTF_RANGE' => $captcha_fonts,
       'chars' => $captcha_chars,
       'minsize' => $captcha_minimum_size,
       'maxsize' => $captcha_maximum_size,
       'maxrotation' => $captcha_maximum_rotation,
       'noise' => $captcha_noise,
       'websafecolors' => $captcha_web_safe_colors,
       'refreshlink' => $captcha_refresh_link,
       'lang' => $captcha_language,
       'maxtry' => $captcha_maximum_attempts,
       'badguys_url' => $captcha_banned_addrs,
       'secretstring' => $captcha_secret_string,
       'secretposition' => $captcha_secret_position,
       'debug' => $captcha_debug,
       'counter_filename' => $captcha_counter_filename,
       'prefix' => $captcha_filename_prefix,
       'collect_garbage_after' => $captcha_collect_garbage_after,
       'maxlifetime' => $captcha_maxlifetime,
   ));


   sqsession_unregister('captcha_public_key');


   // test for no user input
   //
   if ($captcha_response === '')
      return NULL;


   return $captcha->validate_submit() === 1;

}



