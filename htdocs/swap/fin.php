<?php

class fin
{
final function show(){
echo "This is show fucntion<br>";
}
}
class f extends fin
{
function show()
{
echo "This is child show function<br>";
}
}
$b=new f();
$b->show();
?>