<?php

namespace ReturnOk3;

class A
{
	function test(): ?int
	{}
}


class B extends A
{
	function test(): int
	{}
}
