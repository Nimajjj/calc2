<?php

namespace BenjaminEtLaurie\Calc2\Tokenizer;

interface ITokenizer
{
    public function __construct(array $operatorTokens);
    public function exec(string $expression): array;
    public function validate(): void;
}