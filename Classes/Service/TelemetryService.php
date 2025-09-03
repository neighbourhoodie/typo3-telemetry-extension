<?php
namespace Neighbourhoodie\Telemetry\Service;

use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerAwareTrait;
use TYPO3\CMS\Core\Log\LogManager;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use OpenTelemetry\API\Globals;

final class TelemetryService
{
    private static $meter;
 
    public static function init()
    {
        $logger = GeneralUtility::makeInstance(LogManager::class)
            ->getLogger(__CLASS__);

        if (!self::$meter) {
            error_log('new meterprovider at ' . date('c'));
            self::$meter = Globals::meterProvider()->getMeter('typo3-demo');
        }
    }

    public static function getMeter(){
        return self::$meter;
    }
}
