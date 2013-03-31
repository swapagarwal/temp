<?php

/**
  * SquirrelMail CAPTCHA Plugin
  * Copyright (c) 2007-2011 Paul Lesniewski <paul@squirrelmail.org>
  * Licensed under the GNU GPL. For full terms see the file COPYING.
  *
  * @package plugins
  * @subpackage captcha
  *
  */



/**
  * Initialize this plugin (load config values)
  *
  * @return boolean FALSE if no configuration file could be loaded, TRUE otherwise
  *
  */
function captcha_init()
{

   global $captcha_backend;


   if (!@include_once(SM_PATH . 'config/config_captcha.php'))
      if (!@include_once(SM_PATH . 'plugins/captcha/config.php'))
         return FALSE;


   // if the backend has a separate configuration file 
   // to load, include it too
   //
   if (!@include_once(SM_PATH . 'plugins/captcha/backends/' 
                              . $captcha_backend . '/' 
                              . $captcha_backend . '_config.php'))
      @include_once(SM_PATH . 'plugins/captcha/backends/' 
                            . $captcha_backend . '/' 
                            . $captcha_backend . '_config_default.php');

   return TRUE;

}



/**
  * Validate that this plugin is configured correctly
  *
  * @return boolean Whether or not there was a
  *                 configuration error for this plugin.
  *
  */
function captcha_check_configuration_do()
{

   global $captcha_backend,
          $show_captcha_countries, $do_not_show_captcha_countries;


   // make sure base config is available
   //
   if (!captcha_init())
   {
      do_err('CAPTCHA plugin is missing its main configuration file', FALSE);
      return TRUE;
   }



   // make sure correct backend files/functions are present
   //
   if (empty($captcha_backend))
   {
      do_err('CAPTCHA plugin backend is not configured', FALSE);
      return TRUE;
   }
   if (!@is_dir(SM_PATH . 'plugins/captcha/backends/' . $captcha_backend))
   {
      do_err('CAPTCHA plugin backend "' . $captcha_backend . '" is missing', FALSE);
      return TRUE;
   }
   if (!@include_once(SM_PATH . 'plugins/captcha/backends/' 
                              . $captcha_backend . '/' . $captcha_backend . '.php'))
   {
      do_err('CAPTCHA plugin backend "' . $captcha_backend . '" is incomplete', FALSE);
      return TRUE;
   }
   if (!function_exists($captcha_backend . '_show_input_widgets')
    || !function_exists($captcha_backend . '_validate_captcha'))
   {
      do_err('CAPTCHA plugin backend "' . $captcha_backend . '" is incomplete', FALSE);
      return TRUE;
   }



   // if the backend has a configtest to add, call it here
   //
   if (function_exists($captcha_backend . '_check_configuration'))
   {
      $function = $captcha_backend . '_check_configuration';
      if ($function())
         return TRUE;
   }



   // if CAPTCHA functionality is conditional, make sure we have
   // the User Information plugin and optionally that it has a
   // IP-to-country module loaded
   //
   if (!empty($show_captcha_countries) || !empty($do_not_show_captcha_countries)
    || !empty($hide_captcha_ips) || !empty($show_captcha_ips))
   {
      if (!file_exists(SM_PATH . 'plugins/user_info/functions.php'))
      {
         do_err('CAPTCHA plugin used with $hide_captcha_ips, $show_captcha_ips, $show_captcha_countries or $do_not_show_captcha_countries requires the User Information plugin', FALSE);
         return TRUE;
      }

      if (!empty($show_captcha_countries) || !empty($do_not_show_captcha_countries))
      {
         include_once(SM_PATH . 'plugins/user_info/functions.php');
         $user_info = get_user_info();
         if (empty($user_info['country_code']))
         {
            do_err('CAPTCHA plugin used with $show_captcha_countries or $do_not_show_captcha_countries requires the User Information plugin with a IP-to-country module', FALSE);
            return TRUE;
         }
      }
   }



   // only need to do this pre-1.5.2, as 1.5.2 will make this
   // check for us automatically
   //
   if (!check_sm_version(1, 5, 2))
   {

      // 1.4.17+ gets a pass on Compatibility plugin
      //
      if (check_sm_version(1, 5, 0) || !check_sm_version(1, 4, 17))
      {

         // try to find Compatibility, and then that it is v2.0.14+
         //
         if (function_exists('check_plugin_version')
          && check_plugin_version('compatibility', 2, 0, 14, TRUE))
            return FALSE;


         // something went wrong
         //
         do_err('CAPTCHA plugin requires the Compatibility plugin version 2.0.14+', FALSE);
         return TRUE;

      }

   }

}



