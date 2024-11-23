<?php

namespace BenjaminEtLaurie\Calc2\Builder;

use BenjaminEtLaurie\Calc2\ErrorForwarder\ErrorForwarder;
use BenjaminEtLaurie\Calc2\Reader\Reader;
use BenjaminEtLaurie\Calc2\Parser\Parser;
use BenjaminEtLaurie\Calc2\Tokenizer\Tokenizer;
use BenjaminEtLaurie\Calc2\Solver\Solver;
use BenjaminEtLaurie\Calc2\Calculator\Calculator;

// could use a factory for each class

final class Builder extends ErrorForwarder
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
        $this->except($this->reader instanceof Reader, "Unexpected error while building Reader");
        return $this;
    }

    public function buildTokenizer(array $operatorTokens): Builder
    {
        $this->tokenizer = new Tokenizer($operatorTokens);
        $this->tokenizer->validate();
        $this->except($this->tokenizer instanceof Tokenizer, "Unexpected error while building Tokenizer");
        return $this;
    }

    public function buildParser(): Builder
    {
        $this->parser = new Parser();
        $this->except($this->parser instanceof Parser, "Unexpected error while building Parser");
        return $this;
    }

    public function buildSolver(): Builder
    {
        $this->solver = new Solver();
        $this->except($this->solver instanceof Solver, "Unexpected error while building Solver");
        return $this;
    }

    public function build(): Calculator
    {
        $this->except($this->filename !== null, "A filename must be provided.");

        return new Calculator(
            $this->reader,
            $this->parser,
            $this->tokenizer,
            $this->solver,
            $this->filename
        );
    }
}