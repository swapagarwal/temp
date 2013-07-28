<?php

$date1=date('d/m/Y');
echo 'Today\'s Date: '.$date1;
echo "<br>";

$d1=explode("/",$date1);
$i=rand(-($d1[0]-1),30-$d1[0])." day ".rand(-($d1[1]-1),12-$d1[1])." month ".rand(-100,100)." year ";
$date2=date('d/m/Y',strtotime($i));
echo 'Random Date: '.$date2;
echo "<br><br>";

$d2=explode("/",$date2);

$a=abs($d2[0]-$d1[0]);
$b=abs($d2[1]-$d1[1]);
$c=abs($d2[2]-$d1[2]);
echo 'Difference: '.$a,' day(s), ',$b,' month(s), ',$c,' year(s)';
echo "<br><br>";

/*$days=$a+$b*30+$c*365;
echo $days;

$c=($days-$days%365)/365;$days%=365;
$b=($days-$days%30)/30;$days%=30;
$a=$days;

echo 'Difference: '.$a,' day(s), ',$b,' month(s), ',$c,' year(s)';
echo "<br><br>";*/
?>