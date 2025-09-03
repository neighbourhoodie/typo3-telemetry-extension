<?php 

use Neighbourhoodie\Telemetry\Service\TelemetryService;

$GLOBALS['TYPO3_CONF_VARS']['LOG']['Neighbourhoodie']['Telemetry']['writerConfiguration'] = [
    \TYPO3\CMS\Core\Log\LogLevel::DEBUG => [
        \TYPO3\CMS\Core\Log\Writer\FileWriter::class => [
            'logFile' => 'var/log/telemetry.log',
        ],
    ],
];

// Initialize OTEL meter & counters once per PHP process
TelemetryService::init();