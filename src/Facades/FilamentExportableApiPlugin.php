<?php

namespace UJCMOK\FilamentExportableApiPlugin\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \UJCMOK\FilamentExportableApiPlugin\FilamentExportableApiPlugin
 */
class FilamentExportableApiPlugin extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \UJCMOK\FilamentExportableApiPlugin\FilamentExportableApiPlugin::class;
    }
}
