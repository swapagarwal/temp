<?php

interface ss
{
function show();
}
interface ss1 extends ss
{
function show1();
}
class A implements ss1
{
function show1()
{
echo "This is show1 function";
}
function show()
{
echo "This is show function";
}
}
$a=new A();
$a->show();
$a->show1();
?>