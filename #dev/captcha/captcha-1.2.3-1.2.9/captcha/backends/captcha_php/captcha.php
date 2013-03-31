<?php

   // this file can be called directly by the browser *OR* included 
   // from another file... ugh... might be better to split that out
   // by calling another file (see very bottom of this file, although
   // this should work fine)
   //
   if (!defined('SM_PATH'))
   {
      if (file_exists('../../../../functions/global.php'))
      {

         define('SM_PATH', '../../../../');
         include_once(SM_PATH . 'functions/global.php');

         if (!@include_once(SM_PATH . 'plugins/captcha/backends/captcha_php/captcha_php_config.php'))
            include_once(SM_PATH . 'plugins/captcha/backends/captcha_php/captcha_php_config_default.php');

         // copied from 1.5.2 include/init.php
         //
         if (!function_exists('sqm_baseuri'))
         {
            /**
             * calculate SM_PATH and calculate the base_uri
             * assumptions made: init.php is only called from plugins or from the src dir.
             * files in the plugin directory may not be part of a subdirectory called "src"
             *
             */
            if (isset($_SERVER['SCRIPT_NAME'])) {
                $a = explode('/',$_SERVER['SCRIPT_NAME']);
            } elseif (isset($HTTP_SERVER_VARS['SCRIPT_NAME'])) {
                $a = explode('/',$HTTP_SERVER_VARS['SCRIPT_NAME']);
            } else {
                $error = 'Unable to detect script environment. '
                    .'Please test your PHP settings and send PHP core config, $_SERVER '
                    .'and $HTTP_SERVER_VARS to SquirrelMail developers.';
                die($error);
            }
            $sSM_PATH = '';
            for($i = count($a) -2;$i > -1; --$i) {
                $sSM_PATH .= '../';
                if ($a[$i] === 'src' || $a[$i] === 'plugins') {
                    break;
                }
            }

            global $base_uri;
            $base_uri = implode('/',array_slice($a,0,$i)). '/';

            function sqm_baseuri()
            {
               global $base_uri;
               return $base_uri;
            }
         }

      }
      else exit;
   }

/*
   Does emit a CAPTCHA graphic and form fields, which allows to tell real
   people from bots.
   Though a textual description is generated as well, this sort of access
   restriction will knock out visually impaired users, and frustrate all
   others anyhow. Therefore this should only be used as last resort for
   defending against spambots. Because of the readable text and the used
   colorspaces this is a weak implementation, not completely OCR-secure.

   captcha::form() will return a html string to be inserted into textarea/
   [save] <forms> and alike. User input is veryfied with captcha::check().
   You should leave the sample COLLEGE.ttf next to this script, else you
   have to define the _FONT_DIR constant correctly. Use only 1 font type.
   
   Creates temporary files, which however get purged automatically after
   four hours.

   Public Domain, available via http://freshmeat.net/p/captchaphp
*/


#-- config
global $captcha_font_directory, $captcha_inverse, $captcha_timeout, 
       $captcha_maxsize, $captcha_data_urls, $captcha_temp_directory;


define("EWIKI_FONT_DIR", $captcha_font_directory);   // which fonts to use
define("CAPTCHA_INVERSE", $captcha_inverse);         // white or black(=1)
define("CAPTCHA_TIMEOUT", $captcha_timeout);         // in seconds (=max 4 hours)
define("CAPTCHA_MAXSIZE", $captcha_maxsize);         // preferred image size
define("CAPTCHA_DATA_URLS", $captcha_data_urls);     // RFC2397-URLs exclude MSIE users
define("CAPTCHA_TEMP_DIR", $captcha_temp_directory);

define("CAPTCHA_BASE_URL", sqm_baseuri() . 'plugins/captcha/backends/captcha_php/captcha.php');

// bad idea to use cookie to determine passage
//define("CAPTCHA_COOKIE", "captcha_solved");   // to unlock captcha protection


/* static - (you could instantiate it, but...) */
class captcha {


