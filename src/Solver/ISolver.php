<?php

namespace BenjaminEtLaurie\App\Solver;
use BenjaminEtLaurie\App\Parser\INode;

interface ISolver
{
    public function exec(INode $node): float;
}