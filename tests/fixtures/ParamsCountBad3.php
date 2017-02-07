<?php

namespace ParamsCountBad3;

class A
{
	function test($a1 = NULL)
	{}
}


class B extends A
{
	function test($a1)
	{}
}
