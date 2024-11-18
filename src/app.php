<?php

declare(strict_types=1);

// TODO : verifier que l'app soit bien SOLID
// TODO : verifier que l'app soit bien KISS
// TODO : encapsulate App into a Builder class

namespace BenjaminEtLaurie\Calc2;

require_once __DIR__ . '/../vendor/autoload.php';

use BenjaminEtLaurie\Calc2\Reader\Reader;
use BenjaminEtLaurie\Calc2\Parser\Parser;
use BenjaminEtLaurie\Calc2\Tokenizer\Tokenizer;
use BenjaminEtLaurie\Calc2\Solver\Solver;

final class Coink
{
    private array $raw_data;

    public function __construct(
        private Reader $reader,
        private Parser $parser,
        private Tokenizer $tokenizer,
        private Solver $solver,
        string $filename
    )
    {
//        $this->raw_data = $this->reader->exec($filename);
        $this->raw_data = [
            "3.1 + 5 * (2 - 8)",
            "10 / 2 + 6",
            "(4 + 5) * 3 - 7",
            "18 / (3 + 3)",
            "5 * 5 - 3 + 2",
            "(7 + 3) * (2 + 5)",
            "12 - 4 * 2 + 6",
            "9 + 3 * (8 / 4) - 6",
            "6 * (7 + 2) / 3",
            "20 / 4 + (3 * 2) - 5"
        ];

    }

    public function exec(): void
    {
        foreach ($this->raw_data as $line)
        {
            $tokens = $this->tokenizer->exec($line);
            $tree = $this->parser->exec($tokens);
            echo $line . " = " . $this->solver->exec($tree) . "\n";
        }
    }
}


$app = new Coink(
    new Reader(),
    new Parser(),
    new Tokenizer(),
    new Solver(),
    "data.txt"
);

$app->exec();