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
        $expression = str_replace(" ", "", $expression);
        $lastChar = '';
        $parenthesisBalance = 0;

        foreach (str_split($expression) as $char)
        {
            if (ctype_digit($char) || $char === ".")  // If the character is a digit or a decimal point
            {
                $lastChar = $char;
                continue;
            }

            if (in_array($char, $this->operatorTokens)) // If the character is an operator or parenthesis
            {
                if ($char === '(')
                {
                    $parenthesisBalance++;
                }
                elseif ($char === ')')
                {
                    $parenthesisBalance--;
                    if ($parenthesisBalance < 0) // More closing parentheses than opening
                    {
                        return false;
                    }
                }
                else
                {
                    // Check if the previous character was also an operator (excluding parentheses)
                    if (in_array($lastChar, $this->operatorTokens) && !in_array($lastChar, ['(', ')']))
                    {
                        return false;
                    }
                }

                $lastChar = $char;
                continue;
            }

            // If the character is invalid, return false
            return false;
        }

        // Ensure all parentheses are balanced
        if ($parenthesisBalance !== 0)
        {
            return false;
        }

        // Ensure the last character is not an operator
        if (in_array($lastChar, $this->operatorTokens) && !in_array($lastChar, [')']))
        {
            return false;
        }

        return true;
    }
}