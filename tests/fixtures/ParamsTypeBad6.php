<?php

namespace ParamsTypeBad6;

class A
{
	function test($a = NULL)
	{}
}


class B extends A
{
	function test(int $a = NULL)
	{}
}
