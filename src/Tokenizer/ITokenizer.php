<?php

namespace BenjaminEtLaurie\App\Tokenizer;

interface ITokenizer
{
    public function exec(string $expression): array;
}