   /* gets parameter from $_REQUEST[] array (POST vars) and so can
      verify input, @returns boolean
   */
   function check() {
// bad idea to use cookie to determine passage
/*
      $to = (int)(time()/1000000);
      if ($_COOKIE[CAPTCHA_COOKIE] == $to) {
         return(true);
      }
*/
      if (!sqGetGlobalVar('captcha_hash', $captcha_hash, SQ_SESSION))
         $captcha_hash = '';
      if (!sqGetGlobalVar('captcha_response', $captcha_input, SQ_FORM))
         $captcha_input = '';

//NOTE -- $hash is undefined... should cause notices... aw, heck, we just won't use this fxn
      if (($hash = $captcha_hash)
//NOTE -- $pw is undefined... should cause notices... aw, heck, we just won't use this fxn
      and ($pw = trim($captcha_input))) {
         $r = (captcha::hash($pw)==$hash) || (captcha::hash($pw,-1)==$hash);
         if ($r) {
// bad idea to use cookie to determine passage
//            sqsetcookie(CAPTCHA_COOKIE, $to, time()+1000000);
         }
         return($r);
      }
   }

   
   /* yields <input> fields html string (no complete form), with captcha
      image already embedded as data:-URI
   */
   function form($title="&rarr; retype that here", $more="<small>Enter the correct letters and numbers from the image into the text box. This small test serves as access restriction against malicious bots. Simply reload the page if this graphic is too hard to read.</small>") {

// bad idea to use cookie to determine passage
/*
      #-- stop if user already verified
      if ($_COOKIE[CAPTCHA_COOKIE] == (int)(time()/1000000)) {
         return "";
      }
*/

      #-- prepare image text
      $pw = captcha::mkpass();
      $hash = captcha::hash($pw);
      $alt = htmlentities(captcha::textual_riddle($pw));

      #-- image
      $img = captcha::image($pw, 200, 60, CAPTCHA_INVERSE, CAPTCHA_MAXSIZE);
      if (!sqGetGlobalVar('HTTP_USER_AGENT', $http_user_agent, SQ_SERVER))
         $http_user_agent = '';
      if (CAPTCHA_DATA_URLS && !strpos("MSIE", $http_user_agent)) {
         $img_fn = "data:image/jpeg;base64," . base64_encode($img);
      }
      else {
         $img_fn = CAPTCHA_BASE_URL . "?_tcf=" . captcha::store_image($img);
      }
      
      #-- emit html form
      $html = 
        '<table border="0" summary="captcha input"><tr>'
      . '<td><img name="captcha_image" id="captcha_image" src="' .$img_fn. '" height="60" width="200" alt="'.$alt. '" /></td>'
      . '<td>'.$title. '<br/><input name="captcha_hash" type="hidden" value="'.$hash. '" />'
      . '<input name="captcha_response" type="text" size="7" maxlength="16" style="height:46px; font-size:34px; font-weight:450;" />'
      . '</td><td>'.$more.'</td>'
      . '</tr></table>';
      $html = "<div class=\"captcha\">$html</div>";
      return($html);
   }


   /* generates alternative (non-graphic), human-understandable
      representation of the passphrase
   */
   function textual_riddle($phrase) {
      $symbols0 = '"\'-/_:';
      $symbols1 = array("\n,", "\n;", ";", "\n&", "\n-", ",", ",", "\nand then", "\nfollowed by", "\nand", "\nand not a\n\"".chr(65+rand(0,26))."\",\nbut");
      $s = "Guess the letters and numbers\n(passphrase riddle)\n--\n";
      for ($p=0; $p<strlen($phrase); $p++) {
         $c = $phrase[$p];
         $add = "";
         #-- asis
         if (!rand(0,3)) {
            $i = $symbols0[rand(0,strlen($symbols0)-1)];
            $add = "$i$c$i";
         }
         #-- letter
         elseif ($c >= 'A') {
            $type = ($c >= 'a' ? "small " : "");
            do {
               $n = rand(-3,3);
               $c2 = chr((ord($c) & 0x5F) + $n);
            }
            while (($c2 < 'A') || ($c2 > 'Z'));
            if ($n < 0) {
               $n = -$n;
               $add .= "$type'$c2' +$n letters";
            }
            else {
               $add .= "$n chars before $type$c2";
            }
         }
         #-- number
         else {
            $sel = 0;
            $add = "???";
            $n = (int) $c;
            do {
               do { $x = rand(1, 10); } while (!$x);
               $op = rand(0,11);
               if ($op <= 2) {
                  $add = "($add * $x)"; $n *= $x;
               }
               elseif ($op == 3) {
                  $x = 2 * rand(1,2);
                  $add = "($add / $x)"; $n /= $x;
               }
               elseif ($sel % 2) {
                  $add = "($add + $x)"; $n += $x;
               }
               else {
                  $add = "($add - $x)"; $n -= $x;
               }
            }
            while (rand(0,1));
            $add .= " = $n";
         }
         $s .= "$add";
         $s .= $symbols1[rand(0,count($symbols1)-1)] . "\n";
      }
      return($s);
   }