/**
  * Show captcha inputs on login page
  *
  */
function captcha_show_input_widgets_do()
{

   global $captcha_backend, $hide_captcha_ips, $show_captcha_ips,
          $show_captcha_countries, $do_not_show_captcha_countries;
   captcha_init();


   // if CAPTCHA functionality is conditional upon the
   // IP address of the user, figure that out here
   //
   if (!empty($hide_captcha_ips) || !empty($show_captcha_ips)
    && file_exists(SM_PATH . 'plugins/user_info/functions.php'))
   {
      include_once(SM_PATH . 'plugins/user_info/functions.php');
      $user_info = get_user_info();
      if (!empty($user_info['ip_address']))
      {
         if (!empty($hide_captcha_ips)
          && captcha_match_ip_address($user_info['ip_address'], $hide_captcha_ips))
            return;
         if (!empty($show_captcha_ips)
          && !captcha_match_ip_address($user_info['ip_address'], $show_captcha_ips))
            return;
      }
   }


   // if CAPTCHA functionality is conditional upon the
   // country of the user, figure that out here
   //
   if (!empty($show_captcha_countries) || !empty($do_not_show_captcha_countries)
    && file_exists(SM_PATH . 'plugins/user_info/functions.php'))
   {
      include_once(SM_PATH . 'plugins/user_info/functions.php');
      $user_info = get_user_info();
      if (!empty($user_info['country_code']))
      {
         if (!empty($do_not_show_captcha_countries)
          && in_array($user_info['country_code'], $do_not_show_captcha_countries))
            return;
         if (!empty($show_captcha_countries)
          && !in_array($user_info['country_code'], $show_captcha_countries))
            return;
      }
   }


   // call correct captcha backend 
   //
   include_once(SM_PATH . 'plugins/captcha/backends/' 
                        . $captcha_backend . '/' . $captcha_backend . '.php');
   $function = $captcha_backend . '_show_input_widgets';
   $output = $function();
   

   // depending on SM version, either return or display output
   //
   if (check_sm_version(1, 5, 2))
      return array('login_form' => $output);
   else if (check_sm_version(1, 5, 1))
      return $output;
   else
      echo $output;

}



/**
  * Validate that correct captcha was sent
  *
  */
