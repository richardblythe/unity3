<?php

namespace Unity3_Vendor;

// This file was auto-generated from sdk-root/src/data/kinesis-video-signaling/2019-12-04/api-2.json
return ['version' => '2.0', 'metadata' => ['apiVersion' => '2019-12-04', 'endpointPrefix' => 'kinesisvideo', 'protocol' => 'rest-json', 'serviceAbbreviation' => 'Amazon Kinesis Video Signaling Channels', 'serviceFullName' => 'Amazon Kinesis Video Signaling Channels', 'serviceId' => 'Kinesis Video Signaling', 'signatureVersion' => 'v4', 'uid' => 'kinesis-video-signaling-2019-12-04'], 'operations' => ['GetIceServerConfig' => ['name' => 'GetIceServerConfig', 'http' => ['method' => 'POST', 'requestUri' => '/v1/get-ice-server-config'], 'input' => ['shape' => 'GetIceServerConfigRequest'], 'output' => ['shape' => 'GetIceServerConfigResponse'], 'errors' => [['shape' => 'InvalidClientException'], ['shape' => 'SessionExpiredException'], ['shape' => 'ClientLimitExceededException'], ['shape' => 'ResourceNotFoundException'], ['shape' => 'InvalidArgumentException'], ['shape' => 'NotAuthorizedException']]], 'SendAlexaOfferToMaster' => ['name' => 'SendAlexaOfferToMaster', 'http' => ['method' => 'POST', 'requestUri' => '/v1/send-alexa-offer-to-master'], 'input' => ['shape' => 'SendAlexaOfferToMasterRequest'], 'output' => ['shape' => 'SendAlexaOfferToMasterResponse'], 'errors' => [['shape' => 'ClientLimitExceededException'], ['shape' => 'ResourceNotFoundException'], ['shape' => 'InvalidArgumentException'], ['shape' => 'NotAuthorizedException']]]], 'shapes' => ['Answer' => ['type' => 'string', 'max' => 10000, 'min' => 1], 'ClientId' => ['type' => 'string', 'max' => 256, 'min' => 1, 'pattern' => '[a-zA-Z0-9_.-]+'], 'ClientLimitExceededException' => ['type' => 'structure', 'members' => ['Message' => ['shape' => 'ErrorMessage']], 'error' => ['httpStatusCode' => 400], 'exception' => \true], 'ErrorMessage' => ['type' => 'string'], 'GetIceServerConfigRequest' => ['type' => 'structure', 'required' => ['ChannelARN'], 'members' => ['ChannelARN' => ['shape' => 'ResourceARN'], 'ClientId' => ['shape' => 'ClientId'], 'Service' => ['shape' => 'Service'], 'Username' => ['shape' => 'Username']]], 'GetIceServerConfigResponse' => ['type' => 'structure', 'members' => ['IceServerList' => ['shape' => 'IceServerList']]], 'IceServer' => ['type' => 'structure', 'members' => ['Uris' => ['shape' => 'Uris'], 'Username' => ['shape' => 'Username'], 'Password' => ['shape' => 'Password'], 'Ttl' => ['shape' => 'Ttl']]], 'IceServerList' => ['type' => 'list', 'member' => ['shape' => 'IceServer']], 'InvalidArgumentException' => ['type' => 'structure', 'members' => ['Message' => ['shape' => 'ErrorMessage']], 'error' => ['httpStatusCode' => 400], 'exception' => \true], 'InvalidClientException' => ['type' => 'structure', 'members' => ['message' => ['shape' => 'errorMessage']], 'error' => ['httpStatusCode' => 400], 'exception' => \true], 'MessagePayload' => ['type' => 'string', 'max' => 10000, 'min' => 1, 'pattern' => '[a-zA-Z0-9+/=]+'], 'NotAuthorizedException' => ['type' => 'structure', 'members' => ['Message' => ['shape' => 'ErrorMessage']], 'error' => ['httpStatusCode' => 401], 'exception' => \true], 'Password' => ['type' => 'string', 'max' => 256, 'min' => 1, 'pattern' => '[a-zA-Z0-9_.-]+'], 'ResourceARN' => ['type' => 'string', 'max' => 1024, 'min' => 1, 'pattern' => 'arn:aws:kinesisvideo:[a-z0-9-]+:[0-9]+:[a-z]+/[a-zA-Z0-9_.-]+/[0-9]+'], 'ResourceNotFoundException' => ['type' => 'structure', 'members' => ['Message' => ['shape' => 'ErrorMessage']], 'error' => ['httpStatusCode' => 404], 'exception' => \true], 'SendAlexaOfferToMasterRequest' => ['type' => 'structure', 'required' => ['ChannelARN', 'SenderClientId', 'MessagePayload'], 'members' => ['ChannelARN' => ['shape' => 'ResourceARN'], 'SenderClientId' => ['shape' => 'ClientId'], 'MessagePayload' => ['shape' => 'MessagePayload']]], 'SendAlexaOfferToMasterResponse' => ['type' => 'structure', 'members' => ['Answer' => ['shape' => 'Answer']]], 'Service' => ['type' => 'string', 'enum' => ['TURN']], 'SessionExpiredException' => ['type' => 'structure', 'members' => ['message' => ['shape' => 'errorMessage']], 'error' => ['httpStatusCode' => 400], 'exception' => \true], 'Ttl' => ['type' => 'integer', 'max' => 86400, 'min' => 30], 'Uri' => ['type' => 'string', 'max' => 256, 'min' => 1], 'Uris' => ['type' => 'list', 'member' => ['shape' => 'Uri']], 'Username' => ['type' => 'string', 'max' => 256, 'min' => 1, 'pattern' => '[a-zA-Z0-9_.-]+'], 'errorMessage' => ['type' => 'string']]];
