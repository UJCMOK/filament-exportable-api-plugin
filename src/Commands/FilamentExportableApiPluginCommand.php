<?php

namespace UJCMOK\FilamentExportableApiPlugin\Commands;

use Illuminate\Console\Command;

class FilamentExportableApiPluginCommand extends Command
{
    public $signature = 'filament-exportable-api-plugin';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
