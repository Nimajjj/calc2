<?php

namespace BenjaminEtLaurie\Calc2\Solver;
use BenjaminEtLaurie\Calc2\ErrorForwarder\ErrorForwarder;
use BenjaminEtLaurie\Calc2\Parser\INode;

final class Solver 
    extends ErrorForwarder
    implements ISolver
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
            $this->except(
                $this->exec($node->right) !== 0.,
                "Division by zero error."
            );
            return $this->exec($node->left) / $this->exec($node->right);
        }

        $this->except(
            false,
            "Something unexpected happened."
        );
    }
}