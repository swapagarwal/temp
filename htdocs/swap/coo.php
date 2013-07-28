<?php

setcookie("user","jitesh",time()+3600);
setcookie("user1","jitesh",time()+3600);
setcookie("user2","jitesh Jain",time()+3600);
echo $_COOKIE["user"];
echo $_COOKIE["user1"];

if(isset($_COOKIE["user2"]))
echo $_COOKIE["user2"];
print_r($_COOKIE);	

?>
