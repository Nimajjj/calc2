<?php

namespace BenjaminEtLaurie\App\Reader;

interface IReader
{
    public function exec(string $filename): array;
}