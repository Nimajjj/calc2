<?php

namespace BenjaminEtLaurie\Calc2\Calculator;

use BenjaminEtLaurie\Calc2\Parser\Parser;
use BenjaminEtLaurie\Calc2\Reader\Reader;
use BenjaminEtLaurie\Calc2\Solver\Solver;
use BenjaminEtLaurie\Calc2\Tokenizer\Tokenizer;

final class Calculator implements ICalculator
{
    private array $raw_data;
    public function __construct(
        private Reader $reader,
        private Parser $parser,
        private Tokenizer $tokenizer,
        private Solver $solver,
        string $filename
    )
    {
        $this->loadData($filename);
    }

    private function loadData(string $filename): void
    {
        $this->raw_data = $this->reader->exec($filename);
        assert(is_array($this->raw_data));
    }
    public function exec(): void
    {
        foreach ($this->raw_data as $line)
        {
            $tokens = $this->tokenizer->exec($line);
            $tree = $this->parser->exec($tokens);
            echo $line . " = " . $this->solver->exec($tree) . "\n";
        }
    }
}