<?php

/**
  * quickcaptcha.tpl
  *
  * Template for login page controls added by the CAPTCHA plugin,
  * QuickCaptcha backend
  *
  * The following variables are available in this template:
  *      + $image_source  - The image source for the CAPTCHA image
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
               <?php sq_change_text_domain('captcha'); echo '<img src="' . $image_source . '" alt="' . _("This is a CAPTCHA image; please enter the text you see in this image into the input box below") . '" title="" /><br /><br />' . _("Enter the text you see in the image above:"); sq_change_text_domain('squirrelmail'); ?>
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

