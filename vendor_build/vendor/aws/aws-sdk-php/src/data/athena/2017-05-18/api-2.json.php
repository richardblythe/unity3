<?php

namespace Unity3_Vendor;

// This file was auto-generated from sdk-root/src/data/athena/2017-05-18/api-2.json
return ['version' => '2.0', 'metadata' => ['apiVersion' => '2017-05-18', 'endpointPrefix' => 'athena', 'jsonVersion' => '1.1', 'protocol' => 'json', 'serviceFullName' => 'Amazon Athena', 'serviceId' => 'Athena', 'signatureVersion' => 'v4', 'targetPrefix' => 'AmazonAthena', 'uid' => 'athena-2017-05-18'], 'operations' => ['BatchGetNamedQuery' => ['name' => 'BatchGetNamedQuery', 'http' => ['method' => 'POST', 'requestUri' => '/'], 'input' => ['shape' => 'BatchGetNamedQueryInput'], 'output' => ['shape' => 'BatchGetNamedQueryOutput'], 'errors' => [['shape' => 'InternalServerException'], ['shape' => 'InvalidRequestException']]], 'BatchGetQueryExecution' => ['name' => 'BatchGetQueryExecution', 'http' => ['method' => 'POST', 'requestUri' => '/'], 'input' => ['shape' => 'BatchGetQueryExecutionInput'], 'output' => ['shape' => 'BatchGetQueryExecutionOutput'], 'errors' => [['shape' => 'InternalServerException'], ['shape' => 'InvalidRequestException']]], 'CreateDataCatalog' => ['name' => 'CreateDataCatalog', 'http' => ['method' => 'POST', 'requestUri' => '/'], 'input' => ['shape' => 'CreateDataCatalogInput'], 'output' => ['shape' => 'CreateDataCatalogOutput'], 'errors' => [['shape' => 'InternalServerException'], ['shape' => 'InvalidRequestException']]], 'CreateNamedQuery' => ['name' => 'CreateNamedQuery', 'http' => ['method' => 'POST', 'requestUri' => '/'], 'input' => ['shape' => 'CreateNamedQueryInput'], 'output' => ['shape' => 'CreateNamedQueryOutput'], 'errors' => [['shape' => 'InternalServerException'], ['shape' => 'InvalidRequestException']], 'idempotent' => \true], 'CreatePreparedStatement' => ['name' => 'CreatePreparedStatement', 'http' => ['method' => 'POST', 'requestUri' => '/'], 'input' => ['shape' => 'CreatePreparedStatementInput'], 'output' => ['shape' => 'CreatePreparedStatementOutput'], 'errors' => [['shape' => 'InternalServerException'], ['shape' => 'InvalidRequestException']]], 'CreateWorkGroup' => ['name' => 'CreateWorkGroup', 'http' => ['method' => 'POST', 'requestUri' => '/'], 'input' => ['shape' => 'CreateWorkGroupInput'], 'output' => ['shape' => 'CreateWorkGroupOutput'], 'errors' => [['shape' => 'InternalServerException'], ['shape' => 'InvalidRequestException']]], 'DeleteDataCatalog' => ['name' => 'DeleteDataCatalog', 'http' => ['method' => 'POST', 'requestUri' => '/'], 'input' => ['shape' => 'DeleteDataCatalogInput'], 'output' => ['shape' => 'DeleteDataCatalogOutput'], 'errors' => [['shape' => 'InternalServerException'], ['shape' => 'InvalidRequestException']]], 'DeleteNamedQuery' => ['name' => 'DeleteNamedQuery', 'http' => ['method' => 'POST', 'requestUri' => '/'], 'input' => ['shape' => 'DeleteNamedQueryInput'], 'output' => ['shape' => 'DeleteNamedQueryOutput'], 'errors' => [['shape' => 'InternalServerException'], ['shape' => 'InvalidRequestException']], 'idempotent' => \true], 'DeletePreparedStatement' => ['name' => 'DeletePreparedStatement', 'http' => ['method' => 'POST', 'requestUri' => '/'], 'input' => ['shape' => 'DeletePreparedStatementInput'], 'output' => ['shape' => 'DeletePreparedStatementOutput'], 'errors' => [['shape' => 'InternalServerException'], ['shape' => 'InvalidRequestException'], ['shape' => 'ResourceNotFoundException']]], 'DeleteWorkGroup' => ['name' => 'DeleteWorkGroup', 'http' => ['method' => 'POST', 'requestUri' => '/'], 'input' => ['shape' => 'DeleteWorkGroupInput'], 'output' => ['shape' => 'DeleteWorkGroupOutput'], 'errors' => [['shape' => 'InternalServerException'], ['shape' => 'InvalidRequestException']], 'idempotent' => \true], 'GetDataCatalog' => ['name' => 'GetDataCatalog', 'http' => ['method' => 'POST', 'requestUri' => '/'], 'input' => ['shape' => 'GetDataCatalogInput'], 'output' => ['shape' => 'GetDataCatalogOutput'], 'errors' => [['shape' => 'InternalServerException'], ['shape' => 'InvalidRequestException']]], 'GetDatabase' => ['name' => 'GetDatabase', 'http' => ['method' => 'POST', 'requestUri' => '/'], 'input' => ['shape' => 'GetDatabaseInput'], 'output' => ['shape' => 'GetDatabaseOutput'], 'errors' => [['shape' => 'InternalServerException'], ['shape' => 'InvalidRequestException'], ['shape' => 'MetadataException']]], 'GetNamedQuery' => ['name' => 'GetNamedQuery', 'http' => ['method' => 'POST', 'requestUri' => '/'], 'input' => ['shape' => 'GetNamedQueryInput'], 'output' => ['shape' => 'GetNamedQueryOutput'], 'errors' => [['shape' => 'InternalServerException'], ['shape' => 'InvalidRequestException']]], 'GetPreparedStatement' => ['name' => 'GetPreparedStatement', 'http' => ['method' => 'POST', 'requestUri' => '/'], 'input' => ['shape' => 'GetPreparedStatementInput'], 'output' => ['shape' => 'GetPreparedStatementOutput'], 'errors' => [['shape' => 'InternalServerException'], ['shape' => 'InvalidRequestException'], ['shape' => 'ResourceNotFoundException']]], 'GetQueryExecution' => ['name' => 'GetQueryExecution', 'http' => ['method' => 'POST', 'requestUri' => '/'], 'input' => ['shape' => 'GetQueryExecutionInput'], 'output' => ['shape' => 'GetQueryExecutionOutput'], 'errors' => [['shape' => 'InternalServerException'], ['shape' => 'InvalidRequestException']]], 'GetQueryResults' => ['name' => 'GetQueryResults', 'http' => ['method' => 'POST', 'requestUri' => '/'], 'input' => ['shape' => 'GetQueryResultsInput'], 'output' => ['shape' => 'GetQueryResultsOutput'], 'errors' => [['shape' => 'InternalServerException'], ['shape' => 'InvalidRequestException']]], 'GetTableMetadata' => ['name' => 'GetTableMetadata', 'http' => ['method' => 'POST', 'requestUri' => '/'], 'input' => ['shape' => 'GetTableMetadataInput'], 'output' => ['shape' => 'GetTableMetadataOutput'], 'errors' => [['shape' => 'InternalServerException'], ['shape' => 'InvalidRequestException'], ['shape' => 'MetadataException']]], 'GetWorkGroup' => ['name' => 'GetWorkGroup', 'http' => ['method' => 'POST', 'requestUri' => '/'], 'input' => ['shape' => 'GetWorkGroupInput'], 'output' => ['shape' => 'GetWorkGroupOutput'], 'errors' => [['shape' => 'InternalServerException'], ['shape' => 'InvalidRequestException']]], 'ListDataCatalogs' => ['name' => 'ListDataCatalogs', 'http' => ['method' => 'POST', 'requestUri' => '/'], 'input' => ['shape' => 'ListDataCatalogsInput'], 'output' => ['shape' => 'ListDataCatalogsOutput'], 'errors' => [['shape' => 'InternalServerException'], ['shape' => 'InvalidRequestException']]], 'ListDatabases' => ['name' => 'ListDatabases', 'http' => ['method' => 'POST', 'requestUri' => '/'], 'input' => ['shape' => 'ListDatabasesInput'], 'output' => ['shape' => 'ListDatabasesOutput'], 'errors' => [['shape' => 'InternalServerException'], ['shape' => 'InvalidRequestException'], ['shape' => 'MetadataException']]], 'ListEngineVersions' => ['name' => 'ListEngineVersions', 'http' => ['method' => 'POST', 'requestUri' => '/'], 'input' => ['shape' => 'ListEngineVersionsInput'], 'output' => ['shape' => 'ListEngineVersionsOutput'], 'errors' => [['shape' => 'InternalServerException'], ['shape' => 'InvalidRequestException']]], 'ListNamedQueries' => ['name' => 'ListNamedQueries', 'http' => ['method' => 'POST', 'requestUri' => '/'], 'input' => ['shape' => 'ListNamedQueriesInput'], 'output' => ['shape' => 'ListNamedQueriesOutput'], 'errors' => [['shape' => 'InternalServerException'], ['shape' => 'InvalidRequestException']]], 'ListPreparedStatements' => ['name' => 'ListPreparedStatements', 'http' => ['method' => 'POST', 'requestUri' => '/'], 'input' => ['shape' => 'ListPreparedStatementsInput'], 'output' => ['shape' => 'ListPreparedStatementsOutput'], 'errors' => [['shape' => 'InternalServerException'], ['shape' => 'InvalidRequestException']]], 'ListQueryExecutions' => ['name' => 'ListQueryExecutions', 'http' => ['method' => 'POST', 'requestUri' => '/'], 'input' => ['shape' => 'ListQueryExecutionsInput'], 'output' => ['shape' => 'ListQueryExecutionsOutput'], 'errors' => [['shape' => 'InternalServerException'], ['shape' => 'InvalidRequestException']]], 'ListTableMetadata' => ['name' => 'ListTableMetadata', 'http' => ['method' => 'POST', 'requestUri' => '/'], 'input' => ['shape' => 'ListTableMetadataInput'], 'output' => ['shape' => 'ListTableMetadataOutput'], 'errors' => [['shape' => 'InternalServerException'], ['shape' => 'InvalidRequestException'], ['shape' => 'MetadataException']]], 'ListTagsForResource' => ['name' => 'ListTagsForResource', 'http' => ['method' => 'POST', 'requestUri' => '/'], 'input' => ['shape' => 'ListTagsForResourceInput'], 'output' => ['shape' => 'ListTagsForResourceOutput'], 'errors' => [['shape' => 'InternalServerException'], ['shape' => 'InvalidRequestException'], ['shape' => 'ResourceNotFoundException']]], 'ListWorkGroups' => ['name' => 'ListWorkGroups', 'http' => ['method' => 'POST', 'requestUri' => '/'], 'input' => ['shape' => 'ListWorkGroupsInput'], 'output' => ['shape' => 'ListWorkGroupsOutput'], 'errors' => [['shape' => 'InternalServerException'], ['shape' => 'InvalidRequestException']]], 'StartQueryExecution' => ['name' => 'StartQueryExecution', 'http' => ['method' => 'POST', 'requestUri' => '/'], 'input' => ['shape' => 'StartQueryExecutionInput'], 'output' => ['shape' => 'StartQueryExecutionOutput'], 'errors' => [['shape' => 'InternalServerException'], ['shape' => 'InvalidRequestException'], ['shape' => 'TooManyRequestsException']], 'idempotent' => \true], 'StopQueryExecution' => ['name' => 'StopQueryExecution', 'http' => ['method' => 'POST', 'requestUri' => '/'], 'input' => ['shape' => 'StopQueryExecutionInput'], 'output' => ['shape' => 'StopQueryExecutionOutput'], 'errors' => [['shape' => 'InternalServerException'], ['shape' => 'InvalidRequestException']], 'idempotent' => \true], 'TagResource' => ['name' => 'TagResource', 'http' => ['method' => 'POST', 'requestUri' => '/'], 'input' => ['shape' => 'TagResourceInput'], 'output' => ['shape' => 'TagResourceOutput'], 'errors' => [['shape' => 'InternalServerException'], ['shape' => 'InvalidRequestException'], ['shape' => 'ResourceNotFoundException']]], 'UntagResource' => ['name' => 'UntagResource', 'http' => ['method' => 'POST', 'requestUri' => '/'], 'input' => ['shape' => 'UntagResourceInput'], 'output' => ['shape' => 'UntagResourceOutput'], 'errors' => [['shape' => 'InternalServerException'], ['shape' => 'InvalidRequestException'], ['shape' => 'ResourceNotFoundException']]], 'UpdateDataCatalog' => ['name' => 'UpdateDataCatalog', 'http' => ['method' => 'POST', 'requestUri' => '/'], 'input' => ['shape' => 'UpdateDataCatalogInput'], 'output' => ['shape' => 'UpdateDataCatalogOutput'], 'errors' => [['shape' => 'InternalServerException'], ['shape' => 'InvalidRequestException']]], 'UpdatePreparedStatement' => ['name' => 'UpdatePreparedStatement', 'http' => ['method' => 'POST', 'requestUri' => '/'], 'input' => ['shape' => 'UpdatePreparedStatementInput'], 'output' => ['shape' => 'UpdatePreparedStatementOutput'], 'errors' => [['shape' => 'InternalServerException'], ['shape' => 'InvalidRequestException'], ['shape' => 'ResourceNotFoundException']]], 'UpdateWorkGroup' => ['name' => 'UpdateWorkGroup', 'http' => ['method' => 'POST', 'requestUri' => '/'], 'input' => ['shape' => 'UpdateWorkGroupInput'], 'output' => ['shape' => 'UpdateWorkGroupOutput'], 'errors' => [['shape' => 'InternalServerException'], ['shape' => 'InvalidRequestException']]]], 'shapes' => ['AmazonResourceName' => ['type' => 'string', 'max' => 1011, 'min' => 1], 'BatchGetNamedQueryInput' => ['type' => 'structure', 'required' => ['NamedQueryIds'], 'members' => ['NamedQueryIds' => ['shape' => 'NamedQueryIdList']]], 'BatchGetNamedQueryOutput' => ['type' => 'structure', 'members' => ['NamedQueries' => ['shape' => 'NamedQueryList'], 'UnprocessedNamedQueryIds' => ['shape' => 'UnprocessedNamedQueryIdList']]], 'BatchGetQueryExecutionInput' => ['type' => 'structure', 'required' => ['QueryExecutionIds'], 'members' => ['QueryExecutionIds' => ['shape' => 'QueryExecutionIdList']]], 'BatchGetQueryExecutionOutput' => ['type' => 'structure', 'members' => ['QueryExecutions' => ['shape' => 'QueryExecutionList'], 'UnprocessedQueryExecutionIds' => ['shape' => 'UnprocessedQueryExecutionIdList']]], 'Boolean' => ['type' => 'boolean'], 'BoxedBoolean' => ['type' => 'boolean'], 'BytesScannedCutoffValue' => ['type' => 'long', 'min' => 10000000], 'CatalogNameString' => ['type' => 'string', 'max' => 256, 'min' => 1, 'pattern' => '[\\u0020-\\uD7FF\\uE000-\\uFFFD\\uD800\\uDC00-\\uDBFF\\uDFFF\\t]*'], 'Column' => ['type' => 'structure', 'required' => ['Name'], 'members' => ['Name' => ['shape' => 'NameString'], 'Type' => ['shape' => 'TypeString'], 'Comment' => ['shape' => 'CommentString']]], 'ColumnInfo' => ['type' => 'structure', 'required' => ['Name', 'Type'], 'members' => ['CatalogName' => ['shape' => 'String'], 'SchemaName' => ['shape' => 'String'], 'TableName' => ['shape' => 'String'], 'Name' => ['shape' => 'String'], 'Label' => ['shape' => 'String'], 'Type' => ['shape' => 'String'], 'Precision' => ['shape' => 'Integer'], 'Scale' => ['shape' => 'Integer'], 'Nullable' => ['shape' => 'ColumnNullable'], 'CaseSensitive' => ['shape' => 'Boolean']]], 'ColumnInfoList' => ['type' => 'list', 'member' => ['shape' => 'ColumnInfo']], 'ColumnList' => ['type' => 'list', 'member' => ['shape' => 'Column']], 'ColumnNullable' => ['type' => 'string', 'enum' => ['NOT_NULL', 'NULLABLE', 'UNKNOWN']], 'CommentString' => ['type' => 'string', 'max' => 255, 'min' => 0, 'pattern' => '[\\u0020-\\uD7FF\\uE000-\\uFFFD\\uD800\\uDC00-\\uDBFF\\uDFFF\\t]*'], 'CreateDataCatalogInput' => ['type' => 'structure', 'required' => ['Name', 'Type'], 'members' => ['Name' => ['shape' => 'CatalogNameString'], 'Type' => ['shape' => 'DataCatalogType'], 'Description' => ['shape' => 'DescriptionString'], 'Parameters' => ['shape' => 'ParametersMap'], 'Tags' => ['shape' => 'TagList']]], 'CreateDataCatalogOutput' => ['type' => 'structure', 'members' => []], 'CreateNamedQueryInput' => ['type' => 'structure', 'required' => ['Name', 'Database', 'QueryString'], 'members' => ['Name' => ['shape' => 'NameString'], 'Description' => ['shape' => 'DescriptionString'], 'Database' => ['shape' => 'DatabaseString'], 'QueryString' => ['shape' => 'QueryString'], 'ClientRequestToken' => ['shape' => 'IdempotencyToken', 'idempotencyToken' => \true], 'WorkGroup' => ['shape' => 'WorkGroupName']]], 'CreateNamedQueryOutput' => ['type' => 'structure', 'members' => ['NamedQueryId' => ['shape' => 'NamedQueryId']]], 'CreatePreparedStatementInput' => ['type' => 'structure', 'required' => ['StatementName', 'WorkGroup', 'QueryStatement'], 'members' => ['StatementName' => ['shape' => 'StatementName'], 'WorkGroup' => ['shape' => 'WorkGroupName'], 'QueryStatement' => ['shape' => 'QueryString'], 'Description' => ['shape' => 'DescriptionString']]], 'CreatePreparedStatementOutput' => ['type' => 'structure', 'members' => []], 'CreateWorkGroupInput' => ['type' => 'structure', 'required' => ['Name'], 'members' => ['Name' => ['shape' => 'WorkGroupName'], 'Configuration' => ['shape' => 'WorkGroupConfiguration'], 'Description' => ['shape' => 'WorkGroupDescriptionString'], 'Tags' => ['shape' => 'TagList']]], 'CreateWorkGroupOutput' => ['type' => 'structure', 'members' => []], 'DataCatalog' => ['type' => 'structure', 'required' => ['Name', 'Type'], 'members' => ['Name' => ['shape' => 'CatalogNameString'], 'Description' => ['shape' => 'DescriptionString'], 'Type' => ['shape' => 'DataCatalogType'], 'Parameters' => ['shape' => 'ParametersMap']]], 'DataCatalogSummary' => ['type' => 'structure', 'members' => ['CatalogName' => ['shape' => 'CatalogNameString'], 'Type' => ['shape' => 'DataCatalogType']]], 'DataCatalogSummaryList' => ['type' => 'list', 'member' => ['shape' => 'DataCatalogSummary']], 'DataCatalogType' => ['type' => 'string', 'enum' => ['LAMBDA', 'GLUE', 'HIVE']], 'Database' => ['type' => 'structure', 'required' => ['Name'], 'members' => ['Name' => ['shape' => 'NameString'], 'Description' => ['shape' => 'DescriptionString'], 'Parameters' => ['shape' => 'ParametersMap']]], 'DatabaseList' => ['type' => 'list', 'member' => ['shape' => 'Database']], 'DatabaseString' => ['type' => 'string', 'max' => 255, 'min' => 1], 'Date' => ['type' => 'timestamp'], 'Datum' => ['type' => 'structure', 'members' => ['VarCharValue' => ['shape' => 'datumString']]], 'DeleteDataCatalogInput' => ['type' => 'structure', 'required' => ['Name'], 'members' => ['Name' => ['shape' => 'CatalogNameString']]], 'DeleteDataCatalogOutput' => ['type' => 'structure', 'members' => []], 'DeleteNamedQueryInput' => ['type' => 'structure', 'required' => ['NamedQueryId'], 'members' => ['NamedQueryId' => ['shape' => 'NamedQueryId', 'idempotencyToken' => \true]]], 'DeleteNamedQueryOutput' => ['type' => 'structure', 'members' => []], 'DeletePreparedStatementInput' => ['type' => 'structure', 'required' => ['StatementName', 'WorkGroup'], 'members' => ['StatementName' => ['shape' => 'StatementName'], 'WorkGroup' => ['shape' => 'WorkGroupName']]], 'DeletePreparedStatementOutput' => ['type' => 'structure', 'members' => []], 'DeleteWorkGroupInput' => ['type' => 'structure', 'required' => ['WorkGroup'], 'members' => ['WorkGroup' => ['shape' => 'WorkGroupName'], 'RecursiveDeleteOption' => ['shape' => 'BoxedBoolean']]], 'DeleteWorkGroupOutput' => ['type' => 'structure', 'members' => []], 'DescriptionString' => ['type' => 'string', 'max' => 1024, 'min' => 1], 'EncryptionConfiguration' => ['type' => 'structure', 'required' => ['EncryptionOption'], 'members' => ['EncryptionOption' => ['shape' => 'EncryptionOption'], 'KmsKey' => ['shape' => 'String']]], 'EncryptionOption' => ['type' => 'string', 'enum' => ['SSE_S3', 'SSE_KMS', 'CSE_KMS']], 'EngineVersion' => ['type' => 'structure', 'members' => ['SelectedEngineVersion' => ['shape' => 'NameString'], 'EffectiveEngineVersion' => ['shape' => 'NameString']]], 'EngineVersionsList' => ['type' => 'list', 'member' => ['shape' => 'EngineVersion'], 'max' => 10, 'min' => 0], 'ErrorCode' => ['type' => 'string', 'max' => 256, 'min' => 1], 'ErrorMessage' => ['type' => 'string'], 'ExpressionString' => ['type' => 'string', 'max' => 256, 'min' => 0], 'GetDataCatalogInput' => ['type' => 'structure', 'required' => ['Name'], 'members' => ['Name' => ['shape' => 'CatalogNameString']]], 'GetDataCatalogOutput' => ['type' => 'structure', 'members' => ['DataCatalog' => ['shape' => 'DataCatalog']]], 'GetDatabaseInput' => ['type' => 'structure', 'required' => ['CatalogName', 'DatabaseName'], 'members' => ['CatalogName' => ['shape' => 'CatalogNameString'], 'DatabaseName' => ['shape' => 'NameString']]], 'GetDatabaseOutput' => ['type' => 'structure', 'members' => ['Database' => ['shape' => 'Database']]], 'GetNamedQueryInput' => ['type' => 'structure', 'required' => ['NamedQueryId'], 'members' => ['NamedQueryId' => ['shape' => 'NamedQueryId']]], 'GetNamedQueryOutput' => ['type' => 'structure', 'members' => ['NamedQuery' => ['shape' => 'NamedQuery']]], 'GetPreparedStatementInput' => ['type' => 'structure', 'required' => ['StatementName', 'WorkGroup'], 'members' => ['StatementName' => ['shape' => 'StatementName'], 'WorkGroup' => ['shape' => 'WorkGroupName']]], 'GetPreparedStatementOutput' => ['type' => 'structure', 'members' => ['PreparedStatement' => ['shape' => 'PreparedStatement']]], 'GetQueryExecutionInput' => ['type' => 'structure', 'required' => ['QueryExecutionId'], 'members' => ['QueryExecutionId' => ['shape' => 'QueryExecutionId']]], 'GetQueryExecutionOutput' => ['type' => 'structure', 'members' => ['QueryExecution' => ['shape' => 'QueryExecution']]], 'GetQueryResultsInput' => ['type' => 'structure', 'required' => ['QueryExecutionId'], 'members' => ['QueryExecutionId' => ['shape' => 'QueryExecutionId'], 'NextToken' => ['shape' => 'Token'], 'MaxResults' => ['shape' => 'MaxQueryResults']]], 'GetQueryResultsOutput' => ['type' => 'structure', 'members' => ['UpdateCount' => ['shape' => 'Long'], 'ResultSet' => ['shape' => 'ResultSet'], 'NextToken' => ['shape' => 'Token']]], 'GetTableMetadataInput' => ['type' => 'structure', 'required' => ['CatalogName', 'DatabaseName', 'TableName'], 'members' => ['CatalogName' => ['shape' => 'CatalogNameString'], 'DatabaseName' => ['shape' => 'NameString'], 'TableName' => ['shape' => 'NameString']]], 'GetTableMetadataOutput' => ['type' => 'structure', 'members' => ['TableMetadata' => ['shape' => 'TableMetadata']]], 'GetWorkGroupInput' => ['type' => 'structure', 'required' => ['WorkGroup'], 'members' => ['WorkGroup' => ['shape' => 'WorkGroupName']]], 'GetWorkGroupOutput' => ['type' => 'structure', 'members' => ['WorkGroup' => ['shape' => 'WorkGroup']]], 'IdempotencyToken' => ['type' => 'string', 'max' => 128, 'min' => 32], 'Integer' => ['type' => 'integer'], 'InternalServerException' => ['type' => 'structure', 'members' => ['Message' => ['shape' => 'ErrorMessage']], 'exception' => \true, 'fault' => \true], 'InvalidRequestException' => ['type' => 'structure', 'members' => ['AthenaErrorCode' => ['shape' => 'ErrorCode'], 'Message' => ['shape' => 'ErrorMessage']], 'exception' => \true], 'KeyString' => ['type' => 'string', 'max' => 255, 'min' => 1, 'pattern' => '[\\u0020-\\uD7FF\\uE000-\\uFFFD\\uD800\\uDC00-\\uDBFF\\uDFFF\\t]*'], 'ListDataCatalogsInput' => ['type' => 'structure', 'members' => ['NextToken' => ['shape' => 'Token'], 'MaxResults' => ['shape' => 'MaxDataCatalogsCount']]], 'ListDataCatalogsOutput' => ['type' => 'structure', 'members' => ['DataCatalogsSummary' => ['shape' => 'DataCatalogSummaryList'], 'NextToken' => ['shape' => 'Token']]], 'ListDatabasesInput' => ['type' => 'structure', 'required' => ['CatalogName'], 'members' => ['CatalogName' => ['shape' => 'CatalogNameString'], 'NextToken' => ['shape' => 'Token'], 'MaxResults' => ['shape' => 'MaxDatabasesCount']]], 'ListDatabasesOutput' => ['type' => 'structure', 'members' => ['DatabaseList' => ['shape' => 'DatabaseList'], 'NextToken' => ['shape' => 'Token']]], 'ListEngineVersionsInput' => ['type' => 'structure', 'members' => ['NextToken' => ['shape' => 'Token'], 'MaxResults' => ['shape' => 'MaxEngineVersionsCount']]], 'ListEngineVersionsOutput' => ['type' => 'structure', 'members' => ['EngineVersions' => ['shape' => 'EngineVersionsList'], 'NextToken' => ['shape' => 'Token']]], 'ListNamedQueriesInput' => ['type' => 'structure', 'members' => ['NextToken' => ['shape' => 'Token'], 'MaxResults' => ['shape' => 'MaxNamedQueriesCount'], 'WorkGroup' => ['shape' => 'WorkGroupName']]], 'ListNamedQueriesOutput' => ['type' => 'structure', 'members' => ['NamedQueryIds' => ['shape' => 'NamedQueryIdList'], 'NextToken' => ['shape' => 'Token']]], 'ListPreparedStatementsInput' => ['type' => 'structure', 'required' => ['WorkGroup'], 'members' => ['WorkGroup' => ['shape' => 'WorkGroupName'], 'NextToken' => ['shape' => 'Token'], 'MaxResults' => ['shape' => 'MaxPreparedStatementsCount']]], 'ListPreparedStatementsOutput' => ['type' => 'structure', 'members' => ['PreparedStatements' => ['shape' => 'PreparedStatementsList'], 'NextToken' => ['shape' => 'Token']]], 'ListQueryExecutionsInput' => ['type' => 'structure', 'members' => ['NextToken' => ['shape' => 'Token'], 'MaxResults' => ['shape' => 'MaxQueryExecutionsCount'], 'WorkGroup' => ['shape' => 'WorkGroupName']]], 'ListQueryExecutionsOutput' => ['type' => 'structure', 'members' => ['QueryExecutionIds' => ['shape' => 'QueryExecutionIdList'], 'NextToken' => ['shape' => 'Token']]], 'ListTableMetadataInput' => ['type' => 'structure', 'required' => ['CatalogName', 'DatabaseName'], 'members' => ['CatalogName' => ['shape' => 'CatalogNameString'], 'DatabaseName' => ['shape' => 'NameString'], 'Expression' => ['shape' => 'ExpressionString'], 'NextToken' => ['shape' => 'Token'], 'MaxResults' => ['shape' => 'MaxTableMetadataCount']]], 'ListTableMetadataOutput' => ['type' => 'structure', 'members' => ['TableMetadataList' => ['shape' => 'TableMetadataList'], 'NextToken' => ['shape' => 'Token']]], 'ListTagsForResourceInput' => ['type' => 'structure', 'required' => ['ResourceARN'], 'members' => ['ResourceARN' => ['shape' => 'AmazonResourceName'], 'NextToken' => ['shape' => 'Token'], 'MaxResults' => ['shape' => 'MaxTagsCount']]], 'ListTagsForResourceOutput' => ['type' => 'structure', 'members' => ['Tags' => ['shape' => 'TagList'], 'NextToken' => ['shape' => 'Token']]], 'ListWorkGroupsInput' => ['type' => 'structure', 'members' => ['NextToken' => ['shape' => 'Token'], 'MaxResults' => ['shape' => 'MaxWorkGroupsCount']]], 'ListWorkGroupsOutput' => ['type' => 'structure', 'members' => ['WorkGroups' => ['shape' => 'WorkGroupsList'], 'NextToken' => ['shape' => 'Token']]], 'Long' => ['type' => 'long'], 'MaxDataCatalogsCount' => ['type' => 'integer', 'box' => \true, 'max' => 50, 'min' => 2], 'MaxDatabasesCount' => ['type' => 'integer', 'box' => \true, 'max' => 50, 'min' => 1], 'MaxEngineVersionsCount' => ['type' => 'integer', 'box' => \true, 'max' => 10, 'min' => 1], 'MaxNamedQueriesCount' => ['type' => 'integer', 'box' => \true, 'max' => 50, 'min' => 0], 'MaxPreparedStatementsCount' => ['type' => 'integer', 'box' => \true, 'max' => 50, 'min' => 1], 'MaxQueryExecutionsCount' => ['type' => 'integer', 'box' => \true, 'max' => 50, 'min' => 0], 'MaxQueryResults' => ['type' => 'integer', 'box' => \true, 'max' => 1000, 'min' => 1], 'MaxTableMetadataCount' => ['type' => 'integer', 'box' => \true, 'max' => 50, 'min' => 1], 'MaxTagsCount' => ['type' => 'integer', 'box' => \true, 'min' => 75], 'MaxWorkGroupsCount' => ['type' => 'integer', 'box' => \true, 'max' => 50, 'min' => 1], 'MetadataException' => ['type' => 'structure', 'members' => ['Message' => ['shape' => 'ErrorMessage']], 'exception' => \true], 'NameString' => ['type' => 'string', 'max' => 128, 'min' => 1], 'NamedQuery' => ['type' => 'structure', 'required' => ['Name', 'Database', 'QueryString'], 'members' => ['Name' => ['shape' => 'NameString'], 'Description' => ['shape' => 'DescriptionString'], 'Database' => ['shape' => 'DatabaseString'], 'QueryString' => ['shape' => 'QueryString'], 'NamedQueryId' => ['shape' => 'NamedQueryId'], 'WorkGroup' => ['shape' => 'WorkGroupName']]], 'NamedQueryId' => ['type' => 'string'], 'NamedQueryIdList' => ['type' => 'list', 'member' => ['shape' => 'NamedQueryId'], 'max' => 50, 'min' => 1], 'NamedQueryList' => ['type' => 'list', 'member' => ['shape' => 'NamedQuery']], 'ParametersMap' => ['type' => 'map', 'key' => ['shape' => 'KeyString'], 'value' => ['shape' => 'ParametersMapValue']], 'ParametersMapValue' => ['type' => 'string', 'max' => 51200], 'PreparedStatement' => ['type' => 'structure', 'members' => ['StatementName' => ['shape' => 'StatementName'], 'QueryStatement' => ['shape' => 'QueryString'], 'WorkGroupName' => ['shape' => 'WorkGroupName'], 'Description' => ['shape' => 'DescriptionString'], 'LastModifiedTime' => ['shape' => 'Date']]], 'PreparedStatementSummary' => ['type' => 'structure', 'members' => ['StatementName' => ['shape' => 'StatementName'], 'LastModifiedTime' => ['shape' => 'Date']]], 'PreparedStatementsList' => ['type' => 'list', 'member' => ['shape' => 'PreparedStatementSummary'], 'max' => 50, 'min' => 0], 'QueryExecution' => ['type' => 'structure', 'members' => ['QueryExecutionId' => ['shape' => 'QueryExecutionId'], 'Query' => ['shape' => 'QueryString'], 'StatementType' => ['shape' => 'StatementType'], 'ResultConfiguration' => ['shape' => 'ResultConfiguration'], 'QueryExecutionContext' => ['shape' => 'QueryExecutionContext'], 'Status' => ['shape' => 'QueryExecutionStatus'], 'Statistics' => ['shape' => 'QueryExecutionStatistics'], 'WorkGroup' => ['shape' => 'WorkGroupName'], 'EngineVersion' => ['shape' => 'EngineVersion']]], 'QueryExecutionContext' => ['type' => 'structure', 'members' => ['Database' => ['shape' => 'DatabaseString'], 'Catalog' => ['shape' => 'CatalogNameString']]], 'QueryExecutionId' => ['type' => 'string'], 'QueryExecutionIdList' => ['type' => 'list', 'member' => ['shape' => 'QueryExecutionId'], 'max' => 50, 'min' => 1], 'QueryExecutionList' => ['type' => 'list', 'member' => ['shape' => 'QueryExecution']], 'QueryExecutionState' => ['type' => 'string', 'enum' => ['QUEUED', 'RUNNING', 'SUCCEEDED', 'FAILED', 'CANCELLED']], 'QueryExecutionStatistics' => ['type' => 'structure', 'members' => ['EngineExecutionTimeInMillis' => ['shape' => 'Long'], 'DataScannedInBytes' => ['shape' => 'Long'], 'DataManifestLocation' => ['shape' => 'String'], 'TotalExecutionTimeInMillis' => ['shape' => 'Long'], 'QueryQueueTimeInMillis' => ['shape' => 'Long'], 'QueryPlanningTimeInMillis' => ['shape' => 'Long'], 'ServiceProcessingTimeInMillis' => ['shape' => 'Long']]], 'QueryExecutionStatus' => ['type' => 'structure', 'members' => ['State' => ['shape' => 'QueryExecutionState'], 'StateChangeReason' => ['shape' => 'String'], 'SubmissionDateTime' => ['shape' => 'Date'], 'CompletionDateTime' => ['shape' => 'Date']]], 'QueryString' => ['type' => 'string', 'max' => 262144, 'min' => 1], 'ResourceNotFoundException' => ['type' => 'structure', 'members' => ['Message' => ['shape' => 'ErrorMessage'], 'ResourceName' => ['shape' => 'AmazonResourceName']], 'exception' => \true], 'ResultConfiguration' => ['type' => 'structure', 'members' => ['OutputLocation' => ['shape' => 'String'], 'EncryptionConfiguration' => ['shape' => 'EncryptionConfiguration']]], 'ResultConfigurationUpdates' => ['type' => 'structure', 'members' => ['OutputLocation' => ['shape' => 'String'], 'RemoveOutputLocation' => ['shape' => 'BoxedBoolean'], 'EncryptionConfiguration' => ['shape' => 'EncryptionConfiguration'], 'RemoveEncryptionConfiguration' => ['shape' => 'BoxedBoolean']]], 'ResultSet' => ['type' => 'structure', 'members' => ['Rows' => ['shape' => 'RowList'], 'ResultSetMetadata' => ['shape' => 'ResultSetMetadata']]], 'ResultSetMetadata' => ['type' => 'structure', 'members' => ['ColumnInfo' => ['shape' => 'ColumnInfoList']]], 'Row' => ['type' => 'structure', 'members' => ['Data' => ['shape' => 'datumList']]], 'RowList' => ['type' => 'list', 'member' => ['shape' => 'Row']], 'StartQueryExecutionInput' => ['type' => 'structure', 'required' => ['QueryString'], 'members' => ['QueryString' => ['shape' => 'QueryString'], 'ClientRequestToken' => ['shape' => 'IdempotencyToken', 'idempotencyToken' => \true], 'QueryExecutionContext' => ['shape' => 'QueryExecutionContext'], 'ResultConfiguration' => ['shape' => 'ResultConfiguration'], 'WorkGroup' => ['shape' => 'WorkGroupName']]], 'StartQueryExecutionOutput' => ['type' => 'structure', 'members' => ['QueryExecutionId' => ['shape' => 'QueryExecutionId']]], 'StatementName' => ['type' => 'string', 'max' => 256, 'min' => 1, 'pattern' => '[a-zA-Z_][a-zA-Z0-9_@:]{1,256}'], 'StatementType' => ['type' => 'string', 'enum' => ['DDL', 'DML', 'UTILITY']], 'StopQueryExecutionInput' => ['type' => 'structure', 'required' => ['QueryExecutionId'], 'members' => ['QueryExecutionId' => ['shape' => 'QueryExecutionId', 'idempotencyToken' => \true]]], 'StopQueryExecutionOutput' => ['type' => 'structure', 'members' => []], 'String' => ['type' => 'string'], 'TableMetadata' => ['type' => 'structure', 'required' => ['Name'], 'members' => ['Name' => ['shape' => 'NameString'], 'CreateTime' => ['shape' => 'Timestamp'], 'LastAccessTime' => ['shape' => 'Timestamp'], 'TableType' => ['shape' => 'TableTypeString'], 'Columns' => ['shape' => 'ColumnList'], 'PartitionKeys' => ['shape' => 'ColumnList'], 'Parameters' => ['shape' => 'ParametersMap']]], 'TableMetadataList' => ['type' => 'list', 'member' => ['shape' => 'TableMetadata']], 'TableTypeString' => ['type' => 'string', 'max' => 255], 'Tag' => ['type' => 'structure', 'members' => ['Key' => ['shape' => 'TagKey'], 'Value' => ['shape' => 'TagValue']]], 'TagKey' => ['type' => 'string', 'max' => 128, 'min' => 1], 'TagKeyList' => ['type' => 'list', 'member' => ['shape' => 'TagKey']], 'TagList' => ['type' => 'list', 'member' => ['shape' => 'Tag']], 'TagResourceInput' => ['type' => 'structure', 'required' => ['ResourceARN', 'Tags'], 'members' => ['ResourceARN' => ['shape' => 'AmazonResourceName'], 'Tags' => ['shape' => 'TagList']]], 'TagResourceOutput' => ['type' => 'structure', 'members' => []], 'TagValue' => ['type' => 'string', 'max' => 256, 'min' => 0], 'ThrottleReason' => ['type' => 'string', 'enum' => ['CONCURRENT_QUERY_LIMIT_EXCEEDED']], 'Timestamp' => ['type' => 'timestamp'], 'Token' => ['type' => 'string', 'max' => 1024, 'min' => 1], 'TooManyRequestsException' => ['type' => 'structure', 'members' => ['Message' => ['shape' => 'ErrorMessage'], 'Reason' => ['shape' => 'ThrottleReason']], 'exception' => \true], 'TypeString' => ['type' => 'string', 'max' => 4096, 'min' => 0, 'pattern' => '[\\u0020-\\uD7FF\\uE000-\\uFFFD\\uD800\\uDC00-\\uDBFF\\uDFFF\\t]*'], 'UnprocessedNamedQueryId' => ['type' => 'structure', 'members' => ['NamedQueryId' => ['shape' => 'NamedQueryId'], 'ErrorCode' => ['shape' => 'ErrorCode'], 'ErrorMessage' => ['shape' => 'ErrorMessage']]], 'UnprocessedNamedQueryIdList' => ['type' => 'list', 'member' => ['shape' => 'UnprocessedNamedQueryId']], 'UnprocessedQueryExecutionId' => ['type' => 'structure', 'members' => ['QueryExecutionId' => ['shape' => 'QueryExecutionId'], 'ErrorCode' => ['shape' => 'ErrorCode'], 'ErrorMessage' => ['shape' => 'ErrorMessage']]], 'UnprocessedQueryExecutionIdList' => ['type' => 'list', 'member' => ['shape' => 'UnprocessedQueryExecutionId']], 'UntagResourceInput' => ['type' => 'structure', 'required' => ['ResourceARN', 'TagKeys'], 'members' => ['ResourceARN' => ['shape' => 'AmazonResourceName'], 'TagKeys' => ['shape' => 'TagKeyList']]], 'UntagResourceOutput' => ['type' => 'structure', 'members' => []], 'UpdateDataCatalogInput' => ['type' => 'structure', 'required' => ['Name', 'Type'], 'members' => ['Name' => ['shape' => 'CatalogNameString'], 'Type' => ['shape' => 'DataCatalogType'], 'Description' => ['shape' => 'DescriptionString'], 'Parameters' => ['shape' => 'ParametersMap']]], 'UpdateDataCatalogOutput' => ['type' => 'structure', 'members' => []], 'UpdatePreparedStatementInput' => ['type' => 'structure', 'required' => ['StatementName', 'WorkGroup', 'QueryStatement'], 'members' => ['StatementName' => ['shape' => 'StatementName'], 'WorkGroup' => ['shape' => 'WorkGroupName'], 'QueryStatement' => ['shape' => 'QueryString'], 'Description' => ['shape' => 'DescriptionString']]], 'UpdatePreparedStatementOutput' => ['type' => 'structure', 'members' => []], 'UpdateWorkGroupInput' => ['type' => 'structure', 'required' => ['WorkGroup'], 'members' => ['WorkGroup' => ['shape' => 'WorkGroupName'], 'Description' => ['shape' => 'WorkGroupDescriptionString'], 'ConfigurationUpdates' => ['shape' => 'WorkGroupConfigurationUpdates'], 'State' => ['shape' => 'WorkGroupState']]], 'UpdateWorkGroupOutput' => ['type' => 'structure', 'members' => []], 'WorkGroup' => ['type' => 'structure', 'required' => ['Name'], 'members' => ['Name' => ['shape' => 'WorkGroupName'], 'State' => ['shape' => 'WorkGroupState'], 'Configuration' => ['shape' => 'WorkGroupConfiguration'], 'Description' => ['shape' => 'WorkGroupDescriptionString'], 'CreationTime' => ['shape' => 'Date']]], 'WorkGroupConfiguration' => ['type' => 'structure', 'members' => ['ResultConfiguration' => ['shape' => 'ResultConfiguration'], 'EnforceWorkGroupConfiguration' => ['shape' => 'BoxedBoolean'], 'PublishCloudWatchMetricsEnabled' => ['shape' => 'BoxedBoolean'], 'BytesScannedCutoffPerQuery' => ['shape' => 'BytesScannedCutoffValue'], 'RequesterPaysEnabled' => ['shape' => 'BoxedBoolean'], 'EngineVersion' => ['shape' => 'EngineVersion']]], 'WorkGroupConfigurationUpdates' => ['type' => 'structure', 'members' => ['EnforceWorkGroupConfiguration' => ['shape' => 'BoxedBoolean'], 'ResultConfigurationUpdates' => ['shape' => 'ResultConfigurationUpdates'], 'PublishCloudWatchMetricsEnabled' => ['shape' => 'BoxedBoolean'], 'BytesScannedCutoffPerQuery' => ['shape' => 'BytesScannedCutoffValue'], 'RemoveBytesScannedCutoffPerQuery' => ['shape' => 'BoxedBoolean'], 'RequesterPaysEnabled' => ['shape' => 'BoxedBoolean'], 'EngineVersion' => ['shape' => 'EngineVersion']]], 'WorkGroupDescriptionString' => ['type' => 'string', 'max' => 1024, 'min' => 0], 'WorkGroupName' => ['type' => 'string', 'pattern' => '[a-zA-Z0-9._-]{1,128}'], 'WorkGroupState' => ['type' => 'string', 'enum' => ['ENABLED', 'DISABLED']], 'WorkGroupSummary' => ['type' => 'structure', 'members' => ['Name' => ['shape' => 'WorkGroupName'], 'State' => ['shape' => 'WorkGroupState'], 'Description' => ['shape' => 'WorkGroupDescriptionString'], 'CreationTime' => ['shape' => 'Date'], 'EngineVersion' => ['shape' => 'EngineVersion']]], 'WorkGroupsList' => ['type' => 'list', 'member' => ['shape' => 'WorkGroupSummary'], 'max' => 50, 'min' => 0], 'datumList' => ['type' => 'list', 'member' => ['shape' => 'Datum']], 'datumString' => ['type' => 'string']]];
