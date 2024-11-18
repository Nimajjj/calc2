<?php

declare(strict_types=1);

// TODO : verifier que l'app soit bien SOLID
// TODO : verifier que l'app soit bien KISS
// TODO : encapsulate App into a Builder class

namespace BenjaminEtLaurie\Calc2;

require_once __DIR__ . '/../vendor/autoload.php';

use BenjaminEtLaurie\Calc2\Builder\Builder;

$builder = ( new Builder() )
    ->buildReader("data.txt")
    ->buildTokenizer()
    ->buildParser()
    ->buildSolver();

$app = $builder->build();

$app->exec();