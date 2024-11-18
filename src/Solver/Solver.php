<?php

namespace BenjaminEtLaurie\Calc2\Solver;
use BenjaminEtLaurie\Calc2\Parser\INode;

final class Solver implements ISolver
{
    public function exec(INode $node): float
    {
        if (is_numeric($node->value()))
        {
            return (float) $node->value();
        }

        if ( $node->value() === "+" )
        {
            return $this->exec($node->left) + $this->exec($node->right);
        }

        if ( $node->value() === "-" )
        {
            return $this->exec($node->left) - $this->exec($node->right);
        }

        if ( $node->value() === "*" )
        {
            return $this->exec($node->left) * $this->exec($node->right);
        }

        if ( $node->value() === "/" )
        {
            return $this->exec($node->left) / $this->exec($node->right);
        }

        assert(false, "cestunimprevu");
    }
}