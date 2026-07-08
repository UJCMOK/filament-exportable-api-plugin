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
                    'transform' => $meta['transform'],
                    'component' => $component,
                ];
            }

            if ($meta['exportable_group'] ?? false) {
                $result[] = [
                    'type' => 'repeater',
                    'path' => $currentPath,
                    'external_name' => $meta['external_name'] ?? $name,
                    'component' => $component,
                    'children' => self::collect(
                        $component->getChildSchema()->getComponents(withHidden: true),
                        []
                    ),
                ];

                continue;
            }

            if (method_exists($component, 'getChildSchema')) {
                $result = array_merge(
                    $result,
                    self::collect($component->getChildSchema()->getComponents(withHidden: true), $currentPath)
                );
            }
        }

        return $result;
    }
}