   /* returns jpeg file stream with unscannable letters encoded
      in front of colorful disturbing background
   */
   function image($phrase, $width=200, $height=60, $inverse=0, $maxsize=0xFFFFF) {
   
      #-- initialize in-memory image with gd library
      srand(microtime()*21017);
      $img = imagecreatetruecolor($width, $height);
      $R = $inverse ? 0xFF : 0x00;
      imagefilledrectangle($img, 0,0, $width,$height, captcha::random_color($img, 222^$R, 255^$R));
      $c1 = rand(150^$R, 185^$R);
      $c2 = rand(195^$R, 230^$R);
      
      #-- configuration
      $fonts = array(
        // "COLLEGE.ttf",
      );
      $fonts += glob(EWIKI_FONT_DIR."/*.ttf");
      
      #-- encolour bg
      $wd = 20;
      $x = $y = 0;
      while ($x < $width) {
         imagefilledrectangle($img, $x, 0, $x+=$wd, $height, captcha::random_color($img, 222^$R, 255^$R));
         $wd += max(10, rand(0, 20) - 10);
      }

      #-- make interesting background I, lines
      $wd = 4;
      $w1 = 0;
      $w2 = 0;
      for ($x=0; $x<$width; $x+=(int)$wd) {
         if ($x < $width) {   // verical
            imageline($img, $x+$w1, 0, $x+$w2, $height-1, captcha::random_color($img,$c1,$c2));
         }
         if ($x < $height) {  // horizontally ("y")
            imageline($img, 0, $x-$w2, $width-1, $x-$w1, captcha::random_color($img,$c1,$c2));
         }
         $wd += rand(0,8) - 4;
         if ($wd < 1) { $wd = 2; }
         $w1 += rand(0,8) - 4;
         $w2 += rand(0,8) - 4;
         if (($x > $height) && ($y > $height)) {
            break;
         }
      }
      
      #-- more disturbing II, random letters
      $limit = rand(30,90);
      for ($n=0; $n<$limit; $n++) {
         $letter = "";
         do {
            $letter .= chr(rand(31,125)); // random symbol
         } while (rand(0,1));
         $size = rand(5, $height/2);
         $half = (int) ($size / 2);
         $x = rand(-$half, $width+$half);
         $y = rand(+$half, $height);
         $rotation = rand(60, 300);
         $c1  = captcha::random_color($img, 130^$R, 240^$R);
         $font = $fonts[rand(0, count($fonts)-1)];
         imagettftext($img, $size, $rotation, $x, $y, $c1, $font, $letter);
      }

      #-- add the real text to it
      $len = strlen($phrase);
      $w1 = 10;
      $w2 = $width / ($len+1);
      for ($p=0; $p<$len; $p++) {
         $letter = $phrase[$p];
         $size = rand(18, $height/2.2);
         $half = (int) $size / 2;
         $rotation = rand(-33, 33);
         $y = rand($size+3, $height-3);
         $x = $w1 + $w2*$p;
         $w1 += rand(-$width/90, $width/40);  // @BUG: last char could be +30 pixel outside of image
         $font = $fonts[rand(0, count($fonts)-1)];
         $r=rand(30,99); $g=rand(30,99); $b=rand(30,99); // two colors for shadow
         $c1  = imagecolorallocate($img, $r*1^$R, $g*1^$R, $b*1^$R);
         $c2  = imagecolorallocate($img, $r*2^$R, $g*2^$R, $b*2^$R);
         imagettftext($img, $size, $rotation, $x+1, $y, $c2, $font, $letter);
         imagettftext($img, $size, $rotation, $x, $y-1, $c1, $font, $letter);
      }

      #-- let JFIF stream be generated
      $quality = 67;
      $s = array();
      do {
         ob_start(); ob_implicit_flush(0);
         imagejpeg($img, "", (int)$quality);
         $jpeg = ob_get_contents(); ob_end_clean();
         $size = strlen($jpeg);
         $s_debug[] = ((int)($quality*10)/10) . "%=$size";
         $quality = $quality * ($maxsize/$size) * 0.93 - 1.7;  // -($quality/7.222)*
      }
      while (($size > $maxsize) && ($quality >= 16));
      imagedestroy($img);
#print_r($s_debug);
      return($jpeg);
   }


