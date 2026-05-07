<?php

namespace UJCMOK\FilamentExportableApiPlugin\Support;

use Illuminate\Support\Arr;

class ExportMapper
{
    public static function map(array $data, array $structure): array
    {
        $result = [];

        foreach ($structure as $item) {
            if ($item['type'] === 'field') {
                $value = data_get($data, implode('.', $item['path']));
                if (isset($item['transform'])) {
                    $value = Transformer::apply($value, $item['transform']);
                }
                $result[$item['external_name']] = $value;
            }

            if ($item['type'] === 'repeater') {
                $rows = data_get($data, implode('.', $item['path']), []);

                $mapped = [];

                foreach ($rows as $row) {
                    $rowData = [];

                    foreach ($item['children'] as $child) {
                        if ($child['type'] === 'field') {
                            $rowData[$child['external_name']] =
                                data_get($row, implode('.', $child['path']));
                            if (isset($child['transform'])) {
                                $rowData[$child['external_name']] = Transformer::apply($rowData[$child['external_name']], $child['transform']);
                            }
                        }
                    }

                    $mapped[] = $rowData;
                }

                $result[$item['external_name']] = $mapped;
            }
        }
        $result = Arr::undot($result);

        return $result;
    }
}
