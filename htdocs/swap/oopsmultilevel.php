<?php

class A
{
	function aa()
	{
		echo "A.aa<br>";
	}
}
class B extends A
{
	function bb()
	{
		echo "B.bb<br>";
	}
}
class C extends B
{
	function cc()
	{
		echo "C.cc<br>";
	}
}

$a=new A();
$a->aa();echo "<br>";
$b=new B();
$b->aa();
$b->bb();echo "<br>";
$c=new C();
$c->aa();
$c->bb();
$c->cc();echo "<br>";
?>