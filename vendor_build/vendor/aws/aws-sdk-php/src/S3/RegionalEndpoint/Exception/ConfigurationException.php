<?php

namespace Unity3_Vendor\Aws\S3\RegionalEndpoint\Exception;

use Unity3_Vendor\Aws\HasMonitoringEventsTrait;
use Unity3_Vendor\Aws\MonitoringEventsInterface;
/**
 * Represents an error interacting with configuration for sts regional endpoints
 */
class ConfigurationException extends \RuntimeException implements MonitoringEventsInterface
{
    use HasMonitoringEventsTrait;
}
