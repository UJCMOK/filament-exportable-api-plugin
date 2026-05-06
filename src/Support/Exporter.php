<?php

namespace UJCMOK\FilamentExportableApiPlugin\Support;

class Exporter
{
    public static function fromForm($form): array
    {
        $structure = StructureCache::remember(
            'form_' . md5(get_class($form)),
            fn() => ComponentCollector::collect($form->getComponents())
        );

        $data = $form->getState();

        return ExportMapper::map($data, $structure);
    }
}
