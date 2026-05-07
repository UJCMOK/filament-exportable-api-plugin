<?php

namespace UJCMOK\FilamentExportableApiPlugin\Macros;

use Filament\Forms\Components\Field;
use Filament\Forms\Components\Repeater;

class ExportableMacro
{
    public static function register()
    {
        Field::macro('exportable', function (?string $externalName = null, ?callable $transform = null) {
            /** @var Field $this */
            $this->meta('exportable', true);
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

        Repeater::macro('exportableGroup', function (?string $externalName = null, ?callable $transform = null) {
            /** @var Repeater $this */
            $this->meta('exportableGroup', true);
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
    }
}
