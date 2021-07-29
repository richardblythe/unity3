<?php

namespace Unity3_Vendor\Aws\ClientSideMonitoring;

use Unity3_Vendor\Aws\CommandInterface;
use Unity3_Vendor\Aws\Exception\AwsException;
use Unity3_Vendor\Aws\ResultInterface;
use Unity3_Vendor\GuzzleHttp\Psr7\Request;
use Unity3_Vendor\Psr\Http\Message\RequestInterface;
/**
 * @internal
 */
interface MonitoringMiddlewareInterface
{
    /**
     * Data for event properties to be sent to the monitoring agent.
     *
     * @param RequestInterface $request
     * @return array
     */
    public static function getRequestData(RequestInterface $request);
    /**
     * Data for event properties to be sent to the monitoring agent.
     *
     * @param ResultInterface|AwsException|\Exception $klass
     * @return array
     */
    public static function getResponseData($klass);
    public function __invoke(CommandInterface $cmd, RequestInterface $request);
}
