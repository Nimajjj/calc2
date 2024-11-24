<?php

namespace BenjaminEtLaurie\Calc2\Parser;
use BenjaminEtLaurie\Calc2\ErrorForwarder\ErrorForwarder;

final class Parser 
    extends ErrorForwarder
    implements IParser
{
    public function exec(array $tokens): INode
    {
        return $this->parseExpression($tokens);
    }

    // Recursive parsing functions for each precedence level
    private function parseExpression(array &$tokens): Node
    {
        $node = $this->parseTerm($tokens);
        while (!empty($tokens) && ($tokens[0] === '+' || $tokens[0] === '-'))
        {
            $operator = array_shift($tokens);
            $node = new Node($operator, $node, $this->parseTerm($tokens));
        }
        return $node;
    }

    private function parseTerm(array &$tokens): Node
    {
        $node = $this->parseFactor($tokens);
        while (!empty($tokens) && ($tokens[0] === '*' || $tokens[0] === '/'))
        {
            $operator = array_shift($tokens);
            $node = new Node($operator, $node, $this->parseFactor($tokens));
        }
        return $node;
    }

    /**
     * @throws Exception
     */
    private function parseFactor(array &$tokens): Node
    {
        $token = array_shift($tokens);

        if (is_numeric($token))
        {
            return new Node($token);
        } 
        elseif ($token === '(')
        {
            $node = $this->parseExpression($tokens);
            array_shift($tokens); // Remove ')'
            return $node;
        }

        $this->excepts(
            false,
            "Unexpected token: '" . $token . "'"
        );
    }
}