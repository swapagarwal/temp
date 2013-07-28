<?php
class A
{
public $public="Helllo this is public variable";
function aa($a,$b)
{
echo $this->public;
echo $a,$b,"<br>";
echo "This is aa function";
}
}
class B extends A
{
function ch()
{
echo "This is Child function";
}
}
$a=new A();

$a->aa(10,20);	
$b=new B();
$b->aa(21,32);
$b->ch();


?>