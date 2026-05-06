<?php

namespace UJCMOK\FilamentExportableApiPlugin\Support;

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
                $result[$item['external']] = $value;
            }

            if ($item['type'] === 'repeater') {
                $rows = data_get($data, implode('.', $item['path']), []);

                $mapped = [];

                foreach ($rows as $row) {
                    $rowData = [];

                    foreach ($item['children'] as $child) {
                        if ($child['type'] === 'field') {
                            $rowData[$child['external']] =
                                data_get($row, implode('.', $child['path']));
                            if (isset($child['transform'])) {
                                $rowData[$child['external']] = Transformer::apply($rowData[$child['external']], $child['transform']);
                            }
                        }
                    }

                    $mapped[] = $rowData;
                }

                $result[$item['external']] = $mapped;
            }
        }

        return $result;
    }
}
