<?php

/**
  * textcapnum.tpl
  *
  * Template for login page controls added by the CAPTCHA plugin, 
  * Pear Text_CAPTCHA_Numeral backend
  *
  * The following variables are available in this template:
  *      + $operation  - The text of the CAPTCHA challenge
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
               <?php sq_change_text_domain('captcha'); echo sprintf(_("What is %s?"), $operation); sq_change_text_domain('squirrelmail'); ?>
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

