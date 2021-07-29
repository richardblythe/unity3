<?php

namespace Unity3_Vendor;

// This file was auto-generated from sdk-root/src/data/appconfig/2019-10-09/api-2.json
return ['version' => '2.0', 'metadata' => ['apiVersion' => '2019-10-09', 'endpointPrefix' => 'appconfig', 'jsonVersion' => '1.1', 'protocol' => 'rest-json', 'serviceAbbreviation' => 'AppConfig', 'serviceFullName' => 'Amazon AppConfig', 'serviceId' => 'AppConfig', 'signatureVersion' => 'v4', 'signingName' => 'appconfig', 'uid' => 'appconfig-2019-10-09'], 'operations' => ['CreateApplication' => ['name' => 'CreateApplication', 'http' => ['method' => 'POST', 'requestUri' => '/applications', 'responseCode' => 201], 'input' => ['shape' => 'CreateApplicationRequest'], 'output' => ['shape' => 'Application'], 'errors' => [['shape' => 'BadRequestException'], ['shape' => 'InternalServerException']]], 'CreateConfigurationProfile' => ['name' => 'CreateConfigurationProfile', 'http' => ['method' => 'POST', 'requestUri' => '/applications/{ApplicationId}/configurationprofiles', 'responseCode' => 201], 'input' => ['shape' => 'CreateConfigurationProfileRequest'], 'output' => ['shape' => 'ConfigurationProfile'], 'errors' => [['shape' => 'BadRequestException'], ['shape' => 'ResourceNotFoundException'], ['shape' => 'InternalServerException']]], 'CreateDeploymentStrategy' => ['name' => 'CreateDeploymentStrategy', 'http' => ['method' => 'POST', 'requestUri' => '/deploymentstrategies', 'responseCode' => 201], 'input' => ['shape' => 'CreateDeploymentStrategyRequest'], 'output' => ['shape' => 'DeploymentStrategy'], 'errors' => [['shape' => 'InternalServerException'], ['shape' => 'BadRequestException']]], 'CreateEnvironment' => ['name' => 'CreateEnvironment', 'http' => ['method' => 'POST', 'requestUri' => '/applications/{ApplicationId}/environments', 'responseCode' => 201], 'input' => ['shape' => 'CreateEnvironmentRequest'], 'output' => ['shape' => 'Environment'], 'errors' => [['shape' => 'InternalServerException'], ['shape' => 'ResourceNotFoundException'], ['shape' => 'BadRequestException']]], 'CreateHostedConfigurationVersion' => ['name' => 'CreateHostedConfigurationVersion', 'http' => ['method' => 'POST', 'requestUri' => '/applications/{ApplicationId}/configurationprofiles/{ConfigurationProfileId}/hostedconfigurationversions', 'responseCode' => 201], 'input' => ['shape' => 'CreateHostedConfigurationVersionRequest'], 'output' => ['shape' => 'HostedConfigurationVersion'], 'errors' => [['shape' => 'BadRequestException'], ['shape' => 'ServiceQuotaExceededException'], ['shape' => 'ResourceNotFoundException'], ['shape' => 'ConflictException'], ['shape' => 'PayloadTooLargeException'], ['shape' => 'InternalServerException']]], 'DeleteApplication' => ['name' => 'DeleteApplication', 'http' => ['method' => 'DELETE', 'requestUri' => '/applications/{ApplicationId}', 'responseCode' => 204], 'input' => ['shape' => 'DeleteApplicationRequest'], 'errors' => [['shape' => 'ResourceNotFoundException'], ['shape' => 'InternalServerException'], ['shape' => 'BadRequestException']]], 'DeleteConfigurationProfile' => ['name' => 'DeleteConfigurationProfile', 'http' => ['method' => 'DELETE', 'requestUri' => '/applications/{ApplicationId}/configurationprofiles/{ConfigurationProfileId}', 'responseCode' => 204], 'input' => ['shape' => 'DeleteConfigurationProfileRequest'], 'errors' => [['shape' => 'ResourceNotFoundException'], ['shape' => 'ConflictException'], ['shape' => 'InternalServerException'], ['shape' => 'BadRequestException']]], 'DeleteDeploymentStrategy' => ['name' => 'DeleteDeploymentStrategy', 'http' => ['method' => 'DELETE', 'requestUri' => '/deployementstrategies/{DeploymentStrategyId}', 'responseCode' => 204], 'input' => ['shape' => 'DeleteDeploymentStrategyRequest'], 'errors' => [['shape' => 'ResourceNotFoundException'], ['shape' => 'InternalServerException'], ['shape' => 'BadRequestException']]], 'DeleteEnvironment' => ['name' => 'DeleteEnvironment', 'http' => ['method' => 'DELETE', 'requestUri' => '/applications/{ApplicationId}/environments/{EnvironmentId}', 'responseCode' => 204], 'input' => ['shape' => 'DeleteEnvironmentRequest'], 'errors' => [['shape' => 'ResourceNotFoundException'], ['shape' => 'ConflictException'], ['shape' => 'InternalServerException'], ['shape' => 'BadRequestException']]], 'DeleteHostedConfigurationVersion' => ['name' => 'DeleteHostedConfigurationVersion', 'http' => ['method' => 'DELETE', 'requestUri' => '/applications/{ApplicationId}/configurationprofiles/{ConfigurationProfileId}/hostedconfigurationversions/{VersionNumber}', 'responseCode' => 204], 'input' => ['shape' => 'DeleteHostedConfigurationVersionRequest'], 'errors' => [['shape' => 'BadRequestException'], ['shape' => 'ResourceNotFoundException'], ['shape' => 'InternalServerException']]], 'GetApplication' => ['name' => 'GetApplication', 'http' => ['method' => 'GET', 'requestUri' => '/applications/{ApplicationId}', 'responseCode' => 200], 'input' => ['shape' => 'GetApplicationRequest'], 'output' => ['shape' => 'Application'], 'errors' => [['shape' => 'ResourceNotFoundException'], ['shape' => 'InternalServerException'], ['shape' => 'BadRequestException']]], 'GetConfiguration' => ['name' => 'GetConfiguration', 'http' => ['method' => 'GET', 'requestUri' => '/applications/{Application}/environments/{Environment}/configurations/{Configuration}', 'responseCode' => 200], 'input' => ['shape' => 'GetConfigurationRequest'], 'output' => ['shape' => 'Configuration'], 'errors' => [['shape' => 'ResourceNotFoundException'], ['shape' => 'InternalServerException'], ['shape' => 'BadRequestException']]], 'GetConfigurationProfile' => ['name' => 'GetConfigurationProfile', 'http' => ['method' => 'GET', 'requestUri' => '/applications/{ApplicationId}/configurationprofiles/{ConfigurationProfileId}', 'responseCode' => 200], 'input' => ['shape' => 'GetConfigurationProfileRequest'], 'output' => ['shape' => 'ConfigurationProfile'], 'errors' => [['shape' => 'ResourceNotFoundException'], ['shape' => 'InternalServerException'], ['shape' => 'BadRequestException']]], 'GetDeployment' => ['name' => 'GetDeployment', 'http' => ['method' => 'GET', 'requestUri' => '/applications/{ApplicationId}/environments/{EnvironmentId}/deployments/{DeploymentNumber}', 'responseCode' => 200], 'input' => ['shape' => 'GetDeploymentRequest'], 'output' => ['shape' => 'Deployment'], 'errors' => [['shape' => 'ResourceNotFoundException'], ['shape' => 'InternalServerException'], ['shape' => 'BadRequestException']]], 'GetDeploymentStrategy' => ['name' => 'GetDeploymentStrategy', 'http' => ['method' => 'GET', 'requestUri' => '/deploymentstrategies/{DeploymentStrategyId}', 'responseCode' => 200], 'input' => ['shape' => 'GetDeploymentStrategyRequest'], 'output' => ['shape' => 'DeploymentStrategy'], 'errors' => [['shape' => 'ResourceNotFoundException'], ['shape' => 'InternalServerException'], ['shape' => 'BadRequestException']]], 'GetEnvironment' => ['name' => 'GetEnvironment', 'http' => ['method' => 'GET', 'requestUri' => '/applications/{ApplicationId}/environments/{EnvironmentId}', 'responseCode' => 200], 'input' => ['shape' => 'GetEnvironmentRequest'], 'output' => ['shape' => 'Environment'], 'errors' => [['shape' => 'ResourceNotFoundException'], ['shape' => 'InternalServerException'], ['shape' => 'BadRequestException']]], 'GetHostedConfigurationVersion' => ['name' => 'GetHostedConfigurationVersion', 'http' => ['method' => 'GET', 'requestUri' => '/applications/{ApplicationId}/configurationprofiles/{ConfigurationProfileId}/hostedconfigurationversions/{VersionNumber}', 'responseCode' => 200], 'input' => ['shape' => 'GetHostedConfigurationVersionRequest'], 'output' => ['shape' => 'HostedConfigurationVersion'], 'errors' => [['shape' => 'BadRequestException'], ['shape' => 'ResourceNotFoundException'], ['shape' => 'InternalServerException']]], 'ListApplications' => ['name' => 'ListApplications', 'http' => ['method' => 'GET', 'requestUri' => '/applications', 'responseCode' => 200], 'input' => ['shape' => 'ListApplicationsRequest'], 'output' => ['shape' => 'Applications'], 'errors' => [['shape' => 'InternalServerException'], ['shape' => 'BadRequestException']]], 'ListConfigurationProfiles' => ['name' => 'ListConfigurationProfiles', 'http' => ['method' => 'GET', 'requestUri' => '/applications/{ApplicationId}/configurationprofiles', 'responseCode' => 200], 'input' => ['shape' => 'ListConfigurationProfilesRequest'], 'output' => ['shape' => 'ConfigurationProfiles'], 'errors' => [['shape' => 'ResourceNotFoundException'], ['shape' => 'InternalServerException'], ['shape' => 'BadRequestException']]], 'ListDeploymentStrategies' => ['name' => 'ListDeploymentStrategies', 'http' => ['method' => 'GET', 'requestUri' => '/deploymentstrategies', 'responseCode' => 200], 'input' => ['shape' => 'ListDeploymentStrategiesRequest'], 'output' => ['shape' => 'DeploymentStrategies'], 'errors' => [['shape' => 'InternalServerException'], ['shape' => 'BadRequestException']]], 'ListDeployments' => ['name' => 'ListDeployments', 'http' => ['method' => 'GET', 'requestUri' => '/applications/{ApplicationId}/environments/{EnvironmentId}/deployments', 'responseCode' => 200], 'input' => ['shape' => 'ListDeploymentsRequest'], 'output' => ['shape' => 'Deployments'], 'errors' => [['shape' => 'ResourceNotFoundException'], ['shape' => 'InternalServerException'], ['shape' => 'BadRequestException']]], 'ListEnvironments' => ['name' => 'ListEnvironments', 'http' => ['method' => 'GET', 'requestUri' => '/applications/{ApplicationId}/environments', 'responseCode' => 200], 'input' => ['shape' => 'ListEnvironmentsRequest'], 'output' => ['shape' => 'Environments'], 'errors' => [['shape' => 'ResourceNotFoundException'], ['shape' => 'InternalServerException'], ['shape' => 'BadRequestException']]], 'ListHostedConfigurationVersions' => ['name' => 'ListHostedConfigurationVersions', 'http' => ['method' => 'GET', 'requestUri' => '/applications/{ApplicationId}/configurationprofiles/{ConfigurationProfileId}/hostedconfigurationversions', 'responseCode' => 200], 'input' => ['shape' => 'ListHostedConfigurationVersionsRequest'], 'output' => ['shape' => 'HostedConfigurationVersions'], 'errors' => [['shape' => 'BadRequestException'], ['shape' => 'ResourceNotFoundException'], ['shape' => 'InternalServerException']]], 'ListTagsForResource' => ['name' => 'ListTagsForResource', 'http' => ['method' => 'GET', 'requestUri' => '/tags/{ResourceArn}', 'responseCode' => 200], 'input' => ['shape' => 'ListTagsForResourceRequest'], 'output' => ['shape' => 'ResourceTags'], 'errors' => [['shape' => 'ResourceNotFoundException'], ['shape' => 'BadRequestException'], ['shape' => 'InternalServerException']]], 'StartDeployment' => ['name' => 'StartDeployment', 'http' => ['method' => 'POST', 'requestUri' => '/applications/{ApplicationId}/environments/{EnvironmentId}/deployments', 'responseCode' => 201], 'input' => ['shape' => 'StartDeploymentRequest'], 'output' => ['shape' => 'Deployment'], 'errors' => [['shape' => 'BadRequestException'], ['shape' => 'ResourceNotFoundException'], ['shape' => 'ConflictException'], ['shape' => 'InternalServerException']]], 'StopDeployment' => ['name' => 'StopDeployment', 'http' => ['method' => 'DELETE', 'requestUri' => '/applications/{ApplicationId}/environments/{EnvironmentId}/deployments/{DeploymentNumber}', 'responseCode' => 202], 'input' => ['shape' => 'StopDeploymentRequest'], 'output' => ['shape' => 'Deployment'], 'errors' => [['shape' => 'ResourceNotFoundException'], ['shape' => 'InternalServerException'], ['shape' => 'BadRequestException']]], 'TagResource' => ['name' => 'TagResource', 'http' => ['method' => 'POST', 'requestUri' => '/tags/{ResourceArn}', 'responseCode' => 204], 'input' => ['shape' => 'TagResourceRequest'], 'errors' => [['shape' => 'ResourceNotFoundException'], ['shape' => 'BadRequestException'], ['shape' => 'InternalServerException']]], 'UntagResource' => ['name' => 'UntagResource', 'http' => ['method' => 'DELETE', 'requestUri' => '/tags/{ResourceArn}', 'responseCode' => 204], 'input' => ['shape' => 'UntagResourceRequest'], 'errors' => [['shape' => 'ResourceNotFoundException'], ['shape' => 'BadRequestException'], ['shape' => 'InternalServerException']]], 'UpdateApplication' => ['name' => 'UpdateApplication', 'http' => ['method' => 'PATCH', 'requestUri' => '/applications/{ApplicationId}', 'responseCode' => 200], 'input' => ['shape' => 'UpdateApplicationRequest'], 'output' => ['shape' => 'Application'], 'errors' => [['shape' => 'BadRequestException'], ['shape' => 'ResourceNotFoundException'], ['shape' => 'InternalServerException']]], 'UpdateConfigurationProfile' => ['name' => 'UpdateConfigurationProfile', 'http' => ['method' => 'PATCH', 'requestUri' => '/applications/{ApplicationId}/configurationprofiles/{ConfigurationProfileId}', 'responseCode' => 200], 'input' => ['shape' => 'UpdateConfigurationProfileRequest'], 'output' => ['shape' => 'ConfigurationProfile'], 'errors' => [['shape' => 'BadRequestException'], ['shape' => 'ResourceNotFoundException'], ['shape' => 'InternalServerException']]], 'UpdateDeploymentStrategy' => ['name' => 'UpdateDeploymentStrategy', 'http' => ['method' => 'PATCH', 'requestUri' => '/deploymentstrategies/{DeploymentStrategyId}', 'responseCode' => 200], 'input' => ['shape' => 'UpdateDeploymentStrategyRequest'], 'output' => ['shape' => 'DeploymentStrategy'], 'errors' => [['shape' => 'BadRequestException'], ['shape' => 'ResourceNotFoundException'], ['shape' => 'InternalServerException']]], 'UpdateEnvironment' => ['name' => 'UpdateEnvironment', 'http' => ['method' => 'PATCH', 'requestUri' => '/applications/{ApplicationId}/environments/{EnvironmentId}', 'responseCode' => 200], 'input' => ['shape' => 'UpdateEnvironmentRequest'], 'output' => ['shape' => 'Environment'], 'errors' => [['shape' => 'BadRequestException'], ['shape' => 'ResourceNotFoundException'], ['shape' => 'InternalServerException']]], 'ValidateConfiguration' => ['name' => 'ValidateConfiguration', 'http' => ['method' => 'POST', 'requestUri' => '/applications/{ApplicationId}/configurationprofiles/{ConfigurationProfileId}/validators', 'responseCode' => 204], 'input' => ['shape' => 'ValidateConfigurationRequest'], 'errors' => [['shape' => 'BadRequestException'], ['shape' => 'ResourceNotFoundException'], ['shape' => 'InternalServerException']]]], 'shapes' => ['Application' => ['type' => 'structure', 'members' => ['Id' => ['shape' => 'Id'], 'Name' => ['shape' => 'Name'], 'Description' => ['shape' => 'Description']]], 'ApplicationList' => ['type' => 'list', 'member' => ['shape' => 'Application']], 'Applications' => ['type' => 'structure', 'members' => ['Items' => ['shape' => 'ApplicationList'], 'NextToken' => ['shape' => 'NextToken']]], 'Arn' => ['type' => 'string', 'max' => 2048, 'min' => 20, 'pattern' => 'arn:(aws[a-zA-Z-]*)?:[a-z]+:([a-z]{2}((-gov)|(-iso(b?)))?-[a-z]+-\\d{1})?:(\\d{12})?:[a-zA-Z0-9-_/:.]+'], 'BadRequestException' => ['type' => 'structure', 'members' => ['Message' => ['shape' => 'String']], 'error' => ['httpStatusCode' => 400], 'exception' => \true], 'Blob' => ['type' => 'blob', 'sensitive' => \true], 'BytesMeasure' => ['type' => 'string', 'enum' => ['KILOBYTES']], 'Configuration' => ['type' => 'structure', 'members' => ['Content' => ['shape' => 'Blob'], 'ConfigurationVersion' => ['shape' => 'Version', 'location' => 'header', 'locationName' => 'Configuration-Version'], 'ContentType' => ['shape' => 'String', 'location' => 'header', 'locationName' => 'Content-Type']], 'payload' => 'Content'], 'ConfigurationProfile' => ['type' => 'structure', 'members' => ['ApplicationId' => ['shape' => 'Id'], 'Id' => ['shape' => 'Id'], 'Name' => ['shape' => 'Name'], 'Description' => ['shape' => 'Description'], 'LocationUri' => ['shape' => 'Uri'], 'RetrievalRoleArn' => ['shape' => 'RoleArn'], 'Validators' => ['shape' => 'ValidatorList']]], 'ConfigurationProfileSummary' => ['type' => 'structure', 'members' => ['ApplicationId' => ['shape' => 'Id'], 'Id' => ['shape' => 'Id'], 'Name' => ['shape' => 'Name'], 'LocationUri' => ['shape' => 'Uri'], 'ValidatorTypes' => ['shape' => 'ValidatorTypeList']]], 'ConfigurationProfileSummaryList' => ['type' => 'list', 'member' => ['shape' => 'ConfigurationProfileSummary']], 'ConfigurationProfiles' => ['type' => 'structure', 'members' => ['Items' => ['shape' => 'ConfigurationProfileSummaryList'], 'NextToken' => ['shape' => 'NextToken']]], 'ConflictException' => ['type' => 'structure', 'members' => ['Message' => ['shape' => 'String']], 'error' => ['httpStatusCode' => 409], 'exception' => \true], 'CreateApplicationRequest' => ['type' => 'structure', 'required' => ['Name'], 'members' => ['Name' => ['shape' => 'Name'], 'Description' => ['shape' => 'Description'], 'Tags' => ['shape' => 'TagMap']]], 'CreateConfigurationProfileRequest' => ['type' => 'structure', 'required' => ['ApplicationId', 'Name', 'LocationUri'], 'members' => ['ApplicationId' => ['shape' => 'Id', 'location' => 'uri', 'locationName' => 'ApplicationId'], 'Name' => ['shape' => 'Name'], 'Description' => ['shape' => 'Description'], 'LocationUri' => ['shape' => 'Uri'], 'RetrievalRoleArn' => ['shape' => 'RoleArn'], 'Validators' => ['shape' => 'ValidatorList'], 'Tags' => ['shape' => 'TagMap']]], 'CreateDeploymentStrategyRequest' => ['type' => 'structure', 'required' => ['Name', 'DeploymentDurationInMinutes', 'GrowthFactor', 'ReplicateTo'], 'members' => ['Name' => ['shape' => 'Name'], 'Description' => ['shape' => 'Description'], 'DeploymentDurationInMinutes' => ['shape' => 'MinutesBetween0And24Hours', 'box' => \true], 'FinalBakeTimeInMinutes' => ['shape' => 'MinutesBetween0And24Hours'], 'GrowthFactor' => ['shape' => 'GrowthFactor', 'box' => \true], 'GrowthType' => ['shape' => 'GrowthType'], 'ReplicateTo' => ['shape' => 'ReplicateTo'], 'Tags' => ['shape' => 'TagMap']]], 'CreateEnvironmentRequest' => ['type' => 'structure', 'required' => ['ApplicationId', 'Name'], 'members' => ['ApplicationId' => ['shape' => 'Id', 'location' => 'uri', 'locationName' => 'ApplicationId'], 'Name' => ['shape' => 'Name'], 'Description' => ['shape' => 'Description'], 'Monitors' => ['shape' => 'MonitorList'], 'Tags' => ['shape' => 'TagMap']]], 'CreateHostedConfigurationVersionRequest' => ['type' => 'structure', 'required' => ['ApplicationId', 'ConfigurationProfileId', 'Content', 'ContentType'], 'members' => ['ApplicationId' => ['shape' => 'Id', 'location' => 'uri', 'locationName' => 'ApplicationId'], 'ConfigurationProfileId' => ['shape' => 'Id', 'location' => 'uri', 'locationName' => 'ConfigurationProfileId'], 'Description' => ['shape' => 'Description', 'location' => 'header', 'locationName' => 'Description'], 'Content' => ['shape' => 'Blob'], 'ContentType' => ['shape' => 'StringWithLengthBetween1And255', 'location' => 'header', 'locationName' => 'Content-Type'], 'LatestVersionNumber' => ['shape' => 'Integer', 'box' => \true, 'location' => 'header', 'locationName' => 'Latest-Version-Number']], 'payload' => 'Content'], 'DeleteApplicationRequest' => ['type' => 'structure', 'required' => ['ApplicationId'], 'members' => ['ApplicationId' => ['shape' => 'Id', 'location' => 'uri', 'locationName' => 'ApplicationId']]], 'DeleteConfigurationProfileRequest' => ['type' => 'structure', 'required' => ['ApplicationId', 'ConfigurationProfileId'], 'members' => ['ApplicationId' => ['shape' => 'Id', 'location' => 'uri', 'locationName' => 'ApplicationId'], 'ConfigurationProfileId' => ['shape' => 'Id', 'location' => 'uri', 'locationName' => 'ConfigurationProfileId']]], 'DeleteDeploymentStrategyRequest' => ['type' => 'structure', 'required' => ['DeploymentStrategyId'], 'members' => ['DeploymentStrategyId' => ['shape' => 'DeploymentStrategyId', 'location' => 'uri', 'locationName' => 'DeploymentStrategyId']]], 'DeleteEnvironmentRequest' => ['type' => 'structure', 'required' => ['ApplicationId', 'EnvironmentId'], 'members' => ['ApplicationId' => ['shape' => 'Id', 'location' => 'uri', 'locationName' => 'ApplicationId'], 'EnvironmentId' => ['shape' => 'Id', 'location' => 'uri', 'locationName' => 'EnvironmentId']]], 'DeleteHostedConfigurationVersionRequest' => ['type' => 'structure', 'required' => ['ApplicationId', 'ConfigurationProfileId', 'VersionNumber'], 'members' => ['ApplicationId' => ['shape' => 'Id', 'location' => 'uri', 'locationName' => 'ApplicationId'], 'ConfigurationProfileId' => ['shape' => 'Id', 'location' => 'uri', 'locationName' => 'ConfigurationProfileId'], 'VersionNumber' => ['shape' => 'Integer', 'location' => 'uri', 'locationName' => 'VersionNumber']]], 'Deployment' => ['type' => 'structure', 'members' => ['ApplicationId' => ['shape' => 'Id'], 'EnvironmentId' => ['shape' => 'Id'], 'DeploymentStrategyId' => ['shape' => 'Id'], 'ConfigurationProfileId' => ['shape' => 'Id'], 'DeploymentNumber' => ['shape' => 'Integer'], 'ConfigurationName' => ['shape' => 'Name'], 'ConfigurationLocationUri' => ['shape' => 'Uri'], 'ConfigurationVersion' => ['shape' => 'Version'], 'Description' => ['shape' => 'Description'], 'DeploymentDurationInMinutes' => ['shape' => 'MinutesBetween0And24Hours'], 'GrowthType' => ['shape' => 'GrowthType'], 'GrowthFactor' => ['shape' => 'Percentage'], 'FinalBakeTimeInMinutes' => ['shape' => 'MinutesBetween0And24Hours'], 'State' => ['shape' => 'DeploymentState'], 'EventLog' => ['shape' => 'DeploymentEvents'], 'PercentageComplete' => ['shape' => 'Percentage'], 'StartedAt' => ['shape' => 'Iso8601DateTime'], 'CompletedAt' => ['shape' => 'Iso8601DateTime']]], 'DeploymentEvent' => ['type' => 'structure', 'members' => ['EventType' => ['shape' => 'DeploymentEventType'], 'TriggeredBy' => ['shape' => 'TriggeredBy'], 'Description' => ['shape' => 'Description'], 'OccurredAt' => ['shape' => 'Iso8601DateTime']]], 'DeploymentEventType' => ['type' => 'string', 'enum' => ['PERCENTAGE_UPDATED', 'ROLLBACK_STARTED', 'ROLLBACK_COMPLETED', 'BAKE_TIME_STARTED', 'DEPLOYMENT_STARTED', 'DEPLOYMENT_COMPLETED']], 'DeploymentEvents' => ['type' => 'list', 'member' => ['shape' => 'DeploymentEvent']], 'DeploymentList' => ['type' => 'list', 'member' => ['shape' => 'DeploymentSummary']], 'DeploymentState' => ['type' => 'string', 'enum' => ['BAKING', 'VALIDATING', 'DEPLOYING', 'COMPLETE', 'ROLLING_BACK', 'ROLLED_BACK']], 'DeploymentStrategies' => ['type' => 'structure', 'members' => ['Items' => ['shape' => 'DeploymentStrategyList'], 'NextToken' => ['shape' => 'NextToken']]], 'DeploymentStrategy' => ['type' => 'structure', 'members' => ['Id' => ['shape' => 'Id'], 'Name' => ['shape' => 'Name'], 'Description' => ['shape' => 'Description'], 'DeploymentDurationInMinutes' => ['shape' => 'MinutesBetween0And24Hours'], 'GrowthType' => ['shape' => 'GrowthType'], 'GrowthFactor' => ['shape' => 'Percentage'], 'FinalBakeTimeInMinutes' => ['shape' => 'MinutesBetween0And24Hours'], 'ReplicateTo' => ['shape' => 'ReplicateTo']]], 'DeploymentStrategyId' => ['type' => 'string', 'pattern' => '(^[a-z0-9]{4,7}$|^AppConfig\\.[A-Za-z0-9]{9,40}$)'], 'DeploymentStrategyList' => ['type' => 'list', 'member' => ['shape' => 'DeploymentStrategy']], 'DeploymentSummary' => ['type' => 'structure', 'members' => ['DeploymentNumber' => ['shape' => 'Integer'], 'ConfigurationName' => ['shape' => 'Name'], 'ConfigurationVersion' => ['shape' => 'Version'], 'DeploymentDurationInMinutes' => ['shape' => 'MinutesBetween0And24Hours'], 'GrowthType' => ['shape' => 'GrowthType'], 'GrowthFactor' => ['shape' => 'Percentage'], 'FinalBakeTimeInMinutes' => ['shape' => 'MinutesBetween0And24Hours'], 'State' => ['shape' => 'DeploymentState'], 'PercentageComplete' => ['shape' => 'Percentage'], 'StartedAt' => ['shape' => 'Iso8601DateTime'], 'CompletedAt' => ['shape' => 'Iso8601DateTime']]], 'Deployments' => ['type' => 'structure', 'members' => ['Items' => ['shape' => 'DeploymentList'], 'NextToken' => ['shape' => 'NextToken']]], 'Description' => ['type' => 'string', 'max' => 1024, 'min' => 0], 'Environment' => ['type' => 'structure', 'members' => ['ApplicationId' => ['shape' => 'Id'], 'Id' => ['shape' => 'Id'], 'Name' => ['shape' => 'Name'], 'Description' => ['shape' => 'Description'], 'State' => ['shape' => 'EnvironmentState'], 'Monitors' => ['shape' => 'MonitorList']]], 'EnvironmentList' => ['type' => 'list', 'member' => ['shape' => 'Environment']], 'EnvironmentState' => ['type' => 'string', 'enum' => ['READY_FOR_DEPLOYMENT', 'DEPLOYING', 'ROLLING_BACK', 'ROLLED_BACK']], 'Environments' => ['type' => 'structure', 'members' => ['Items' => ['shape' => 'EnvironmentList'], 'NextToken' => ['shape' => 'NextToken']]], 'Float' => ['type' => 'float'], 'GetApplicationRequest' => ['type' => 'structure', 'required' => ['ApplicationId'], 'members' => ['ApplicationId' => ['shape' => 'Id', 'location' => 'uri', 'locationName' => 'ApplicationId']]], 'GetConfigurationProfileRequest' => ['type' => 'structure', 'required' => ['ApplicationId', 'ConfigurationProfileId'], 'members' => ['ApplicationId' => ['shape' => 'Id', 'location' => 'uri', 'locationName' => 'ApplicationId'], 'ConfigurationProfileId' => ['shape' => 'Id', 'location' => 'uri', 'locationName' => 'ConfigurationProfileId']]], 'GetConfigurationRequest' => ['type' => 'structure', 'required' => ['Application', 'Environment', 'Configuration', 'ClientId'], 'members' => ['Application' => ['shape' => 'StringWithLengthBetween1And64', 'location' => 'uri', 'locationName' => 'Application'], 'Environment' => ['shape' => 'StringWithLengthBetween1And64', 'location' => 'uri', 'locationName' => 'Environment'], 'Configuration' => ['shape' => 'StringWithLengthBetween1And64', 'location' => 'uri', 'locationName' => 'Configuration'], 'ClientId' => ['shape' => 'StringWithLengthBetween1And64', 'location' => 'querystring', 'locationName' => 'client_id'], 'ClientConfigurationVersion' => ['shape' => 'Version', 'location' => 'querystring', 'locationName' => 'client_configuration_version']]], 'GetDeploymentRequest' => ['type' => 'structure', 'required' => ['ApplicationId', 'EnvironmentId', 'DeploymentNumber'], 'members' => ['ApplicationId' => ['shape' => 'Id', 'location' => 'uri', 'locationName' => 'ApplicationId'], 'EnvironmentId' => ['shape' => 'Id', 'location' => 'uri', 'locationName' => 'EnvironmentId'], 'DeploymentNumber' => ['shape' => 'Integer', 'box' => \true, 'location' => 'uri', 'locationName' => 'DeploymentNumber']]], 'GetDeploymentStrategyRequest' => ['type' => 'structure', 'required' => ['DeploymentStrategyId'], 'members' => ['DeploymentStrategyId' => ['shape' => 'DeploymentStrategyId', 'location' => 'uri', 'locationName' => 'DeploymentStrategyId']]], 'GetEnvironmentRequest' => ['type' => 'structure', 'required' => ['ApplicationId', 'EnvironmentId'], 'members' => ['ApplicationId' => ['shape' => 'Id', 'location' => 'uri', 'locationName' => 'ApplicationId'], 'EnvironmentId' => ['shape' => 'Id', 'location' => 'uri', 'locationName' => 'EnvironmentId']]], 'GetHostedConfigurationVersionRequest' => ['type' => 'structure', 'required' => ['ApplicationId', 'ConfigurationProfileId', 'VersionNumber'], 'members' => ['ApplicationId' => ['shape' => 'Id', 'location' => 'uri', 'locationName' => 'ApplicationId'], 'ConfigurationProfileId' => ['shape' => 'Id', 'location' => 'uri', 'locationName' => 'ConfigurationProfileId'], 'VersionNumber' => ['shape' => 'Integer', 'location' => 'uri', 'locationName' => 'VersionNumber']]], 'GrowthFactor' => ['type' => 'float', 'max' => 100, 'min' => 1], 'GrowthType' => ['type' => 'string', 'enum' => ['LINEAR', 'EXPONENTIAL']], 'HostedConfigurationVersion' => ['type' => 'structure', 'members' => ['ApplicationId' => ['shape' => 'Id', 'location' => 'header', 'locationName' => 'Application-Id'], 'ConfigurationProfileId' => ['shape' => 'Id', 'location' => 'header', 'locationName' => 'Configuration-Profile-Id'], 'VersionNumber' => ['shape' => 'Integer', 'location' => 'header', 'locationName' => 'Version-Number'], 'Description' => ['shape' => 'Description', 'location' => 'header', 'locationName' => 'Description'], 'Content' => ['shape' => 'Blob'], 'ContentType' => ['shape' => 'StringWithLengthBetween1And255', 'location' => 'header', 'locationName' => 'Content-Type']], 'payload' => 'Content'], 'HostedConfigurationVersionSummary' => ['type' => 'structure', 'members' => ['ApplicationId' => ['shape' => 'Id'], 'ConfigurationProfileId' => ['shape' => 'Id'], 'VersionNumber' => ['shape' => 'Integer'], 'Description' => ['shape' => 'Description'], 'ContentType' => ['shape' => 'StringWithLengthBetween1And255']]], 'HostedConfigurationVersionSummaryList' => ['type' => 'list', 'member' => ['shape' => 'HostedConfigurationVersionSummary']], 'HostedConfigurationVersions' => ['type' => 'structure', 'members' => ['Items' => ['shape' => 'HostedConfigurationVersionSummaryList'], 'NextToken' => ['shape' => 'NextToken']]], 'Id' => ['type' => 'string', 'pattern' => '[a-z0-9]{4,7}'], 'Integer' => ['type' => 'integer'], 'InternalServerException' => ['type' => 'structure', 'members' => ['Message' => ['shape' => 'String']], 'error' => ['httpStatusCode' => 500], 'exception' => \true, 'fault' => \true], 'Iso8601DateTime' => ['type' => 'timestamp', 'timestampFormat' => 'iso8601'], 'ListApplicationsRequest' => ['type' => 'structure', 'members' => ['MaxResults' => ['shape' => 'MaxResults', 'box' => \true, 'location' => 'querystring', 'locationName' => 'max_results'], 'NextToken' => ['shape' => 'NextToken', 'location' => 'querystring', 'locationName' => 'next_token']]], 'ListConfigurationProfilesRequest' => ['type' => 'structure', 'required' => ['ApplicationId'], 'members' => ['ApplicationId' => ['shape' => 'Id', 'location' => 'uri', 'locationName' => 'ApplicationId'], 'MaxResults' => ['shape' => 'MaxResults', 'box' => \true, 'location' => 'querystring', 'locationName' => 'max_results'], 'NextToken' => ['shape' => 'NextToken', 'location' => 'querystring', 'locationName' => 'next_token']]], 'ListDeploymentStrategiesRequest' => ['type' => 'structure', 'members' => ['MaxResults' => ['shape' => 'MaxResults', 'box' => \true, 'location' => 'querystring', 'locationName' => 'max_results'], 'NextToken' => ['shape' => 'NextToken', 'location' => 'querystring', 'locationName' => 'next_token']]], 'ListDeploymentsRequest' => ['type' => 'structure', 'required' => ['ApplicationId', 'EnvironmentId'], 'members' => ['ApplicationId' => ['shape' => 'Id', 'location' => 'uri', 'locationName' => 'ApplicationId'], 'EnvironmentId' => ['shape' => 'Id', 'location' => 'uri', 'locationName' => 'EnvironmentId'], 'MaxResults' => ['shape' => 'MaxResults', 'box' => \true, 'location' => 'querystring', 'locationName' => 'max_results'], 'NextToken' => ['shape' => 'NextToken', 'location' => 'querystring', 'locationName' => 'next_token']]], 'ListEnvironmentsRequest' => ['type' => 'structure', 'required' => ['ApplicationId'], 'members' => ['ApplicationId' => ['shape' => 'Id', 'location' => 'uri', 'locationName' => 'ApplicationId'], 'MaxResults' => ['shape' => 'MaxResults', 'box' => \true, 'location' => 'querystring', 'locationName' => 'max_results'], 'NextToken' => ['shape' => 'NextToken', 'location' => 'querystring', 'locationName' => 'next_token']]], 'ListHostedConfigurationVersionsRequest' => ['type' => 'structure', 'required' => ['ApplicationId', 'ConfigurationProfileId'], 'members' => ['ApplicationId' => ['shape' => 'Id', 'location' => 'uri', 'locationName' => 'ApplicationId'], 'ConfigurationProfileId' => ['shape' => 'Id', 'location' => 'uri', 'locationName' => 'ConfigurationProfileId'], 'MaxResults' => ['shape' => 'MaxResults', 'box' => \true, 'location' => 'querystring', 'locationName' => 'max_results'], 'NextToken' => ['shape' => 'NextToken', 'location' => 'querystring', 'locationName' => 'next_token']]], 'ListTagsForResourceRequest' => ['type' => 'structure', 'required' => ['ResourceArn'], 'members' => ['ResourceArn' => ['shape' => 'Arn', 'location' => 'uri', 'locationName' => 'ResourceArn']]], 'MaxResults' => ['type' => 'integer', 'max' => 50, 'min' => 1], 'MinutesBetween0And24Hours' => ['type' => 'integer', 'max' => 1440, 'min' => 0], 'Monitor' => ['type' => 'structure', 'members' => ['AlarmArn' => ['shape' => 'Arn'], 'AlarmRoleArn' => ['shape' => 'RoleArn']]], 'MonitorList' => ['type' => 'list', 'member' => ['shape' => 'Monitor'], 'max' => 5, 'min' => 0], 'Name' => ['type' => 'string', 'max' => 64, 'min' => 1], 'NextToken' => ['type' => 'string', 'max' => 2048, 'min' => 1], 'PayloadTooLargeException' => ['type' => 'structure', 'members' => ['Message' => ['shape' => 'String'], 'Measure' => ['shape' => 'BytesMeasure'], 'Limit' => ['shape' => 'Float'], 'Size' => ['shape' => 'Float']], 'error' => ['httpStatusCode' => 413], 'exception' => \true], 'Percentage' => ['type' => 'float', 'max' => 100, 'min' => 1], 'ReplicateTo' => ['type' => 'string', 'enum' => ['NONE', 'SSM_DOCUMENT']], 'ResourceNotFoundException' => ['type' => 'structure', 'members' => ['Message' => ['shape' => 'String'], 'ResourceName' => ['shape' => 'String']], 'error' => ['httpStatusCode' => 404], 'exception' => \true], 'ResourceTags' => ['type' => 'structure', 'members' => ['Tags' => ['shape' => 'TagMap']]], 'RoleArn' => ['type' => 'string', 'max' => 2048, 'min' => 20, 'pattern' => '^((arn):(aws|aws-cn|aws-iso|aws-iso-[a-z]{1}|aws-us-gov):(iam)::\\d{12}:role[/].*)$'], 'ServiceQuotaExceededException' => ['type' => 'structure', 'members' => ['Message' => ['shape' => 'String']], 'error' => ['httpStatusCode' => 402], 'exception' => \true], 'StartDeploymentRequest' => ['type' => 'structure', 'required' => ['ApplicationId', 'EnvironmentId', 'DeploymentStrategyId', 'ConfigurationProfileId', 'ConfigurationVersion'], 'members' => ['ApplicationId' => ['shape' => 'Id', 'location' => 'uri', 'locationName' => 'ApplicationId'], 'EnvironmentId' => ['shape' => 'Id', 'location' => 'uri', 'locationName' => 'EnvironmentId'], 'DeploymentStrategyId' => ['shape' => 'DeploymentStrategyId'], 'ConfigurationProfileId' => ['shape' => 'Id'], 'ConfigurationVersion' => ['shape' => 'Version'], 'Description' => ['shape' => 'Description'], 'Tags' => ['shape' => 'TagMap']]], 'StopDeploymentRequest' => ['type' => 'structure', 'required' => ['ApplicationId', 'EnvironmentId', 'DeploymentNumber'], 'members' => ['ApplicationId' => ['shape' => 'Id', 'location' => 'uri', 'locationName' => 'ApplicationId'], 'EnvironmentId' => ['shape' => 'Id', 'location' => 'uri', 'locationName' => 'EnvironmentId'], 'DeploymentNumber' => ['shape' => 'Integer', 'box' => \true, 'location' => 'uri', 'locationName' => 'DeploymentNumber']]], 'String' => ['type' => 'string'], 'StringWithLengthBetween0And32768' => ['type' => 'string', 'max' => 32768, 'min' => 0, 'sensitive' => \true], 'StringWithLengthBetween1And255' => ['type' => 'string', 'max' => 255, 'min' => 1], 'StringWithLengthBetween1And64' => ['type' => 'string', 'max' => 64, 'min' => 1], 'TagKey' => ['type' => 'string', 'max' => 128, 'min' => 1], 'TagKeyList' => ['type' => 'list', 'member' => ['shape' => 'TagKey'], 'max' => 50, 'min' => 0], 'TagMap' => ['type' => 'map', 'key' => ['shape' => 'TagKey'], 'value' => ['shape' => 'TagValue'], 'max' => 50, 'min' => 0], 'TagResourceRequest' => ['type' => 'structure', 'required' => ['ResourceArn', 'Tags'], 'members' => ['ResourceArn' => ['shape' => 'Arn', 'location' => 'uri', 'locationName' => 'ResourceArn'], 'Tags' => ['shape' => 'TagMap']]], 'TagValue' => ['type' => 'string', 'max' => 256], 'TriggeredBy' => ['type' => 'string', 'enum' => ['USER', 'APPCONFIG', 'CLOUDWATCH_ALARM', 'INTERNAL_ERROR']], 'UntagResourceRequest' => ['type' => 'structure', 'required' => ['ResourceArn', 'TagKeys'], 'members' => ['ResourceArn' => ['shape' => 'Arn', 'location' => 'uri', 'locationName' => 'ResourceArn'], 'TagKeys' => ['shape' => 'TagKeyList', 'location' => 'querystring', 'locationName' => 'tagKeys']]], 'UpdateApplicationRequest' => ['type' => 'structure', 'required' => ['ApplicationId'], 'members' => ['ApplicationId' => ['shape' => 'Id', 'location' => 'uri', 'locationName' => 'ApplicationId'], 'Name' => ['shape' => 'Name'], 'Description' => ['shape' => 'Description']]], 'UpdateConfigurationProfileRequest' => ['type' => 'structure', 'required' => ['ApplicationId', 'ConfigurationProfileId'], 'members' => ['ApplicationId' => ['shape' => 'Id', 'location' => 'uri', 'locationName' => 'ApplicationId'], 'ConfigurationProfileId' => ['shape' => 'Id', 'location' => 'uri', 'locationName' => 'ConfigurationProfileId'], 'Name' => ['shape' => 'Name'], 'Description' => ['shape' => 'Description'], 'RetrievalRoleArn' => ['shape' => 'RoleArn'], 'Validators' => ['shape' => 'ValidatorList']]], 'UpdateDeploymentStrategyRequest' => ['type' => 'structure', 'required' => ['DeploymentStrategyId'], 'members' => ['DeploymentStrategyId' => ['shape' => 'DeploymentStrategyId', 'location' => 'uri', 'locationName' => 'DeploymentStrategyId'], 'Description' => ['shape' => 'Description'], 'DeploymentDurationInMinutes' => ['shape' => 'MinutesBetween0And24Hours', 'box' => \true], 'FinalBakeTimeInMinutes' => ['shape' => 'MinutesBetween0And24Hours', 'box' => \true], 'GrowthFactor' => ['shape' => 'GrowthFactor', 'box' => \true], 'GrowthType' => ['shape' => 'GrowthType']]], 'UpdateEnvironmentRequest' => ['type' => 'structure', 'required' => ['ApplicationId', 'EnvironmentId'], 'members' => ['ApplicationId' => ['shape' => 'Id', 'location' => 'uri', 'locationName' => 'ApplicationId'], 'EnvironmentId' => ['shape' => 'Id', 'location' => 'uri', 'locationName' => 'EnvironmentId'], 'Name' => ['shape' => 'Name'], 'Description' => ['shape' => 'Description'], 'Monitors' => ['shape' => 'MonitorList']]], 'Uri' => ['type' => 'string', 'max' => 2048, 'min' => 1], 'ValidateConfigurationRequest' => ['type' => 'structure', 'required' => ['ApplicationId', 'ConfigurationProfileId', 'ConfigurationVersion'], 'members' => ['ApplicationId' => ['shape' => 'Id', 'location' => 'uri', 'locationName' => 'ApplicationId'], 'ConfigurationProfileId' => ['shape' => 'Id', 'location' => 'uri', 'locationName' => 'ConfigurationProfileId'], 'ConfigurationVersion' => ['shape' => 'Version', 'location' => 'querystring', 'locationName' => 'configuration_version']]], 'Validator' => ['type' => 'structure', 'required' => ['Type', 'Content'], 'members' => ['Type' => ['shape' => 'ValidatorType'], 'Content' => ['shape' => 'StringWithLengthBetween0And32768']]], 'ValidatorList' => ['type' => 'list', 'member' => ['shape' => 'Validator'], 'max' => 2, 'min' => 0], 'ValidatorType' => ['type' => 'string', 'enum' => ['JSON_SCHEMA', 'LAMBDA']], 'ValidatorTypeList' => ['type' => 'list', 'member' => ['shape' => 'ValidatorType'], 'max' => 2, 'min' => 0], 'Version' => ['type' => 'string', 'max' => 1024, 'min' => 1]]];
