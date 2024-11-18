<?php

namespace BenjaminEtLaurie\Calc2\Solver;
use BenjaminEtLaurie\Calc2\Parser\INode;

interface ISolver
{
    public function exec(INode $node): float;
}