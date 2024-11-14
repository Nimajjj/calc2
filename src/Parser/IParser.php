<?php

namespace BenjaminEtLaurie\App\Parser;


interface IParser
{
    public function exec(array $tokens): INode;
}