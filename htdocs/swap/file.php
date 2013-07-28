<?php
$file=fopen("a.txt","r");
while(!feof($file))
{
echo  fgets($file);
echo "<br>";
}
fclose($file);
$file1=fopen("a.txt","w");
$ss="This is My Web Page";
fwrite($file1,$ss);
fclose($file1);

$file2=fopen("a.txt","a");
$ss="Append Mode";
fwrite($file2,$ss);
fclose($file2);
echo filesize("a.txt");
?>