<?php

namespace BenjaminEtLaurie\Calc2\Parser;


interface IParser
{
    public function exec(array $tokens): INode;
}