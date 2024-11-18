<?php

namespace BenjaminEtLaurie\Calc2\Builder;

use BenjaminEtLaurie\Calc2\Reader\Reader;
use BenjaminEtLaurie\Calc2\Parser\Parser;
use BenjaminEtLaurie\Calc2\Tokenizer\Tokenizer;
use BenjaminEtLaurie\Calc2\Solver\Solver;
use BenjaminEtLaurie\Calc2\Calculator\Calculator;

// could use a factory for each class

final class Builder
{
    private string $filename;
    private Reader $reader;
    private Tokenizer $tokenizer;
    private Solver $solver;
    private Parser $parser;

    public function buildReader(string $filename): Builder
    {
        $this->filename = $filename;
        $this->reader = new Reader();
        return $this;
    }

    public function buildTokenizer(): Builder
    {
        $this->tokenizer = new Tokenizer();
        return $this;
    }

    public function buildParser(): Builder
    {
        $this->parser = new Parser();
        return $this;
    }

    public function buildSolver(): Builder
    {
        $this->solver = new Solver();
        return $this;
    }

    public function build(): Calculator
    {
        assert($this->reader instanceof Reader);
        assert($this->parser instanceof Parser);
        assert($this->solver instanceof Solver);
        assert($this->parser instanceof Parser);
        assert($this->filename !== null);
        return new Calculator(
            $this->reader,
            $this->parser,
            $this->tokenizer,
            $this->solver,
            $this->filename
        );
    }
}