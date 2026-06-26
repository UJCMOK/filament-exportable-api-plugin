<?php

namespace UJCMOK\FilamentExportableApiPlugin\Support;

use Filament\Schemas\Schema;

class Exporter
{
    public static function fromForm(Schema $form): array
    {
        $structure = StructureCache::remember(
            'form_' . md5(get_class($form->getLivewire())),
            fn () => ComponentCollector::collect($form->getComponents(withHidden: true))
        );

        $data = $form->getState();

        return ExportMapper::map($data, $structure);
    }
}
