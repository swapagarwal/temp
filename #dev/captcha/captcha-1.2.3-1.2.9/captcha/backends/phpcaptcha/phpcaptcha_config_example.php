<?php

/*
 * PHP Captcha 1.0
 * Copyright (C) 2007 Kerem Erkan <kerem@keremerkan.net>
 *
 * This is the configuration file of PHP Captcha. Edit it to suit your
 * needs. All variables have their explanations and usable default values.
 *
 * For the variables set in this file, PHP Captcha does not have
 * additional variable checks. That means you should not set a variable to
 * something it should not be set to (A variable expecting an integer to
 * an alphabetic character etc.) for your own sake.
 *
 * If the variable expects a string, place the string between quotation
 * marks like "jpg", if the variable expects a numeric value, DO NOT
 * place the numeric value between quotation marks.
 *
 * Try different variations, you will find the best results for your
 * needs. 
*/

/*
 * Image width in pixels
 *
 * Because of the computations in PHP Captcha, do not give a width less
 * than 200 pixels for optimal results.
*/
$width = 200;

/*
 * Image height in pixels
 *
 * Because of the computations in PHP Captcha, do not give a height less
 * than 80 pixels for optimal results.
*/
$height = 80;

/*
 * String expiration in seconds
 *
 * Set to 0 to disable CAPTCHA string expiration, or to a positive integer
 * to have an expiration time in seconds. For example, if you set this
 * variable to 300, and the user does not post the string in 300 or less
 * seconds, even if he/she sends the correct answer, the answer will not
 * be accepted.
 *
 * Set to 0 for better user experience or to a positive integer for
 * stronger security.
*/
$expiration_time = 0;

/*
 * Type of image (png or jpg)
 *
 * png gives the best image, while it has bigger size.
 * jpg gives degraded quality while it has smaller size.
 *
 * For better bandwidth management, use jpg.
*/
$image_type = "jpg";

/*
 * Image foreground noise
 *
 * Set to 0 to disable foreground noise, 1 to enable it.
 * You should better disable foreground noise to have the
 * optimum readability.
*/
$foreground_noise = 0;

/*
 * Image background noise amplification
 *
 * Set to 0 to disable background noise, or set to a positive
 * integer to have background noise. The bigger the integer, the
 * more noise applied to the background.
 *
 * Do not set this variable too high in order to have the optimum
 * amount of background noise.
*/
$background_noise = 2;

/*
 * Number of random lines to draw before writing captcha text
 *
 * More lines mean a more garbled background.
*/
$number_of_lines = 30;

/*
 * Number of random ellipses to draw before writing captcha text
 *
 * More ellipses mean a more garbled background.
*/
$number_of_ellipses = 20;

/*
 * Number of random beziers to draw before writing captcha text
 *
 * More beziers mean a more garbled background.
*/
$number_of_beziers = 15;

/*
 * Font of captcha text
 *
 * The font should be one of the fonts contained in the "fonts" directory
 * of PHP Captcha.
*/
$font = "verdana-bold.ttf";

/*
 * Font size of captcha text in points
 *
 * For different fonts, different sizes will be more suitable. You will
 * have to find the most suitable size.
 * To have a fixed size, set the minimum and maximum to the same size.
*/
$min_font_size = 34;
$max_font_size = 40;

/*
 * Length of captcha text
 *
 * To have a fixed length, set the minimum and maximum to the same length.
 * 3 to 5 characters should be enough for most occasions. More than 6 will
 * probably be overkill.
*/
$min_string_length = 4;
$max_string_length = 5;

/*
 * Minimum correct characters needed for correct answer
 *
 * Set this variable to the minimum correct characters you would like to
 * have your users enter. For example, you may have a CAPTCHA string that
 * is 8 characters long, but you may require your users to enter minimum
 * 5 correct characters. This way, if your users cannot read 3 characters
 * in the image, they can still give a right answer.
 *
 * When this variable is correctly set, PHP Captcha will have to make a
 * character to character comparition, which means that text direction
 * will be meaningless and also md5 encryption of $_SESSION["captcha"]
 * variable will be impossible. So this will disable the text_direction"
 * and "text_direction_pointer" variables alongside the encryption. For
 * more strict security, set this variable to 0. For better usability by
 * your users, set this variable to a value between 2 and
 * "min_string_length" variable. Be aware that, bots will guess your
 * CAPTCHA much more likely when this variable is set. So you should use
 * this variable only in less important sites where bots don't tend to
 * go.
 *
 * Setting this variable to 0 (zero) or a value higher than the value of
 * "min_string_length" variable will disable this variable meaning that,
 * your users will need to enter all characters they see in the image.
*/
$min_correct_characters = 0;

