<?php
class A
{
const a=100;
static function sss()
{
echo "This is static function<br>";
}
function A()
{
echo self::a.'<br>';
echo "This is A class Constructor<br>";
}
}
class B extends A
{
function B()
{
parent::A();
echo "This is B Class Constructor<br>";
}
}
A::sss();
$b=new B();

echo A::a;
?>