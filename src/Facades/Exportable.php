<?php

namespace UJCMOK\FilamentExportableApiPlugin\Facades;

use Illuminate\Support\Facades\Facade;
use UJCMOK\FilamentExportableApiPlugin\FilamentExportableApiPlugin;

/**
 * @see FilamentExportableApiPlugin
 */
class Exportable extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return FilamentExportableApiPlugin::class;
    }
}
