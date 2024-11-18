<?php

namespace BenjaminEtLaurie\Calc2\Calculator;
use BenjaminEtLaurie\Calc2\Parser\Parser;
use BenjaminEtLaurie\Calc2\Reader\Reader;
use BenjaminEtLaurie\Calc2\Solver\Solver;
use BenjaminEtLaurie\Calc2\Tokenizer\Tokenizer;

interface ICalculator
{
    public function __construct(
        Reader $reader,
        Parser $parser,
        Tokenizer $tokenizer,
        Solver $solver,
        string $filename
    );
    public function exec(): void;
}