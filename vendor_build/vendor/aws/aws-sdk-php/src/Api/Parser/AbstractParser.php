<?php

namespace Unity3_Vendor\Aws\Api\Parser;

use Unity3_Vendor\Aws\Api\Service;
use Unity3_Vendor\Aws\Api\StructureShape;
use Unity3_Vendor\Aws\CommandInterface;
use Unity3_Vendor\Aws\ResultInterface;
use Unity3_Vendor\Psr\Http\Message\ResponseInterface;
use Unity3_Vendor\Psr\Http\Message\StreamInterface;
/**
 * @internal
 */
abstract class AbstractParser
{
    /** @var \Aws\Api\Service Representation of the service API*/
    protected $api;
    /** @var callable */
    protected $parser;
    /**
     * @param Service $api Service description.
     */
    public function __construct(Service $api)
    {
        $this->api = $api;
    }
    /**
     * @param CommandInterface  $command  Command that was executed.
     * @param ResponseInterface $response Response that was received.
     *
     * @return ResultInterface
     */
    public abstract function __invoke(CommandInterface $command, ResponseInterface $response);
    public abstract function parseMemberFromStream(StreamInterface $stream, StructureShape $member, $response);
}
