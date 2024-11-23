<?php

namespace BenjaminEtLaurie\Calc2\Tokenizer;
use BenjaminEtLaurie\Calc2\ErrorForwarder\ErrorForwarder;

final class Tokenizer 
    extends ErrorForwarder
    implements ITokenizer
{
    public function __construct(
        private array $operatorTokens
    )
    {
    }

    public function exec(string $expression): array
    {
        $this->except(
            $this->isValidExpression($expression),
            "Expression '" . $expression . "' is invalid."
        );

        $tokens = [];
        $length = strlen($expression);
        $i = 0;

        while ($i < $length)
        {
            $char = $expression[$i];

            if (ctype_digit($char))
            {
                $number = '';
                while ($i < $length && (ctype_digit($expression[$i]) || $expression[$i] == '.'))
                {
                    $number .= $expression[$i];
                    $i++;
                }
                $tokens[] = $number;
                continue;
            }

            if (in_array($char, $this->operatorTokens))
            {
                $tokens[] = $char;
            }

            $i++;
        }

        return $tokens;
    }

    
    public function validate(): void
    {
        foreach($this->operatorTokens as $token)
        {
            $this->except(
                is_string($token), 
                "Operator '" . $token . "' is not string."
            );
        }
    }


    private function isValidExpression(string $expression): bool 
    {
        foreach(str_split($expression) as $char)
        {
            if (in_array($char, $this->operatorTokens)  # if char is an operator
                || ctype_digit($char)   # if char is a number 
                || $char === "."
                || $char === " "
            )
            {
                continue;
            }

            return false;
        }
        return true;
    }
}