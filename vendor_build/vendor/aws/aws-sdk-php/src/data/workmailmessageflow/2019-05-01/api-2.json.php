<?php

namespace Unity3_Vendor;

// This file was auto-generated from sdk-root/src/data/workmailmessageflow/2019-05-01/api-2.json
return ['version' => '2.0', 'metadata' => ['apiVersion' => '2019-05-01', 'endpointPrefix' => 'workmailmessageflow', 'jsonVersion' => '1.1', 'protocol' => 'rest-json', 'serviceFullName' => 'Amazon WorkMail Message Flow', 'serviceId' => 'WorkMailMessageFlow', 'signatureVersion' => 'v4', 'uid' => 'workmailmessageflow-2019-05-01'], 'operations' => ['GetRawMessageContent' => ['name' => 'GetRawMessageContent', 'http' => ['method' => 'GET', 'requestUri' => '/messages/{messageId}'], 'input' => ['shape' => 'GetRawMessageContentRequest'], 'output' => ['shape' => 'GetRawMessageContentResponse'], 'errors' => [['shape' => 'ResourceNotFoundException']]], 'PutRawMessageContent' => ['name' => 'PutRawMessageContent', 'http' => ['method' => 'POST', 'requestUri' => '/messages/{messageId}'], 'input' => ['shape' => 'PutRawMessageContentRequest'], 'output' => ['shape' => 'PutRawMessageContentResponse'], 'errors' => [['shape' => 'ResourceNotFoundException'], ['shape' => 'InvalidContentLocation'], ['shape' => 'MessageRejected'], ['shape' => 'MessageFrozen']]]], 'shapes' => ['GetRawMessageContentRequest' => ['type' => 'structure', 'required' => ['messageId'], 'members' => ['messageId' => ['shape' => 'messageIdType', 'location' => 'uri', 'locationName' => 'messageId']]], 'GetRawMessageContentResponse' => ['type' => 'structure', 'required' => ['messageContent'], 'members' => ['messageContent' => ['shape' => 'messageContentBlob']], 'payload' => 'messageContent'], 'InvalidContentLocation' => ['type' => 'structure', 'members' => ['message' => ['shape' => 'errorMessage']], 'exception' => \true], 'MessageFrozen' => ['type' => 'structure', 'members' => ['message' => ['shape' => 'errorMessage']], 'exception' => \true], 'MessageRejected' => ['type' => 'structure', 'members' => ['message' => ['shape' => 'errorMessage']], 'exception' => \true], 'PutRawMessageContentRequest' => ['type' => 'structure', 'required' => ['messageId', 'content'], 'members' => ['messageId' => ['shape' => 'messageIdType', 'location' => 'uri', 'locationName' => 'messageId'], 'content' => ['shape' => 'RawMessageContent']]], 'PutRawMessageContentResponse' => ['type' => 'structure', 'members' => []], 'RawMessageContent' => ['type' => 'structure', 'required' => ['s3Reference'], 'members' => ['s3Reference' => ['shape' => 'S3Reference']]], 'ResourceNotFoundException' => ['type' => 'structure', 'members' => ['message' => ['shape' => 'errorMessage']], 'error' => ['httpStatusCode' => 404], 'exception' => \true], 'S3Reference' => ['type' => 'structure', 'required' => ['bucket', 'key'], 'members' => ['bucket' => ['shape' => 's3BucketIdType'], 'key' => ['shape' => 's3KeyIdType'], 'objectVersion' => ['shape' => 's3VersionType']]], 'errorMessage' => ['type' => 'string'], 'messageContentBlob' => ['type' => 'blob', 'streaming' => \true], 'messageIdType' => ['type' => 'string', 'max' => 120, 'min' => 1, 'pattern' => '[a-z0-9\\-]*'], 's3BucketIdType' => ['type' => 'string', 'max' => 63, 'min' => 3, 'pattern' => '^[a-z0-9][a-z0-9\\-]*'], 's3KeyIdType' => ['type' => 'string', 'max' => 1024, 'min' => 1, 'pattern' => '[a-zA-Z0-9\\-/]*'], 's3VersionType' => ['type' => 'string', 'max' => 1024, 'min' => 1, 'pattern' => '.+']]];
