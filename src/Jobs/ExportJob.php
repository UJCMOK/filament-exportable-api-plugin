<?php

namespace UJCMOK\FilamentExportableApiPlugin\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;

class ExportJob implements ShouldQueue
{
    use Dispatchable;
    use Queueable;

    public function __construct(public array $payload) {}

    public function handle()
    {
        //        Http::post('https://api.external.com', $this->payload);
    }
}
