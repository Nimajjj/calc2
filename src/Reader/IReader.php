<?php

namespace BenjaminEtLaurie\Calc2\Reader;

interface IReader
{
    public function exec(string $filename): array;
}