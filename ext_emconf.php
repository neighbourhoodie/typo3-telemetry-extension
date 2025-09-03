<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'Telemetry Demo',
    'description' => 'Telemetry Demo',
    'category' => 'module',
    'state' => 'stable',
    'author' => 'NH',
    'author_email' => 'alex@neighbourhood.ie',
    'author_company' => '',
    'version' => '0.0.1',
    'constraints' => [
        'depends' => [
            'typo3' => '13.0.0',
            'open-telemetry/exporter-otlp' => '^1.3',
	        'open-telemetry/sdk' => '^1.7',
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
];
