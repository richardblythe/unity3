<?php

namespace Unity3_Vendor\Aws\Handler\GuzzleV6;

use Exception;
use Unity3_Vendor\GuzzleHttp\Exception\ConnectException;
use Unity3_Vendor\GuzzleHttp\Exception\RequestException;
use Unity3_Vendor\GuzzleHttp\Promise;
use Unity3_Vendor\GuzzleHttp\Client;
use Unity3_Vendor\GuzzleHttp\ClientInterface;
use Unity3_Vendor\GuzzleHttp\TransferStats;
use Unity3_Vendor\Psr\Http\Message\RequestInterface as Psr7Request;
/**
 * A request handler that sends PSR-7-compatible requests with Guzzle 6.
 */
class GuzzleHandler
{
    /** @var ClientInterface */
    private $client;
    /**
     * @param ClientInterface $client
     */
    public function __construct(ClientInterface $client = null)
    {
        $this->client = $client ?: new Client();
    }
    /**
     * @param Psr7Request $request
     * @param array       $options
     *
     * @return Promise\Promise
     */
    public function __invoke(Psr7Request $request, array $options = [])
    {
        $request = $request->withHeader('User-Agent', $request->getHeaderLine('User-Agent') . ' ' . \Unity3_Vendor\GuzzleHttp\default_user_agent());
        return $this->client->sendAsync($request, $this->parseOptions($options))->otherwise(static function ($e) {
            $error = ['exception' => $e, 'connection_error' => $e instanceof ConnectException, 'response' => null];
            if ($e instanceof RequestException && $e->getResponse()) {
                $error['response'] = $e->getResponse();
            } else {
                if (\class_exists('Error') && $e instanceof \Error && $e->getResponse()) {
                    $error['response'] = $e->getResponse();
                }
            }
            return new Promise\RejectedPromise($error);
        });
    }
    private function parseOptions(array $options)
    {
        if (isset($options['http_stats_receiver'])) {
            $fn = $options['http_stats_receiver'];
            unset($options['http_stats_receiver']);
            $prev = isset($options['on_stats']) ? $options['on_stats'] : null;
            $options['on_stats'] = static function (TransferStats $stats) use($fn, $prev) {
                if (\is_callable($prev)) {
                    $prev($stats);
                }
                $transferStats = ['total_time' => $stats->getTransferTime()];
                $transferStats += $stats->getHandlerStats();
                $fn($transferStats);
            };
        }
        return $options;
    }
}
