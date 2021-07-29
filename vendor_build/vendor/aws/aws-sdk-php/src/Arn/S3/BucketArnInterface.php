<?php

namespace Unity3_Vendor\Aws\Arn\S3;

use Unity3_Vendor\Aws\Arn\ArnInterface;
/**
 * @internal
 */
interface BucketArnInterface extends ArnInterface
{
    public function getBucketName();
}
