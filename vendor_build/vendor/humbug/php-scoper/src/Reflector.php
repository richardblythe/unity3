<?php

declare (strict_types=1);
/*
 * This file is part of the humbug/php-scoper package.
 *
 * Copyright (c) 2017 Théo FIDRY <theo.fidry@gmail.com>,
 *                    Pádraic Brady <padraic.brady@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Unity3_Vendor\Humbug\PhpScoper;

use Unity3_Vendor\JetBrains\PHPStormStub\PhpStormStubsMap;
use function array_fill_keys;
use function array_keys;
use function array_merge;
use function strtolower;
/**
 * @private
 */
final class Reflector
{
    private const MISSING_CLASSES = [
        // https://github.com/JetBrains/phpstorm-stubs/pull/594
        'Unity3_Vendor\\parallel\\Channel',
        'Unity3_Vendor\\parallel\\Channel\\Error',
        'Unity3_Vendor\\parallel\\Channel\\Error\\Closed',
        'Unity3_Vendor\\parallel\\Channel\\Error\\Existence',
        'Unity3_Vendor\\parallel\\Channel\\Error\\IllegalValue',
        'Unity3_Vendor\\parallel\\Error',
        'Unity3_Vendor\\parallel\\Events',
        'Unity3_Vendor\\parallel\\Events\\Error',
        'Unity3_Vendor\\parallel\\Events\\Error\\Existence',
        'Unity3_Vendor\\parallel\\Events\\Error\\Timeout',
        'Unity3_Vendor\\parallel\\Events\\Event',
        'Unity3_Vendor\\parallel\\Events\\Event\\Type',
        'Unity3_Vendor\\parallel\\Events\\Input',
        'Unity3_Vendor\\parallel\\Events\\Input\\Error',
        'Unity3_Vendor\\parallel\\Events\\Input\\Error\\Existence',
        'Unity3_Vendor\\parallel\\Events\\Input\\Error\\IllegalValue',
        'Unity3_Vendor\\parallel\\Future',
        'Unity3_Vendor\\parallel\\Future\\Error',
        'Unity3_Vendor\\parallel\\Future\\Error\\Cancelled',
        'Unity3_Vendor\\parallel\\Future\\Error\\Foreign',
        'Unity3_Vendor\\parallel\\Future\\Error\\Killed',
        'Unity3_Vendor\\parallel\\Runtime',
        'Unity3_Vendor\\parallel\\Runtime\\Bootstrap',
        'Unity3_Vendor\\parallel\\Runtime\\Error',
        'Unity3_Vendor\\parallel\\Runtime\\Error\\Bootstrap',
        'Unity3_Vendor\\parallel\\Runtime\\Error\\Closed',
        'Unity3_Vendor\\parallel\\Runtime\\Error\\IllegalFunction',
        'Unity3_Vendor\\parallel\\Runtime\\Error\\IllegalInstruction',
        'Unity3_Vendor\\parallel\\Runtime\\Error\\IllegalParameter',
        'Unity3_Vendor\\parallel\\Runtime\\Error\\IllegalReturn',
    ];
    private const MISSING_FUNCTIONS = [];
    private const MISSING_CONSTANTS = [
        'STDIN',
        'STDOUT',
        'STDERR',
        // Added in PHP 7.4
        'T_BAD_CHARACTER',
        'T_FN',
        'T_COALESCE_EQUAL',
        // Added in PHP 8.0
        'T_NAME_QUALIFIED',
        'T_NAME_FULLY_QUALIFIED',
        'T_NAME_RELATIVE',
        'T_MATCH',
        'T_NULLSAFE_OBJECT_OPERATOR',
        'T_ATTRIBUTE',
    ];
    private static $CLASSES;
    private static $FUNCTIONS;
    private static $CONSTANTS;
    /**
     * @param array<string,string>|null $symbols
     * @param array<string,string>      $source
     * @param string[]                  $missingSymbols
     */
    private static function initSymbolList(?array &$symbols, array $source, array $missingSymbols) : void
    {
        if (null !== $symbols) {
            return;
        }
        $symbols = array_fill_keys(array_merge(array_keys($source), $missingSymbols), \true);
    }
    public function __construct()
    {
        self::initSymbolList(self::$CLASSES, PhpStormStubsMap::CLASSES, self::MISSING_CLASSES);
        self::initSymbolList(self::$FUNCTIONS, PhpStormStubsMap::FUNCTIONS, self::MISSING_FUNCTIONS);
        self::initSymbolList(self::$CONSTANTS, PhpStormStubsMap::CONSTANTS, self::MISSING_CONSTANTS);
    }
    public function isClassInternal(string $name) : bool
    {
        return isset(self::$CLASSES[$name]);
    }
    public function isFunctionInternal(string $name) : bool
    {
        return isset(self::$FUNCTIONS[strtolower($name)]);
    }
    public function isConstantInternal(string $name) : bool
    {
        return isset(self::$CONSTANTS[$name]);
    }
}
