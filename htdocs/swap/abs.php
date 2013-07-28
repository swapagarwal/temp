<?php
abstract class A
{
abstract function show();
}
class B extends A
{
function show()
{
echo "This is show Message<br>";
}
}
$b=new B();
$b->show();
?>