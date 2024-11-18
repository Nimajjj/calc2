<?php

namespace BenjaminEtLaurie\Calc2\Reader;

final class Reader implements IReader
{
    public function exec(string $filename): array
    {
        $lines = file($filename, FILE_IGNORE_NEW_LINES);
        $data = [];
        assert($lines);
        foreach ($lines as $line)
        {
            $data[] = $line;
        }
        return $data;
    }
}