   /* helper code */
   function random_color($img, $a,$b) {
      return imagecolorallocate($img, rand($a,$b), rand($a,$b), rand($a,$b));
   }
   
   
   /* creates temporary file, returns basename */
   function store_image($data) {
      $dir = CAPTCHA_TEMP_DIR;
      $id = md5($data);
   
      #-- create temp dir
/* why 0777?!?  why not is_dir()??  this is done elsewhere anyhow
      if (!file_exists($dir)) {
         mkdir($dir) && chmod($dir, 0777);
      }
*/
      
      #-- remove stale files
      if ($dh = opendir($dir)) {
         $t_kill = time() - CAPTCHA_TIMEOUT;
         while($fn = readdir($dh)) if ($fn[0] != ".") {
            if (filemtime("$dir/$fn") < $t_kill) {
               unlink("$dir/$fn");
            }
         }
      }
      
      #-- store file
      fwrite($f = fopen("$dir/$id", "wb"), $data) && fclose($f);
      return($id);
   }

   /* sends it */
   function get_image($id) {
      $dir = CAPTCHA_TEMP_DIR;
      $fn = "$dir/$id";
      
      #-- find it
      if (preg_match('/^\w+$/', $id) && file_exists($fn)) {
         header("Content-Type: image/jpeg");
         header("Content-Length: " . filesize($fn));
         header("Last-Modified: " . gmstrftime("%a, %d %b %G %T %Z", filemtime($fn)));
         if (!sqGetGlobalVar('HTTP_IF_MODIFIED_SINCE', $http_if_modified_since, SQ_SERVER))
            $http_if_modified_since = '';
         if (!empty($http_if_modified_since)) {
            header("Status: 304 Unmodified");
         }
         else {
            readfile($fn);
         }
         exit;
      }
   }


   /* unreversable hash from passphrase, with time() slice encoded */
   function hash($text, $dtime=0) {
      $text = strtolower($text);
      $pfix = (int) (time() / CAPTCHA_TIMEOUT) + $dtime;
      if (!sqGetGlobalVar('SERVER_NAME', $server_name, SQ_SERVER))
         $server_name = '';
      return md5("captcha::$pfix:$text::".__FILE__.":$server_name:80");
   }


   /* makes string of random letters for embedding into image and for
      encoding as hash, later verification
   */
   function mkpass() {
      $s = "";
      for ($n=0; $n<10; $n++) {
         $s .= chr(rand(0, 255));
      }
      $s = base64_encode($s);   // base64-set, but filter out unwanted chars
      $s = preg_replace("/[+\/=IG0ODQR]/i", "", $s);  // (depends on YOUR font)
      $s = substr($s, 0, rand(5,7));
      return($s);
   }
}


#-- IE workaround
global $PHP_SELF;
if (empty($PHP_SELF)) $PHP_SELF = php_self();
if (sqGetGlobalVar('_tcf', $tcf, SQ_FORM) 
 && strpos(basename($PHP_SELF), 'captcha.php') === 0) {
   captcha::get_image(str_replace('../', '', $tcf));
}


