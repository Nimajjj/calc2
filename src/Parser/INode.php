<?php

namespace BenjaminEtLaurie\Calc2\Parser;


interface INode 
{
    public function __construct(string $value, ?INode $left = null, ?INode $right = null);
    public function value(): string;
}
