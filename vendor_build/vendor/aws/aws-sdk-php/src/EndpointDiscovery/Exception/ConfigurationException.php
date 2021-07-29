<?php

namespace Unity3_Vendor\Aws\EndpointDiscovery\Exception;

use Unity3_Vendor\Aws\HasMonitoringEventsTrait;
use Unity3_Vendor\Aws\MonitoringEventsInterface;
/**
 * Represents an error interacting with configuration for endpoint discovery
 */
class ConfigurationException extends \RuntimeException implements MonitoringEventsInterface
{
    use HasMonitoringEventsTrait;
}
