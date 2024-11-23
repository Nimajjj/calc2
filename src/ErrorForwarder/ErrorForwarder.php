<?php

namespace BenjaminEtLaurie\Calc2\ErrorForwarder;

abstract class ErrorForwarder
{
    protected function except(bool $condition, string $message)
    {
        if (!$condition)
        {
            echo "Exception failed : " . $message . "\n";
            die();
        }
    }
}