<?php

namespace UJCMOK\FilamentExportableApiPlugin\Macros;

use Filament\Forms\Components\Field;
use Filament\Forms\Components\Repeater;

class ExportableMacro
{
    public static function register()
    {
        Field::macro('exportable', function (?string $externalName = null, bool | callable $valueCanBeExported = true, ?callable $transform = null) {
            /** @var Field $this */
            $this->meta('exportable', true);
            $this->meta('value_can_be_exported', $valueCanBeExported);
            $this->meta('external_name', $externalName);
            $this->meta('transform', $transform);

            if (method_exists($this, 'hintIcon')) {
                $this->hintIcon('heroicon-m-arrow-up-tray');
                if ($externalName) {
                    $this->hint("Eksport: {$externalName}");
                }
            }

            return $this;
        });

        Repeater::macro('exportableGroup', function (?string $externalName = null) {
            /** @var Repeater $this */
            $this->meta('exportable_group', true);
            $this->meta('external_name', $externalName);

            if (method_exists($this, 'hintIcon')) {
                $this->hintIcon('heroicon-m-arrow-up-tray');
                if ($externalName) {
                    $this->hint("Eksport: {$externalName}");
                }
            }

            return $this;
        });
    }
}
