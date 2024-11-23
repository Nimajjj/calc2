<?php

namespace BenjaminEtLaurie\Calc2\Reader;
use BenjaminEtLaurie\Calc2\ErrorForwarder\ErrorForwarder;

final class Reader
    extends ErrorForwarder
    implements IReader
{
    public function exec(string $filename): array
    {
        try
        {
            $lines = file($filename, FILE_IGNORE_NEW_LINES);
        }
        catch(Exception $e)
        {
            $this->except(
                false,
                $e->getMessage()
            );
        }
        
        $data = [];
        assert($lines);

        $this->except(
            is_array($lines), 
            "Fail to read '" . $filename . "'."
        );

        foreach ($lines as $line)
        {
            $data[] = $line;
        }
        return $data;
    }
}