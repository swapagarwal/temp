<?php
/*$date=date('l/F/Y');
echo $date;

echo  date('d/m/Y',strtotime("2 day"));

$ss=array("Hello","Hi","How");

$rr=implode(",",$ss);
echo $rr;



$sss="hello This is My new Web page";

$tt=explode(" ",$sss);
print_r($tt);
*/
date_default_timezone_set('Asia/Kolkata');
$d=date('d/m/y H:i:s');
echo $d,'<br>';
echo strtotime('26/06/13');

$date="01/01/70 05:30"; //date example
list($day, $month, $year, $hour, $minute) = split('[/ :]', $date); 
//the variables should be arranged acording to your date format and so the separators
$timestamp=mktime($hour, $minute,0, $month, $day, $year);
echo $timestamp;
echo '<br>',time(),'<br>';
echo date('d/m/y H:i:s',985734785634875493875928759232);

echo "<br>",date('d/m/y H:i:s');
date_default_timezone_set('UTC');
echo "<br>",date('d/m/y H:i:s');
?>