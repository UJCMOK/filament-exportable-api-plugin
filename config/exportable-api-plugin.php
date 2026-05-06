<?php

// config for UJCMOK/FilamentExportableApiPlugin
return [

    'strategy' => 'array', // array | flat

    'include_nulls' => false,

    'profiles' => [
        'default' => [],
        'erp' => [],
        'crm' => [],
    ],

    'cache' => [
        'enabled' => true,
        'ttl' => 3600,
    ],

    'queue' => [
        'enabled' => true,
        'connection' => 'default',
    ],
];
