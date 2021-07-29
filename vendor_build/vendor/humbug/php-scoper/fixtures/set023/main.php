<?php

declare (strict_types=1);
namespace Unity3_Vendor;

use Unity3_Vendor\Symfony\Component\Finder\Finder;
use Unity3_Vendor\Symfony\Component\Finder\SplFileInfo;
require_once __DIR__ . '/vendor/autoload.php';
$finder = Finder::create()->files()->in(__DIR__)->depth(0)->sortByName();
foreach ($finder as $fileInfo) {
    /** @var SplFileInfo $fileInfo */
    echo $fileInfo->getFilename() . \PHP_EOL;
}
