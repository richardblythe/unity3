<?php

namespace Unity3_Vendor\Aws\Exception;

use Unity3_Vendor\Aws\HasMonitoringEventsTrait;
use Unity3_Vendor\Aws\MonitoringEventsInterface;
class InvalidJsonException extends \RuntimeException implements MonitoringEventsInterface
{
    use HasMonitoringEventsTrait;
}
