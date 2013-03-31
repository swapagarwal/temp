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
  * Register this plugin with SquirrelMail
  *
  */
function squirrelmail_plugin_init_captcha() {

   global $squirrelmail_plugin_hooks;

   $squirrelmail_plugin_hooks['login_before']['captcha']
      = 'captcha_validate';

   $squirrelmail_plugin_hooks['configtest']['captcha']
      = 'captcha_check_configuration';



   // SM 1.4.x
   //
   $squirrelmail_plugin_hooks['login_form']['captcha']
      = 'captcha_show_input_widgets';



   // SM 1.5.x
   //
   $squirrelmail_plugin_hooks['template_construct_login.tpl']['captcha']
      = 'captcha_show_input_widgets';

}



/**
  * Returns info about this plugin
  *
  */
function captcha_info()
{

   return array(
                 'english_name' => 'CAPTCHA',
                 'authors' => array(
                    'Paul Lesniewski' => array(
                       'email' => 'paul@squirrelmail.org',
                       'sm_site_username' => 'pdontthink',
                    ),
                 ),
                 'version' => '1.2.3',
                 'required_sm_version' => '1.2.9',
                 'requires_configuration' => 1,
                 'requires_source_patch' => 0,
                 'summary' => 'Places a CAPTCHA input on the login screen to prevent automated login attacks.',
                 'details' => 'This plugin places a CAPTCHA (Completely Automated Public Turing to tell Computers from Humans Apart) input on the login screen that is used to detect whether or not a human is attempting to log in.  This helps prevent automated login attacks.',
                 'per_version_requirements' => array(
                    '1.5.2' => array(
                       'required_plugins' => array()
                    ),
                    '1.5.0' => array(
                       'required_plugins' => array(
                          'compatibility' => array(
                             'version' => '2.0.14',
                             'activate' => FALSE,
                          )
                       )
                    ),
                    '1.4.17' => array(
                       'required_plugins' => array()
                    ),
                    '1.2.9' => array(
                       'required_plugins' => array(
                          'compatibility' => array(
                             'version' => '2.0.14',
                             'activate' => FALSE,
                          )
                       )
                    ),
                 ),
               );

}



/**
  * Returns version info about this plugin
  *
  */
function captcha_version()
{

   $info = captcha_info();
   return $info['version'];

}



/**
  * Show captcha inputs on login page
  *
  */
function captcha_show_input_widgets()
{

   include_once(SM_PATH . 'plugins/captcha/functions.php');
   return captcha_show_input_widgets_do();

}



/**
  * Validate that correct captcha was sent
  *
  */
function captcha_validate()
{

   include_once(SM_PATH . 'plugins/captcha/functions.php');
   captcha_validate_do();

}



/**
  * Validate that this plugin is configured correctly
  *
  */
function captcha_check_configuration()
{

   include_once(SM_PATH . 'plugins/captcha/functions.php');
   return captcha_check_configuration_do();

}



