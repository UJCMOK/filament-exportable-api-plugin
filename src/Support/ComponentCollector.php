<?php

namespace UJCMOK\FilamentExportableApiPlugin\Support;

class ComponentCollector
{
    public static function collect(array $components, array $path = []): array
    {
        $result = [];

        foreach ($components as $component) {
            $meta = method_exists($component, 'getMeta') ? $component->getMeta() : [];
            $name = method_exists($component, 'getName') ? $component->getName() : null;

            $currentPath = $name ? [...$path, $name] : $path;

            if (($meta['exportable'] ?? false) && $name) {
                $result[] = [
                    'type' => 'field',
                    'path' => $currentPath,
                    'external_name' => $meta['external_name'] ?? $name,
                    'value_can_be_exported' => $meta['value_can_be_exported'],
                ];
            }

            if ($meta['exportable_group'] ?? false) {
                $result[] = [
                    'type' => 'repeater',
                    'path' => $currentPath,
                    'external_name' => $meta['external_name'] ?? $name,
                    'children' => self::collect(
                        $component->getChildComponents(),
                        []
                    ),
                ];

                continue;
            }

            if (method_exists($component, 'getChildComponents')) {
                $result = array_merge(
                    $result,
                    self::collect($component->getChildComponents(), $currentPath)
                );
            }
        }

        return $result;
    }
}