function captcha_validate_do()
{

   global $captcha_backend, $hide_captcha_ips, $show_captcha_ips,
          $show_captcha_countries, $do_not_show_captcha_countries,
          $log_CAPTCHA_events;
   captcha_init();


   // if CAPTCHA functionality is conditional upon the
   // IP address of the user, figure that out here
   //
   if (!empty($hide_captcha_ips) || !empty($show_captcha_ips)
    && file_exists(SM_PATH . 'plugins/user_info/functions.php'))
   {
      include_once(SM_PATH . 'plugins/user_info/functions.php');
      $user_info = get_user_info();
      if (!empty($user_info['ip_address']))
      {
         if (!empty($hide_captcha_ips)
          && captcha_match_ip_address($user_info['ip_address'], $hide_captcha_ips))
            return;
         if (!empty($show_captcha_ips)
          && !captcha_match_ip_address($user_info['ip_address'], $show_captcha_ips))
            return;
      }
   }


   // if CAPTCHA functionality is conditional upon the
   // country of the user, figure that out here
   //
   if (!empty($show_captcha_countries) || !empty($do_not_show_captcha_countries)
    && file_exists(SM_PATH . 'plugins/user_info/functions.php'))
   {
      include_once(SM_PATH . 'plugins/user_info/functions.php');
      $user_info = get_user_info();
      if (!empty($user_info['country_code']))
      {
         if (!empty($do_not_show_captcha_countries)
          && in_array($user_info['country_code'], $do_not_show_captcha_countries))
            return;
         if (!empty($show_captcha_countries)
          && !in_array($user_info['country_code'], $show_captcha_countries))
            return;
      }
   }


   // call correct captcha backend 
   //
   include_once(SM_PATH . 'plugins/captcha/backends/' 
                        . $captcha_backend . '/' . $captcha_backend . '.php');
   $function = $captcha_backend . '_validate_captcha';
   $validated = $function();


   // only needed for logging
   //
   if ($log_CAPTCHA_events && is_plugin_enabled('squirrel_logger'))
   {
      include_once(SM_PATH . 'plugins/squirrel_logger/functions.php');

      // what username did the user submit
      //
      global $login_username, $$login_username;
      $user = trim($login_username);


      // if password_forget is loaded, use the obfuscated name
      //
      if (is_plugin_enabled('password_forget'))
      {
         if (!isset($$login_username))
            sqgetGlobalVar($login_username, $$login_username, SQ_FORM);
         if ($$login_username != '')
           $user = trim($$login_username);
      }
   }


   // did the user fail to enter the right response?
   //
   if (!$validated)
   {

      // for now, we'll take care of the error message, although
      // some captcha backends may have slightly different ones
      // of their own
      //
      sq_change_text_domain('captcha');
      $error_msg = _("Sorry, you did not provide the correct challenge response.");
      sq_change_text_domain('squirrelmail');


      // log CAPTCHA results - note that to use this,
      // you'll need to have the Squirrel Logger plugin
      // installed and activated and you'll have to add
      // a "CAPTCHA" event type to its configuration
      //
      if ($log_CAPTCHA_events && is_plugin_enabled('squirrel_logger'))
      {
         if (is_null($validated))
            sl_logit('CAPTCHA', 'Wrong CAPTCHA (NO CAPTCHA input was given at all) (backend ' . $captcha_backend . ')', $user);
         else
            sl_logit('CAPTCHA', 'Wrong CAPTCHA (backend ' . $captcha_backend . ')', $user);
      }


      logout_error($error_msg);
      exit;
   }
   else
   {
      // log CAPTCHA results - note that to use this,
      // you'll need to have the Squirrel Logger plugin
      // installed and activated and you'll have to add
      // a "CAPTCHA" event type to its configuration
      //
      if ($log_CAPTCHA_events && is_plugin_enabled('squirrel_logger'))
      {
         sl_logit('CAPTCHA', 'Correct CAPTCHA (backend ' . $captcha_backend . ')', $user);
      }
   }

}



/**
  * Determine if an IP address matches one or more
  * of a list of IP addresses or address ranges.
  *
  * @param string $address    The address to test
  * @param array  $match_list The list of addresses or address ranges
  *                           to test against; each element is a string
  *                           that can be a plain IP address string, or
  *                           one with the * glob/wildcard (matches zero
  *                           or more digits or dots), or an address in
  *                           CIDR format.
  *
  * @return boolean TRUE if $address matches any of the addresses
  *                 or address ranges in $match_list, FALSE otherwise
  *
  */
function captcha_match_ip_address($address, $match_list)
{

   // check each test address
   //
   foreach ($match_list as $test_addr)
   {

      // addresses with asterisk in them can only be glob wildcard
      //
      if (strpos($test_addr, '*') !== FALSE)
      {
         $test_addr = str_replace(array('.', '*'), array('\.', '[0-9.]*'), $test_addr);
         if (preg_match('/^' . $test_addr . '$/', $address))
            return TRUE;
         else
            continue;
      }


      // addresses with "/" in them are CIDR format
      //
      if (strpos($test_addr, '/') !== FALSE)
      {
         list($network, $mask) = explode('/', $test_addr);
        
         $ip_number = ip2long($mask);
         if ($mask == long2ip($ip_number))
            $mask = $ip_number;
         else
            $mask = 0xffffffff << (32 - $mask);
        
         if ((ip2long($address) & $mask) == (ip2long($network) & $mask))
            return TRUE;
         else
            continue;
      }


      // other addresses should be normal ones, or just
      // junk, which won't match anyway
      //
      if ($address == $test_addr) return TRUE;

   }


   // no matches found
   //
   return FALSE;

}



