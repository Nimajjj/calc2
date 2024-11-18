<?php

namespace BenjaminEtLaurie\Calc2\Parser;


final class Node implements INode
{
    public function __construct(
        private string $value,
        public ?INode $left = null,
        public ?INode $right = null
    )
    {
    }

    public function value(): string
    {
        return $this->value;
    }
}