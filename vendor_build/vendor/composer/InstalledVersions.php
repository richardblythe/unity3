<?php

namespace Unity3_Vendor\Composer;

use Unity3_Vendor\Composer\Autoload\ClassLoader;
use Unity3_Vendor\Composer\Semver\VersionParser;
class InstalledVersions
{
    private static $installed = array('root' => array('pretty_version' => 'dev-master', 'version' => 'dev-master', 'aliases' => array(), 'reference' => 'caab9a9da6ae15ce22f2c99c557d3aed21b2b26f', 'name' => '__root__'), 'versions' => array('__root__' => array('pretty_version' => 'dev-master', 'version' => 'dev-master', 'aliases' => array(), 'reference' => 'caab9a9da6ae15ce22f2c99c557d3aed21b2b26f'), 'aws/aws-sdk-php' => array('pretty_version' => '3.186.0', 'version' => '3.186.0.0', 'aliases' => array(), 'reference' => 'e8511d38de286233bcb6a827d3344c0fc4808b75'), 'composer/package-versions-deprecated' => array('pretty_version' => '1.11.99.2', 'version' => '1.11.99.2', 'aliases' => array(), 'reference' => 'c6522afe5540d5fc46675043d3ed5a45a740b27c'), 'guzzlehttp/guzzle' => array('pretty_version' => '7.3.0', 'version' => '7.3.0.0', 'aliases' => array(), 'reference' => '7008573787b430c1c1f650e3722d9bba59967628'), 'guzzlehttp/promises' => array('pretty_version' => '1.4.1', 'version' => '1.4.1.0', 'aliases' => array(), 'reference' => '8e7d04f1f6450fef59366c399cfad4b9383aa30d'), 'guzzlehttp/psr7' => array('pretty_version' => '1.8.2', 'version' => '1.8.2.0', 'aliases' => array(), 'reference' => 'dc960a912984efb74d0a90222870c72c87f10c91'), 'humbug/php-scoper' => array('pretty_version' => '0.15.0', 'version' => '0.15.0.0', 'aliases' => array(), 'reference' => '98c92f2ec5e12756d59ce04dfad34f9fce6c19c3', 'replaced' => array(0 => '0.15.0')), 'jetbrains/phpstorm-stubs' => array('pretty_version' => 'v2020.3', 'version' => '2020.3.0.0', 'aliases' => array(), 'reference' => 'daf8849db40acded37b13231a291c7536922955b'), 'mtdowling/jmespath.php' => array('pretty_version' => '2.6.1', 'version' => '2.6.1.0', 'aliases' => array(), 'reference' => '9b87907a81b87bc76d19a7fb2d61e61486ee9edb'), 'nikic/php-parser' => array('pretty_version' => 'v4.12.0', 'version' => '4.12.0.0', 'aliases' => array(), 'reference' => '6608f01670c3cc5079e18c1dab1104e002579143'), 'ocramius/package-versions' => array('replaced' => array(0 => '1.11.99')), 'psr/container' => array('pretty_version' => '1.1.1', 'version' => '1.1.1.0', 'aliases' => array(), 'reference' => '8622567409010282b7aeebe4bb841fe98b58dcaf'), 'psr/http-client' => array('pretty_version' => '1.0.1', 'version' => '1.0.1.0', 'aliases' => array(), 'reference' => '2dfb5f6c5eff0e91e20e913f8c5452ed95b86621'), 'psr/http-client-implementation' => array('provided' => array(0 => '1.0')), 'psr/http-message' => array('pretty_version' => '1.0.1', 'version' => '1.0.1.0', 'aliases' => array(), 'reference' => 'f6561bf28d520154e4b0ec72be95418abe6d9363'), 'psr/http-message-implementation' => array('provided' => array(0 => '1.0')), 'psr/log-implementation' => array('provided' => array(0 => '1.0|2.0')), 'ralouphie/getallheaders' => array('pretty_version' => '3.0.3', 'version' => '3.0.3.0', 'aliases' => array(), 'reference' => '120b605dfeb996808c31b6477290a714d356e822'), 'symfony/console' => array('pretty_version' => 'v4.4.27', 'version' => '4.4.27.0', 'aliases' => array(), 'reference' => 'e523c86d2c727b128ce339a72733c9688e002ed3'), 'symfony/filesystem' => array('pretty_version' => 'v4.4.27', 'version' => '4.4.27.0', 'aliases' => array(), 'reference' => '517fb795794faf29086a77d99eb8f35e457837a7'), 'symfony/finder' => array('pretty_version' => 'v4.4.27', 'version' => '4.4.27.0', 'aliases' => array(), 'reference' => '42414d7ac96fc2880a783b872185789dea0d4262'), 'symfony/polyfill-ctype' => array('pretty_version' => 'v1.23.0', 'version' => '1.23.0.0', 'aliases' => array(), 'reference' => '46cd95797e9df938fdd2b03693b5fca5e64b01ce'), 'symfony/polyfill-mbstring' => array('pretty_version' => 'v1.23.0', 'version' => '1.23.0.0', 'aliases' => array(), 'reference' => '2df51500adbaebdc4c38dea4c89a2e131c45c8a1'), 'symfony/polyfill-php73' => array('pretty_version' => 'v1.23.0', 'version' => '1.23.0.0', 'aliases' => array(), 'reference' => 'fba8933c384d6476ab14fb7b8526e5287ca7e010'), 'symfony/polyfill-php80' => array('pretty_version' => 'v1.23.0', 'version' => '1.23.0.0', 'aliases' => array(), 'reference' => 'eca0bf41ed421bed1b57c4958bab16aa86b757d0'), 'symfony/service-contracts' => array('pretty_version' => 'v2.4.0', 'version' => '2.4.0.0', 'aliases' => array(), 'reference' => 'f040a30e04b57fbcc9c6cbcf4dbaa96bd318b9bb')));
    private static $canGetVendors;
    private static $installedByVendor = array();
    public static function getInstalledPackages()
    {
        $packages = array();
        foreach (self::getInstalled() as $installed) {
            $packages[] = \array_keys($installed['versions']);
        }
        if (1 === \count($packages)) {
            return $packages[0];
        }
        return \array_keys(\array_flip(\call_user_func_array('array_merge', $packages)));
    }
    public static function isInstalled($packageName)
    {
        foreach (self::getInstalled() as $installed) {
            if (isset($installed['versions'][$packageName])) {
                return \true;
            }
        }
        return \false;
    }
    public static function satisfies(VersionParser $parser, $packageName, $constraint)
    {
        $constraint = $parser->parseConstraints($constraint);
        $provided = $parser->parseConstraints(self::getVersionRanges($packageName));
        return $provided->matches($constraint);
    }
    public static function getVersionRanges($packageName)
    {
        foreach (self::getInstalled() as $installed) {
            if (!isset($installed['versions'][$packageName])) {
                continue;
            }
            $ranges = array();
            if (isset($installed['versions'][$packageName]['pretty_version'])) {
                $ranges[] = $installed['versions'][$packageName]['pretty_version'];
            }
            if (\array_key_exists('aliases', $installed['versions'][$packageName])) {
                $ranges = \array_merge($ranges, $installed['versions'][$packageName]['aliases']);
            }
            if (\array_key_exists('replaced', $installed['versions'][$packageName])) {
                $ranges = \array_merge($ranges, $installed['versions'][$packageName]['replaced']);
            }
            if (\array_key_exists('provided', $installed['versions'][$packageName])) {
                $ranges = \array_merge($ranges, $installed['versions'][$packageName]['provided']);
            }
            return \implode(' || ', $ranges);
        }
        throw new \OutOfBoundsException('Package "' . $packageName . '" is not installed');
    }
    public static function getVersion($packageName)
    {
        foreach (self::getInstalled() as $installed) {
            if (!isset($installed['versions'][$packageName])) {
                continue;
            }
            if (!isset($installed['versions'][$packageName]['version'])) {
                return null;
            }
            return $installed['versions'][$packageName]['version'];
        }
        throw new \OutOfBoundsException('Package "' . $packageName . '" is not installed');
    }
    public static function getPrettyVersion($packageName)
    {
        foreach (self::getInstalled() as $installed) {
            if (!isset($installed['versions'][$packageName])) {
                continue;
            }
            if (!isset($installed['versions'][$packageName]['pretty_version'])) {
                return null;
            }
            return $installed['versions'][$packageName]['pretty_version'];
        }
        throw new \OutOfBoundsException('Package "' . $packageName . '" is not installed');
    }
    public static function getReference($packageName)
    {
        foreach (self::getInstalled() as $installed) {
            if (!isset($installed['versions'][$packageName])) {
                continue;
            }
            if (!isset($installed['versions'][$packageName]['reference'])) {
                return null;
            }
            return $installed['versions'][$packageName]['reference'];
        }
        throw new \OutOfBoundsException('Package "' . $packageName . '" is not installed');
    }
    public static function getRootPackage()
    {
        $installed = self::getInstalled();
        return $installed[0]['root'];
    }
    public static function getRawData()
    {
        return self::$installed;
    }
    public static function reload($data)
    {
        self::$installed = $data;
        self::$installedByVendor = array();
    }
    private static function getInstalled()
    {
        if (null === self::$canGetVendors) {
            self::$canGetVendors = \method_exists('Unity3_Vendor\\Composer\\Autoload\\ClassLoader', 'getRegisteredLoaders');
        }
        $installed = array();
        if (self::$canGetVendors) {
            foreach (ClassLoader::getRegisteredLoaders() as $vendorDir => $loader) {
                if (isset(self::$installedByVendor[$vendorDir])) {
                    $installed[] = self::$installedByVendor[$vendorDir];
                } elseif (\is_file($vendorDir . '/composer/installed.php')) {
                    $installed[] = self::$installedByVendor[$vendorDir] = (require $vendorDir . '/composer/installed.php');
                }
            }
        }
        $installed[] = self::$installed;
        return $installed;
    }
}
