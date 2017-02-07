<?php

namespace ParamsReferenceOk3;

class A
{
	function test(&$a = NULL)
	{}
}


class B extends A
{
	function test(&$a = NULL)
	{}
}
