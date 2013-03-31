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



/**
  * Validate that this backend is configured correctly
  *
  * @return boolean Whether or not there was a
  *                 configuration error for this backend.
  *
  */
function quickform_check_configuration()
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
function quickform_show_input_widgets()
{

   global $challenge_type, $figlet_fonts,
          $captcha_font_path, $captcha_font, 
          $captcha_font_size,
          $captcha_width, $captcha_height;


   if ($challenge_type == 5)
   {
      // uhhhh, in 1.5.2+ strings.php is not yet included?!?
      //
      include_once(SM_PATH . 'functions/strings.php');

      if (!check_sm_version(1, 5, 2)) sq_mt_randomize();
      $challenge_type = mt_rand(1, 4);
   }



   // Image
   //
   if ($challenge_type == 3)
   {
      if (check_sm_version(1, 5, 2))
         $image_source = sqm_baseuri() 
                       . 'plugins/captcha/backends/quickform/image_generator-1.5.2plus.php?sq=' . time();
      else
         $image_source = sqm_baseuri() 
                       . 'plugins/captcha/backends/quickform/image_generator.php?sq=' . time();
   }



   // all other non-graphical challenge types
   //
   else
   {

      require_once('HTML/QuickForm.php');
      $captcha = new HTML_QuickForm('qfCaptcha');


      // Mathematical Equation
      //
      if ($challenge_type == 1)
      {
         require_once('HTML/QuickForm/CAPTCHA/Equation.php');
         $captcha_type = 'CAPTCHA_Equation';
         $options = array(
                          'sessionVar' => 'captcha_object',
                         );
      }



      // FIGlet
      //
      else if ($challenge_type == 2)
      {
         require_once('HTML/QuickForm/CAPTCHA/Figlet.php');
         $captcha_type = 'CAPTCHA_Figlet';
         $options = array(
                          'sessionVar' => 'captcha_object',
                          'options' => array(
                                             'font_file' => $figlet_fonts
                                            )
                         );
      }



      // Spelled-out Numerals
      //
      else if ($challenge_type == 4)
      {
         require_once('HTML/QuickForm/CAPTCHA/Word.php');
         $captcha_type = 'CAPTCHA_Word';
         $options = array(
                          'sessionVar' => 'captcha_object',
                         );
      }



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



      // Mathematical Equation
      //
      if ($challenge_type == 1)
      {
         $captcha_text = $captcha_object->_equation;
      }



      // FIGlet
      //
      else if ($challenge_type == 2)
      {
         // note that this needs to be wrapped in <pre> tags:
         //
         $captcha_text = $captcha_object->_output_string;
      }



      // Spelled-out Numerals
      //
      else if ($challenge_type == 4)
      {
         // not immediately available in object, so rebuild
         // it on our own... this also makes it easier to translate
         //
         $captcha_text = '';
         sq_change_text_domain('captcha');
         for ($i = 0; $i < strlen($captcha_code); $i++)
            switch ($captcha_code{$i})
            {
               case 0:
                  $captcha_text .= _("zero ");
                  break;
               case 1:
                  $captcha_text .= _("one ");
                  break;
               case 2:
                  $captcha_text .= _("two ");
                  break;
               case 3:
                  $captcha_text .= _("three ");
                  break;
               case 4:
                  $captcha_text .= _("four ");
                  break;
               case 5:
                  $captcha_text .= _("five ");
                  break;
               case 6:
                  $captcha_text .= _("six ");
                  break;
               case 7:
                  $captcha_text .= _("seven ");
                  break;
               case 8:
                  $captcha_text .= _("eight ");
                  break;
               case 9:
                  $captcha_text .= _("nine ");
                  break;
            }
         sq_change_text_domain('squirrelmail');
         $captcha_text = trim($captcha_text);
      }



      // store answer in session
      // 
      sqsession_register($captcha_code, 'captcha_code');

   }


   // from SM 1.5.2 an up, just use our template
   //
   if (check_sm_version(1, 5, 2))
   {
      global $oTemplate;
      $oTemplate->assign('challenge_type', $challenge_type);
      if ($challenge_type == 3)
         $oTemplate->assign('image_source', $image_source);
      else
         $oTemplate->assign('captcha_text', $captcha_text);
      $output = $oTemplate->fetch('plugins/captcha/quickform.tpl');
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
              . "<tr><td><center>\n";

      if ($challenge_type == 3)  // Image
         $output .= '<img src="' . $image_source . '" alt="' . _("This is a CAPTCHA image; please enter the text you see in this image into the input box below") . '" title="" /><br /><br />' 
                 . _("Enter the text you see in the image above:")
                 . ' <input type="text" autocomplete="off" name="captcha_response" value="" size="10" />';
      else if ($challenge_type == 2)  // FIGlet
         $output .= '<pre>' . $captcha_text . '</pre>' 
                 . _("Enter the text you see above:")
                 . ' <input type="text" name="captcha_response" value="" autocomplete="off" size="10" />';
      else  // Math Equation or Spelled-out Words
         $output .= sprintf(_("What is %s?"), $captcha_text)
                 . ' <input type="text" name="captcha_response" value="" autocomplete="off" size="10" />';

      $output .= "\n</center></td></tr>\n</table>\n</center>\n";


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
function quickform_validate_captcha()
{

   // just bail if insufficient input is received
   //
   if (!sqGetGlobalVar('captcha_response', $captcha_response, SQ_FORM)
    || !sqGetGlobalVar('captcha_code', $captcha_code, SQ_SESSION)
    || empty($captcha_code))
      return FALSE;


   sqsession_unregister('captcha_code');
   sqsession_unregister('captcha_object');


   // test for no user input
   //
   if ($captcha_response === '')
      return NULL;


   return strtoupper($captcha_response) == strtoupper($captcha_code);

}



