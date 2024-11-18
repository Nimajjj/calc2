<?php

namespace BenjaminEtLaurie\Calc2\Tokenizer;

final class Tokenizer implements ITokenizer
{
    public function exec(string $expression): array
    {
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

            if (in_array($char, ['+', '-', '*', '/', '^', '(', ')'])) # WARNING : on ne verifie pas que le Solver resout tous les operateurs
            {
                $tokens[] = $char;
            }

            $i++;
        }

        return $tokens;
    }
}