/*
 * Text direction of captcha text
 *
 * You can set "LR" for left to right, "RL" for right to left or "none"
 * to have your users enter the letters in a random order.
 *
 * You can randomize the value of this variable if you call the function,
 * "phpcaptcha_set_random_text_direction". This way, you can randomize
 * the direction of the text and require your users to enter the
 * characters from "left to right" or "right to left" randomly. After
 * randomizing, the value of this variable will be "LR" or "RL".
 *
 * If you set the value of this variable to anything other than the 3
 * options above, AND you do not randomize it by calling the function
 * mentioned above, "LR" will be used as default.
*/
$text_direction = "LR";

/*
 * Text direction pointer in image
 *
 * You can set to 0 to disable the pointer or 1 to enable it in the
 * image. If you randomize the text direction like explained above, you
 * should better include this pointer in your image to show the direction
 * to enter the text to your users. If you don't include this pointer and
 * still want to randomize the direction, you must check the value of
 * $_SESSION["captcha_text_direction"] variable, which will include the
 * text direction like "LR" or "RL" and tell the direction to your users
 * on your page accordingly.
*/
$text_direction_pointer = 0;

/*
 * Characters to use in captcha text
 *
 * You can set "L" for lowercase, "U" for uppercase and "N" for numbers.
 * You may mix all of these like "LUN", "UN", "LU", etc. or you may choose
 * to use only one type like "L", "U" or "N".
 *
 * For optimum user experience, use only uppercase letters and numbers.
*/
$text_type = "UN";

/*
 * Case sensitivity of captcha text
 *
 * You can set to 0 for case insensitive, or 1 for case sensitive.
 *
 * Your control should better be case insensitive for optimum results.
*/
$text_case_sensitive = 0;

/*
 * Color of captcha text
 *
 * The color of the text can be "light", "dark" or "random".
 * If you choose "light", the text stroke color will be white or
 * near-white, and the background will be lighter, while if you choose
 * "dark", the text stroke color will be black or near-black, and the
 * background will be darker.
 * If you choose "random", then "light" or "dark" will be picked randomly.
 * If you set anything other than "light", "dark" or "random", "random"
 * will be used as default.
*/
$text_color = "random";

/*
 * Minimum and maximum transparency of captcha text fill.
 *
 * The transparency values must be between 0 and 100.
 * 0 means fully transparent, while 100 means fully opaque.
 *
 * Text stroke will always be fully opaque.
 *
 * Set both variables to the same number to have a fixed transparency.
*/
$minimum_text_alpha = 40;
$maximum_text_alpha = 100;

/*
 * Minimum and maximum rotation of captcha text
 *
 * Setting both to 0 means no rotation will occur.
 * To get most readable results, do not set the maximum angle to more than
 * 80 to 90 degrees to have a readable text. Also do not set these below
 * 0, because the angle will randomly be converted to its negative value.
*/
$min_rotation_angle = 10;
$max_rotation_angle = 30;

/*
 * Minimum and maximum swirl angles
 *
 * Setting both to 0 means no swirling will occur.
 * Do not set these above 100, since the text will probably be swirled too
 * much that you will not be able to read it. Also do not set these below
 * 0, because the angle will randomly be converted to its negative value.
*/
$min_swirl_angle = 25;
$max_swirl_angle = 35;

/*
 * Motion blur parameters
 *
 * Set "$motion_blur_radius" to 0 to disable motion blur.
 * For good results, sigma should be smaller than radius.
 * Do not set these to any number higher than 3 in order to have a
 * readable text.
*/
$motion_blur_radius = 2;
$motion_blur_sigma = 1;

/*
 * Image border in pixels
 *
 * Set to 0 to have no border, or an integer to have a border around the
 * image that pixels thick.
*/
$border_thickness = 1;

/*
 * Image border color
 *
 * You can set the border color to a string like "black" or "white" for
 * simple colors, or you can specify the exact color like "#FFCC00". If you
 * leave this string empty, the border color will be chosen randomly.
*/
$border_color = "black";

