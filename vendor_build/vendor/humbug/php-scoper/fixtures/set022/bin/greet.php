<?php

declare (strict_types=1);
namespace Unity3_Vendor;

$autoload = __DIR__ . '/../vendor/scoper-autoload.php';
if (\false === \file_exists($autoload)) {
    $autoload = __DIR__ . '/../vendor/autoload.php';
}
require_once $autoload;
use Unity3_Vendor\Set022\DirectionaryLocator;
use Unity3_Vendor\Set022\Greeter;
use Unity3_Vendor\Set022\Dictionary;
$dir = \Phar::running(\false);
if ('' === $dir) {
    // Running outside of a PHAR
    $dir = __DIR__ . \DIRECTORY_SEPARATOR . 'bin';
}
$testDir = \dirname($dir) . '/../tests';
$dictionaries = DirectionaryLocator::locateDictionaries($testDir);
$words = \array_reduce($dictionaries, function (array $words, Dictionary $dictionary) : array {
    $words = \array_merge($words, $dictionary->provideWords());
    return $words;
}, []);
$greeter = new Greeter($words);
foreach ($greeter->greet() as $greeting) {
    echo $greeting . \PHP_EOL;
}
