<?php

namespace Unity3_Vendor;

// This file was auto-generated from sdk-root/src/data/proton/2020-07-20/waiters-2.json
return ['version' => 2, 'waiters' => ['EnvironmentDeployed' => ['description' => 'Wait until an Environment is deployed. Use this after invoking CreateEnvironment or UpdateEnvironment', 'delay' => 5, 'maxAttempts' => 999, 'operation' => 'GetEnvironment', 'acceptors' => [['matcher' => 'path', 'argument' => 'environment.deploymentStatus', 'state' => 'success', 'expected' => 'SUCCEEDED'], ['matcher' => 'path', 'argument' => 'environment.deploymentStatus', 'state' => 'failure', 'expected' => 'FAILED']]], 'EnvironmentTemplateVersionRegistered' => ['description' => 'Wait until an EnvironmentTemplateVersion is registered. Use this after invoking CreateEnvironmentTemplateVersion', 'delay' => 2, 'maxAttempts' => 150, 'operation' => 'GetEnvironmentTemplateVersion', 'acceptors' => [['matcher' => 'path', 'argument' => 'environmentTemplateVersion.status', 'state' => 'success', 'expected' => 'DRAFT'], ['matcher' => 'path', 'argument' => 'environmentTemplateVersion.status', 'state' => 'success', 'expected' => 'PUBLISHED'], ['matcher' => 'path', 'argument' => 'environmentTemplateVersion.status', 'state' => 'failure', 'expected' => 'REGISTRATION_FAILED']]], 'ServiceCreated' => ['description' => 'Wait until an Service has deployed its instances and possibly pipeline. Use this after invoking CreateService', 'delay' => 5, 'maxAttempts' => 999, 'operation' => 'GetService', 'acceptors' => [['matcher' => 'path', 'argument' => 'service.status', 'state' => 'success', 'expected' => 'ACTIVE'], ['matcher' => 'path', 'argument' => 'service.status', 'state' => 'failure', 'expected' => 'CREATE_FAILED_CLEANUP_COMPLETE'], ['matcher' => 'path', 'argument' => 'service.status', 'state' => 'failure', 'expected' => 'CREATE_FAILED_CLEANUP_FAILED'], ['matcher' => 'path', 'argument' => 'service.status', 'state' => 'failure', 'expected' => 'CREATE_FAILED']]], 'ServiceDeleted' => ['description' => 'Wait until a Service, its instances, and possibly pipeline have been deleted after DeleteService is invoked', 'delay' => 5, 'maxAttempts' => 999, 'operation' => 'GetService', 'acceptors' => [['matcher' => 'error', 'state' => 'success', 'expected' => 'ResourceNotFoundException'], ['matcher' => 'path', 'argument' => 'service.status', 'state' => 'failure', 'expected' => 'DELETE_FAILED']]], 'ServiceInstanceDeployed' => ['description' => 'Wait until a ServiceInstance is deployed. Use this after invoking CreateService or UpdateServiceInstance', 'delay' => 5, 'maxAttempts' => 999, 'operation' => 'GetServiceInstance', 'acceptors' => [['matcher' => 'path', 'argument' => 'serviceInstance.deploymentStatus', 'state' => 'success', 'expected' => 'SUCCEEDED'], ['matcher' => 'path', 'argument' => 'serviceInstance.deploymentStatus', 'state' => 'failure', 'expected' => 'FAILED']]], 'ServicePipelineDeployed' => ['description' => 'Wait until an ServicePipeline is deployed. Use this after invoking CreateService or UpdateServicePipeline', 'delay' => 10, 'maxAttempts' => 360, 'operation' => 'GetService', 'acceptors' => [['matcher' => 'path', 'argument' => 'service.pipeline.deploymentStatus', 'state' => 'success', 'expected' => 'SUCCEEDED'], ['matcher' => 'path', 'argument' => 'service.pipeline.deploymentStatus', 'state' => 'failure', 'expected' => 'FAILED']]], 'ServiceTemplateVersionRegistered' => ['description' => 'Wait until a ServiceTemplateVersion is registered. Use this after invoking CreateServiceTemplateVersion', 'delay' => 2, 'maxAttempts' => 150, 'operation' => 'GetServiceTemplateVersion', 'acceptors' => [['matcher' => 'path', 'argument' => 'serviceTemplateVersion.status', 'state' => 'success', 'expected' => 'DRAFT'], ['matcher' => 'path', 'argument' => 'serviceTemplateVersion.status', 'state' => 'success', 'expected' => 'PUBLISHED'], ['matcher' => 'path', 'argument' => 'serviceTemplateVersion.status', 'state' => 'failure', 'expected' => 'REGISTRATION_FAILED']]], 'ServiceUpdated' => ['description' => 'Wait until a Service, its instances, and possibly pipeline have been deployed after UpdateService is invoked', 'delay' => 5, 'maxAttempts' => 999, 'operation' => 'GetService', 'acceptors' => [['matcher' => 'path', 'argument' => 'service.status', 'state' => 'success', 'expected' => 'ACTIVE'], ['matcher' => 'path', 'argument' => 'service.status', 'state' => 'failure', 'expected' => 'UPDATE_FAILED_CLEANUP_COMPLETE'], ['matcher' => 'path', 'argument' => 'service.status', 'state' => 'failure', 'expected' => 'UPDATE_FAILED_CLEANUP_FAILED'], ['matcher' => 'path', 'argument' => 'service.status', 'state' => 'failure', 'expected' => 'UPDATE_FAILED'], ['matcher' => 'path', 'argument' => 'service.status', 'state' => 'failure', 'expected' => 'UPDATE_COMPLETE_CLEANUP_FAILED']]]]];
