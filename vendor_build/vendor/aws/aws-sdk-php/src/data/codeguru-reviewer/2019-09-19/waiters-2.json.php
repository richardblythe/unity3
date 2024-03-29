<?php

namespace Unity3_Vendor;

// This file was auto-generated from sdk-root/src/data/codeguru-reviewer/2019-09-19/waiters-2.json
return ['version' => 2, 'waiters' => ['RepositoryAssociationSucceeded' => ['description' => 'Wait until a repository association is complete.', 'operation' => 'DescribeRepositoryAssociation', 'delay' => 10, 'maxAttempts' => 20, 'acceptors' => [['state' => 'success', 'matcher' => 'path', 'argument' => 'RepositoryAssociation.State', 'expected' => 'Associated'], ['state' => 'retry', 'matcher' => 'path', 'argument' => 'RepositoryAssociation.State', 'expected' => 'Associating']]], 'CodeReviewCompleted' => ['description' => 'Wait until a code review is complete.', 'operation' => 'DescribeCodeReview', 'delay' => 10, 'maxAttempts' => 60, 'acceptors' => [['state' => 'success', 'matcher' => 'path', 'argument' => 'CodeReview.State', 'expected' => 'Completed'], ['state' => 'retry', 'matcher' => 'path', 'argument' => 'CodeReview.State', 'expected' => 'Pending']]]]];
