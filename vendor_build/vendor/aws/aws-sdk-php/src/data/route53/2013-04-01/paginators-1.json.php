<?php

namespace Unity3_Vendor;

// This file was auto-generated from sdk-root/src/data/route53/2013-04-01/paginators-1.json
return ['pagination' => ['ListHealthChecks' => ['input_token' => 'Marker', 'limit_key' => 'MaxItems', 'more_results' => 'IsTruncated', 'output_token' => 'NextMarker', 'result_key' => 'HealthChecks'], 'ListHostedZones' => ['input_token' => 'Marker', 'limit_key' => 'MaxItems', 'more_results' => 'IsTruncated', 'output_token' => 'NextMarker', 'result_key' => 'HostedZones'], 'ListQueryLoggingConfigs' => ['input_token' => 'NextToken', 'limit_key' => 'MaxResults', 'output_token' => 'NextToken', 'result_key' => 'QueryLoggingConfigs'], 'ListResourceRecordSets' => ['input_token' => ['StartRecordName', 'StartRecordType', 'StartRecordIdentifier'], 'limit_key' => 'MaxItems', 'more_results' => 'IsTruncated', 'output_token' => ['NextRecordName', 'NextRecordType', 'NextRecordIdentifier'], 'result_key' => 'ResourceRecordSets']]];
