<?php

namespace UJCMOK\FilamentExportableApiPlugin\Support;

class Transformer
{
    public static function apply($value, $transform)
    {
        if (is_callable($transform)) {
            return $transform($value);
        }

        return $value;
    }
}
