<?php

/**
  * SquirrelMail CAPTCHA Plugin OpenCaptcha Backend
  * Copyright (c) 2007 Christopher Craig <chris@chriscraig.net>
  * Copyright (c) 2007-2011 Paul Lesniewski <paul@squirrelmail.org>
  * Licensed under the GNU GPL. For full terms see the file COPYING.
  *
  * @package plugins
  * @subpackage captcha
  *
  */

   global $minStringLength, $maxStringLength, $fontPath,
          $backgroundPath, $angle, $captchaCharacters, $captcha_case_sensitive,
          $minFontSize, $maxFontSize, $minLines, $maxLines, $shadow,
          $shadowOffsetX, $shadowOffsetY;


// Minimum length of the captcha string.
//
$minStringLength = 4;



// Maximum length of the captcha string.
//
$maxStringLength = 7;



// The maximum offset for the text angle from 90 degrees.
//
$angle = 20;



// Any charachters you want to show up in the captch string.
//
$captchaCharacters = "abcdefghijklmnopqrstuvwxyz1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%&";



// Make the captcha string case-sensitive.
//
$captcha_case_sensitive = FALSE;



// The minimum font size in points.
//
$minFontSize = 12;



// The maximum font size in points.
//
$maxFontSize = 24;



// Minimum number of lines to draw in the background.
//
$minLines = 2;



// Maximum number of lines to draw in the background.
//
$maxLines = 5;



// Add Drop shadow (TRUE/FALSE)
//
$shadow = TRUE;



// The x axis shadow offset (only used if $shadow is TRUE)
//
$shadowOffsetX = 1;



// The y axis shadow offset (only used if $shadow is TRUE)
//
$shadowOffsetY = 1;



// Must only include .ttf fonts.  Include trailing slash.
//
// For use with SquirrelMail, this usually need not be changed.
//
$fontPath = SM_PATH . 'plugins/captcha/backends/opencaptcha/captcha_fonts/';



// Must only include .png images.  Include trailing slash.
//
// For use with SquirrelMail, this usually need not be changed.
//
$backgroundPath = SM_PATH . 'plugins/captcha/backends/opencaptcha/captcha_backgrounds/';



