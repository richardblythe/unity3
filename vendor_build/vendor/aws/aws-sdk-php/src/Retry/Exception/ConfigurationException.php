<?php

namespace Unity3_Vendor\Aws\Retry\Exception;

use Unity3_Vendor\Aws\HasMonitoringEventsTrait;
use Unity3_Vendor\Aws\MonitoringEventsInterface;
/**
 * Represents an error interacting with retry configuration
 */
class ConfigurationException extends \RuntimeException implements MonitoringEventsInterface
{
    use HasMonitoringEventsTrait;
}
