<?php

declare(strict_types=1);

namespace BenjaminEtLaurie\Calc2;

require_once __DIR__ . '/../vendor/autoload.php';

use BenjaminEtLaurie\Calc2\Builder\Builder;

if ($argc != 2)
{
    echo "[ERROR] A file path must be provided as cli parameter.\n";
    die();
}

$builder = ( new Builder() )
    ->buildReader($argv[1])
    ->buildTokenizer(['+', '-', '*', '/', '(', ')'])
    ->buildParser()
    ->buildSolver();

$app = $builder->build();

$app->exec();