<?php

namespace UJCMOK\FilamentExportableApiPlugin;

use UJCMOK\FilamentExportableApiPlugin\Support\Exporter;

class FilamentExportableApiPlugin
{
    public static function fromForm($form): array
    {
        return Exporter::fromForm($form);
    }
}
