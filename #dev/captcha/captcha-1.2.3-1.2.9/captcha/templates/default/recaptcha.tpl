<?php

/**
  * recaptcha.tpl
  *
  * Template for login page controls added by the CAPTCHA plugin, 
  * reCAPTCHA backend
  *
  * The following variables are available in this template:
  *      + $recaptcha_uri       -  Host from which to get widget
  *      + $recaptcha_request   -  Page/script (on host) from which to get widget
  *      + $recaptcha_query     -  Query string to be sent when getting widget
  *      + $recaptcha_theme     -  Desired display theme
  *      + $recaptcha_tabindex  -  Desired tab index
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

   // SquirrelMail's JavaScript detection doesn't work until 
   // one page (login page for example) has been submitted
   // so we can't use checkForJavaScript() here, as it will
   // always try to just display the non-JavaScript code....
   // instead, we'll use a <noscript> tag to let the browser
   // decide which to display
   //
   if (!empty($recaptcha_theme) || !empty($recaptcha_tabindex))
      echo "<script language=\"JavaScript\" type=\"text/javascript\">\n"
         . "<!--\n"
         . "   var RecaptchaOptions = {\n"
         . (!empty($recaptcha_theme) ? "      theme : '" . $recaptcha_theme
                                     . (!empty($recaptcha_tabindex) ? "',\n" : "'\n")
                                     : '')
         . (!empty($recaptcha_tabindex) ? "      tabindex : " . $recaptcha_tabindex . "\n"
                                        : '')
         . "   };\n"
         . "//-->\n"
         . "</script>\n";

   echo "<script language=\"JavaScript\" type=\"text/javascript\" src=\""
      . $recaptcha_uri . '/challenge' . $recaptcha_query . "\"></script>\n"

      // iframe?!?  so much for older browser support...  also not sure
      // why they are using a textarea for the user input?!?
      //
      . "<noscript><iframe src=\""
      . $recaptcha_uri . '/noscript' . $recaptcha_query
      . "\" height=\"300\" width=\"500\" frameborder=\"0\"></iframe>\n"
      . "<textarea name=\"recaptcha_challenge_field\" rows=\"3\" cols=\"40\"></textarea>\n"
      . "<input type=\"hidden\" name=\"recaptcha_response_field\" value=\"manual_challenge\" /></noscript>\n";

?>
               </center>
            </td>
         </tr>
      </table>
      </center>
   </td>
</tr>

