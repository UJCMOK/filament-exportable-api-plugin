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
                if (is_callable($item['value_can_be_exported'])) {
                    $valueCanBeExported = (app()->call($item['value_can_be_exported'], [
                        'get' => fn ($field) => self::get($data, $field),
                        'value' => data_get($data, implode('.', $item['path'])),
                    ]));
                } else {
                    $valueCanBeExported = $item['value_can_be_exported'];
                }
                if ($valueCanBeExported && $item['component']->isVisible() && $item['component']->getContainer()?->getParentComponent()?->isVisible()) {
                    $value = data_get($data, implode('.', $item['path']));
                    if (isset($item['transform'])) {
                        $value = Transformer::apply($value, $item['transform']);
                    }
                    $result[$item['external_name']] = $value;
                }
            }

            if ($item['type'] === 'repeater') {
                $rows = data_get($data, implode('.', $item['path']), []);

                $mapped = [];

                foreach ($rows as $row) {
                    $rowData = [];

                    foreach ($item['children'] as $child) {
                        if ($child['type'] === 'field') {
                            if (is_callable($child['value_can_be_exported'])) {
                                $valueCanBeExported = (app()->call($child['value_can_be_exported'], [
                                    'get' => fn ($field) => str($field)->startsWith('../') ? self::get($data, $field) : self::get($row, $field),
                                    'value' => data_get($data, implode('.', $child['path'])),
                                ]));
                            } else {
                                $valueCanBeExported = $child['value_can_be_exported'];
                            }

                            if ($valueCanBeExported && $child['component']->isVisible() && $child['component']->getContainer()?->getParentComponent()?->isVisible()) {
                                $rowData[$child['external_name']] =
                                    data_get($row, implode('.', $child['path']));
                                if (isset($child['transform'])) {
                                    $rowData[$child['external_name']] = Transformer::apply($rowData[$child['external_name']], $child['transform']);
                                }
                            }
                        }
                    }

                    $mapped[] = Arr::undot($rowData);
                }

                if (! empty($mapped)) {
                    $result[$item['external_name']] = $mapped;
                }
            }
        }
        $result = Arr::undot($result);

        return $result;
    }

    protected static function get(array $data, string $field, string $path = '')
    {
        return data_get($data, ($path !== '' ? $path . '.' . $field : $field));
    }
}
