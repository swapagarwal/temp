<?php
$s="This is String Function";

echo strtoupper($s);

echo strtolower($s);

echo strlen($s);

echo "<br>";

echo strrev($s);

echo "<br>";

echo strpos($s,'n');

echo "<br>";

echo str_repeat("Hello"."<br>",4);

echo "<br>";

echo substr($s,0,7);

echo str_word_count("Hello this sas sa");

echo str_shuffle($s);


echo strcmp("Hello","Hell");

echo md5($s);

$rand=rand(100,1000);
echo $rand;

?>