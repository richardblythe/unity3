<?php

// autoload_static.php @generated by Composer
namespace Unity3_Vendor\Composer\Autoload;

class ComposerStaticInit7538c5330aca6bb340ef652a14c520d5
{
    public static $files = array('a4a119a56e50fbb293281d9a48007e0e' => __DIR__ . '/..' . '/symfony/polyfill-php80/bootstrap.php', '7b11c4dc42b3b3023073cb14e519683c' => __DIR__ . '/..' . '/ralouphie/getallheaders/src/getallheaders.php', '0e6d7bf4a5811bfa5cf40c5ccd6fae6a' => __DIR__ . '/..' . '/symfony/polyfill-mbstring/bootstrap.php', 'c964ee0ededf28c96ebd9db5099ef910' => __DIR__ . '/..' . '/guzzlehttp/promises/src/functions_include.php', 'a0edc8309cc5e1d60e3047b5df6b7052' => __DIR__ . '/..' . '/guzzlehttp/psr7/src/functions_include.php', '320cde22f66dd4f5d3fd621d3e88b98f' => __DIR__ . '/..' . '/symfony/polyfill-ctype/bootstrap.php', '0d59ee240a4cd96ddbb4ff164fccea4d' => __DIR__ . '/..' . '/symfony/polyfill-php73/bootstrap.php', '37a3dc5111fe8f707ab4c132ef1dbc62' => __DIR__ . '/..' . '/guzzlehttp/guzzle/src/functions_include.php', 'fe1d4898277c26748a003292f432cd3b' => __DIR__ . '/..' . '/jetbrains/phpstorm-stubs/PhpStormStubsMap.php', 'b067bc7112e384b61c701452d53a14a8' => __DIR__ . '/..' . '/mtdowling/jmespath.php/src/JmesPath.php', '8a9dc1de0ca7e01f3e08231539562f61' => __DIR__ . '/..' . '/aws/aws-sdk-php/src/functions.php', '107bb9f2fcf71c39f243ed29e9ceb506' => __DIR__ . '/..' . '/humbug/php-scoper/src/functions.php', '0d8b55c902603f8c22bf1ed149beb7a8' => __DIR__ . '/..' . '/humbug/php-scoper/src/json.php');
    public static $prefixLengthsPsr4 = array('S' => array('Symfony\\Polyfill\\Php80\\' => 23, 'Symfony\\Polyfill\\Php73\\' => 23, 'Symfony\\Polyfill\\Mbstring\\' => 26, 'Symfony\\Polyfill\\Ctype\\' => 23, 'Symfony\\Contracts\\Service\\' => 26, 'Symfony\\Component\\Finder\\' => 25, 'Symfony\\Component\\Filesystem\\' => 29, 'Symfony\\Component\\Console\\' => 26), 'P' => array('Psr\\Http\\Message\\' => 17, 'Psr\\Http\\Client\\' => 16, 'Psr\\Container\\' => 14, 'PhpParser\\' => 10, 'PackageVersions\\' => 16), 'J' => array('JmesPath\\' => 9), 'H' => array('Humbug\\PhpScoper\\' => 17), 'G' => array('GuzzleHttp\\Psr7\\' => 16, 'GuzzleHttp\\Promise\\' => 19, 'GuzzleHttp\\' => 11), 'A' => array('Aws\\' => 4));
    public static $prefixDirsPsr4 = array('Symfony\\Polyfill\\Php80\\' => array(0 => __DIR__ . '/..' . '/symfony/polyfill-php80'), 'Symfony\\Polyfill\\Php73\\' => array(0 => __DIR__ . '/..' . '/symfony/polyfill-php73'), 'Symfony\\Polyfill\\Mbstring\\' => array(0 => __DIR__ . '/..' . '/symfony/polyfill-mbstring'), 'Symfony\\Polyfill\\Ctype\\' => array(0 => __DIR__ . '/..' . '/symfony/polyfill-ctype'), 'Symfony\\Contracts\\Service\\' => array(0 => __DIR__ . '/..' . '/symfony/service-contracts'), 'Symfony\\Component\\Finder\\' => array(0 => __DIR__ . '/..' . '/symfony/finder'), 'Symfony\\Component\\Filesystem\\' => array(0 => __DIR__ . '/..' . '/symfony/filesystem'), 'Symfony\\Component\\Console\\' => array(0 => __DIR__ . '/..' . '/symfony/console'), 'Psr\\Http\\Message\\' => array(0 => __DIR__ . '/..' . '/psr/http-message/src'), 'Psr\\Http\\Client\\' => array(0 => __DIR__ . '/..' . '/psr/http-client/src'), 'Psr\\Container\\' => array(0 => __DIR__ . '/..' . '/psr/container/src'), 'PhpParser\\' => array(0 => __DIR__ . '/..' . '/nikic/php-parser/lib/PhpParser'), 'PackageVersions\\' => array(0 => __DIR__ . '/..' . '/composer/package-versions-deprecated/src/PackageVersions'), 'JmesPath\\' => array(0 => __DIR__ . '/..' . '/mtdowling/jmespath.php/src'), 'Humbug\\PhpScoper\\' => array(0 => __DIR__ . '/..' . '/humbug/php-scoper/src'), 'GuzzleHttp\\Psr7\\' => array(0 => __DIR__ . '/..' . '/guzzlehttp/psr7/src'), 'GuzzleHttp\\Promise\\' => array(0 => __DIR__ . '/..' . '/guzzlehttp/promises/src'), 'GuzzleHttp\\' => array(0 => __DIR__ . '/..' . '/guzzlehttp/guzzle/src'), 'Aws\\' => array(0 => __DIR__ . '/..' . '/aws/aws-sdk-php/src'));
    public static $classMap = array('Attribute' => __DIR__ . '/..' . '/symfony/polyfill-php80/Resources/stubs/Attribute.php', 'Unity3_Vendor\\Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php', 'JsonException' => __DIR__ . '/..' . '/symfony/polyfill-php73/Resources/stubs/JsonException.php', 'Stringable' => __DIR__ . '/..' . '/symfony/polyfill-php80/Resources/stubs/Stringable.php', 'UnhandledMatchError' => __DIR__ . '/..' . '/symfony/polyfill-php80/Resources/stubs/UnhandledMatchError.php', 'ValueError' => __DIR__ . '/..' . '/symfony/polyfill-php80/Resources/stubs/ValueError.php');
    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit7538c5330aca6bb340ef652a14c520d5::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit7538c5330aca6bb340ef652a14c520d5::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit7538c5330aca6bb340ef652a14c520d5::$classMap;
        }, null, ClassLoader::class);
    }
}
