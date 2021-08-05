<?php

/*
 *          Step 1: Paste code below in terminal window
 *          php ./vendor/humbug/php-scoper/bin/php-scoper add-prefix --output-dir=./vendor_build
 *
 *          Step 2: After above has finished, paste code below in terminal window
 *          composer dump-autoload
 */

declare(strict_types=1);

use Isolated\Symfony\Component\Finder\Finder;

function getDirContents($dir, &$results = array()) {
    $files = scandir($dir);

    foreach ($files as $key => $value) {
        $path = realpath($dir . DIRECTORY_SEPARATOR . $value);
        if (!is_dir($path)) {
            $results[] = $path;
        } else if ($value != "." && $value != "..") {
            getDirContents($path, $results);
            $results[] = $path;
        }
    }

    return $results;
}

$white_listed = array();
getDirContents(dirname(__FILE__) .'/vendor/acf-image-select/', $white_listed);

return [
    // The prefix configuration. If a non null value will be used, a random prefix will be generated.
    'prefix' => 'Unity3_Vendor',
//
//    'exclude-constants' => [''], //vendor\aws\aws-sdk-php\src\Signature\SignatureV4.php

    // By default when running php-scoper add-prefix, it will prefix all relevant code found in the current working
    // directory. You can however define which files should be scoped by defining a collection of Finders in the
    // following configuration key.
    //
    // For more see: https://github.com/humbug/php-scoper#finders-and-paths
    'finders' => [
        Finder::create()
            ->files()
            ->ignoreVCS(true)
            ->notName('/LICENSE|.*\\.md|.*\\.dist|Makefile|composer\\.json|composer\\.lock'.

                '|gulpfile\\.babel\\.js|index\\.php|scoper\\.inc\\.php|unity3\\.php'

                .'/')
            ->exclude([
                'doc',
                'test',
                'test_old',
                'tests',
                'Tests',
                'vendor-bin',

                'assets',
                'includes',
            ])
            ->in('vendor' ),
        Finder::create()->append([
            'composer.json',
        ]),
    ],

    'files-whitelist' => $white_listed,
    // When scoping PHP files, there will be scenarios where some of the code being scoped indirectly references the
    // original namespace. These will include, for example, strings or string manipulations. PHP-Scoper has limited
    // support for prefixing such strings. To circumvent that, you can define patchers to manipulate the file to your
    // heart contents.
    //
    // For more see: https://github.com/humbug/php-scoper#patchers
    'patchers' => [
        function ($filePath, $prefix,  $content) {
            //
            // PHP-Parser patch conditions for file targets
            //

            if ( strpos( $filePath, 'aws\aws-sdk-php\src\functions.php' ) ) {

                return preg_replace(
                    "%GuzzleHttp\\\\\\\\ClientInterface%",
                    $prefix . '\\\\\\\\GuzzleHttp\\\\\\ClientInterface',
                    $content
                );

            } elseif ( strpos( $filePath, 'aws\aws-sdk-php\src\Signature\SignatureV4.php' ) ) {
                return preg_replace(
                    "%Unity3_Vendor\\\\\\\\Ymd\\\\\\\\THis\\\\\\\\Z%",
                    'Ymd\\\\THis\\\\Z',
                    $content
                );
            } elseif ( strpos( $filePath, 'composer\autoload_real.php' ) ) {
                //          'Composer\\Autoload\\ClassLoader' === $class
                return preg_replace(
                    '%\'Composer\\\\\\\\Autoload\\\\\\\\ClassLoader\' === \$class%',
                    "'" . $prefix . "\\\\\\\\Composer\\\\\\\\Autoload\\\\\\\\ClassLoader' === \$class",
                    $content
                );
            } elseif ( strpos( $filePath, 'composer\ClassLoader.php' ) ) {

                return str_replace('$logicalPathPsr4 = \strtr($class',
                    "\$class = \str_replace('Unity3_Vendor\\\\', '', \$class );\n\n\$logicalPathPsr4 = strtr(\$class", $content);

            } elseif ( strpos( $filePath, 'composer\autoload_static.php' ) ) {
                //php ./vendor/humbug/php-scoper/bin/php-scoper add-prefix --output-dir=./vendor_build

                return preg_replace_callback(
                    '/(.*files = array.*)([(].*[)])/misU',
                    function ( $match ){
                       return $match[1] . str_replace("' =>", "_Unity3_Vendor' =>", $match[2]);
                       },
                    $content
                );
            } elseif ( strpos( $filePath, 'composer\autoload_files.php' ) ) {
                //php ./vendor/humbug/php-scoper/bin/php-scoper add-prefix --output-dir=./vendor_build

                return str_replace("' =>", "_{$prefix}' =>", $content);
            }
            return $content;
        },
    ],

    // PHP-Scoper's goal is to make sure that all code for a project lies in a distinct PHP namespace. However, you
    // may want to share a common API between the bundled code of your PHAR and the consumer code. For example if
    // you have a PHPUnit PHAR with isolated code, you still want the PHAR to be able to understand the
    // PHPUnit\Framework\TestCase class.
    //
    // A way to achieve this is by specifying a list of classes to not prefix with the following configuration key. Note
    // that this does not work with functions or constants neither with classes belonging to the global namespace.
    //
    // Fore more see https://github.com/humbug/php-scoper#whitelist
    'whitelist' => [
        // 'PHPUnit\Framework\TestCase',   // A specific class
        // 'PHPUnit\Framework\*',          // The whole namespace
        // '*',                            // Everything

        //This doesn't seem to be working right now, but a patcher function resolves the issue
        'ISO8601_BASIC', //vendor/aws/aws-sdk-php/src/Signature/SignatureV4.php
    ],

    // If `true` then the user defined constants belonging to the global namespace will not be prefixed.
    //
    // For more see https://github.com/humbug/php-scoper#constants--constants--functions-from-the-global-namespace
    'whitelist-global-constants' => true,

    // If `true` then the user defined classes belonging to the global namespace will not be prefixed.
    //
    // For more see https://github.com/humbug/php-scoper#constants--constants--functions-from-the-global-namespace
    'whitelist-global-classes' => true,

    // If `true` then the user defined functions belonging to the global namespace will not be prefixed.
    //
    // For more see https://github.com/humbug/php-scoper#constants--constants--functions-from-the-global-namespace
    'whitelist-global-functions' => true,


];
