<?php

namespace BenjaminEtLaurie\Calc2\Tokenizer;

interface ITokenizer
{
    public function exec(string $expression): array;
}