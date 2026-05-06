<?php

namespace UJCMOK\FilamentExportableApiPlugin\Facades;

use Illuminate\Support\Facades\Facade;
use UJCMOK\FilamentExportableApiPlugin\FilamentExportableApiPlugin;

/**
 * @see \UJCMOK\FilamentExportableApiPlugin\Exportable
 */
class Exportable extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return FilamentExportableApiPlugin::class;
    }
}
