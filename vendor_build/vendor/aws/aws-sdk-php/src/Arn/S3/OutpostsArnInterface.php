<?php

namespace Unity3_Vendor\Aws\Arn\S3;

use Unity3_Vendor\Aws\Arn\ArnInterface;
/**
 * @internal
 */
interface OutpostsArnInterface extends ArnInterface
{
    public function getOutpostId();
}
