<?php

/**
  * quickform.tpl
  *
  * Template for login page controls added by the CAPTCHA plugin,
  * Pear HTML_QuickForm_CAPTCHA backend
  *
  * The following variables are available in this template:
  *      + $challenge_type - 1 if Math Equation, 2 if FIGlet, 3 if Image
  *                          4 if Spelled-out Words
  *      + $image_source   - The image source for the CAPTCHA image if 
  *                          $challenge_type is Image type
  *      + $captcha_text   - The challenge text if $challenge_type is
  *                          something other than the Image type
  *
  * @copyright &copy; 1999-2011 The SquirrelMail Project Team
  * @license http://opensource.org/licenses/gpl-license.php GNU Public License
  * @version $Id$
  * @package squirrelmail
  * @subpackage plugins
  */


// retrieve the template vars
//
extract($t);


?>

<tr>
   <td colspan="2">
      <br />
      <center>
      <table width="350">
         <tr>
            <td>
               <center>
<?php 
   sq_change_text_domain('captcha'); 

   if ($challenge_type == 3) // Image
      echo '<img src="' . $image_source . '" alt="' . _("This is a CAPTCHA image; please enter the text you see in this image into the input box below") . '" title="" /><br /><br />' . _("Enter the text you see in the image above:"); 
   else if ($challenge_type == 2) // FIGlet
      echo '<pre>' . $captcha_text . '</pre>' . _("Enter the text you see above:"); 
   else // Math Equation or Spelled-out Words
      echo sprintf(_("What is %s?"), $captcha_text);

   sq_change_text_domain('squirrelmail'); 
?>
               <input type="text" autocomplete="off" name="captcha_response" size="10" value="" />
               <br />
               <br />
               </center>
            </td>
         </tr>
      </table>
      </center>
   </td>
</tr>

