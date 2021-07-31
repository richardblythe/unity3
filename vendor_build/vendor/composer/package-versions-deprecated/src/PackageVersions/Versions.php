<?php

declare (strict_types=1);
namespace Unity3_Vendor\PackageVersions;

use Unity3_Vendor\Composer\InstalledVersions;
use OutOfBoundsException;
\class_exists(InstalledVersions::class);
/**
 * This class is generated by composer/package-versions-deprecated, specifically by
 * @see \PackageVersions\Installer
 *
 * This file is overwritten at every run of `composer install` or `composer update`.
 *
 * @deprecated in favor of the Composer\InstalledVersions class provided by Composer 2. Require composer-runtime-api:^2 to ensure it is present.
 */
final class Versions
{
    /**
     * @deprecated please use {@see self::rootPackageName()} instead.
     *             This constant will be removed in version 2.0.0.
     */
    const ROOT_PACKAGE_NAME = '__root__';
    /**
     * Array of all available composer packages.
     * Dont read this array from your calling code, but use the \PackageVersions\Versions::getVersion() method instead.
     *
     * @var array<string, string>
     * @internal
     */
    const VERSIONS = array('aws/aws-sdk-php' => '3.186.3@037fd80e421b1dde4d32ec16d0f79c61bbee1605', 'guzzlehttp/guzzle' => '7.3.0@7008573787b430c1c1f650e3722d9bba59967628', 'guzzlehttp/promises' => '1.4.1@8e7d04f1f6450fef59366c399cfad4b9383aa30d', 'guzzlehttp/psr7' => '1.8.2@dc960a912984efb74d0a90222870c72c87f10c91', 'mtdowling/jmespath.php' => '2.6.1@9b87907a81b87bc76d19a7fb2d61e61486ee9edb', 'psr/http-client' => '1.0.1@2dfb5f6c5eff0e91e20e913f8c5452ed95b86621', 'psr/http-message' => '1.0.1@f6561bf28d520154e4b0ec72be95418abe6d9363', 'ralouphie/getallheaders' => '3.0.3@120b605dfeb996808c31b6477290a714d356e822', 'symfony/polyfill-mbstring' => 'v1.23.1@9174a3d80210dca8daa7f31fec659150bbeabfc6', 'composer/package-versions-deprecated' => '1.11.99.2@c6522afe5540d5fc46675043d3ed5a45a740b27c', 'humbug/php-scoper' => '0.15.0@98c92f2ec5e12756d59ce04dfad34f9fce6c19c3', 'jetbrains/phpstorm-stubs' => 'v2020.3@daf8849db40acded37b13231a291c7536922955b', 'nikic/php-parser' => 'v4.12.0@6608f01670c3cc5079e18c1dab1104e002579143', 'psr/container' => '1.1.1@8622567409010282b7aeebe4bb841fe98b58dcaf', 'symfony/console' => 'v4.4.29@8baf0bbcfddfde7d7225ae8e04705cfd1081cd7b', 'symfony/filesystem' => 'v4.4.27@517fb795794faf29086a77d99eb8f35e457837a7', 'symfony/finder' => 'v4.4.27@42414d7ac96fc2880a783b872185789dea0d4262', 'symfony/polyfill-ctype' => 'v1.23.0@46cd95797e9df938fdd2b03693b5fca5e64b01ce', 'symfony/polyfill-php73' => 'v1.23.0@fba8933c384d6476ab14fb7b8526e5287ca7e010', 'symfony/polyfill-php80' => 'v1.23.1@1100343ed1a92e3a38f9ae122fc0eb21602547be', 'symfony/service-contracts' => 'v2.4.0@f040a30e04b57fbcc9c6cbcf4dbaa96bd318b9bb', '__root__' => 'dev-master@b7bc29468476c6f5b1e8f114825664bec46eb8de');
    private function __construct()
    {
    }
    /**
     * @psalm-pure
     *
     * @psalm-suppress ImpureMethodCall we know that {@see InstalledVersions} interaction does not
     *                                  cause any side effects here.
     */
    public static function rootPackageName() : string
    {
        if (!\class_exists(InstalledVersions::class, \false) || !(\method_exists(InstalledVersions::class, 'getAllRawData') ? InstalledVersions::getAllRawData() : InstalledVersions::getRawData())) {
            return self::ROOT_PACKAGE_NAME;
        }
        return InstalledVersions::getRootPackage()['name'];
    }
    /**
     * @throws OutOfBoundsException If a version cannot be located.
     *
     * @psalm-param key-of<self::VERSIONS> $packageName
     * @psalm-pure
     *
     * @psalm-suppress ImpureMethodCall we know that {@see InstalledVersions} interaction does not
     *                                  cause any side effects here.
     */
    public static function getVersion(string $packageName) : string
    {
        if (\class_exists(InstalledVersions::class, \false) && (\method_exists(InstalledVersions::class, 'getAllRawData') ? InstalledVersions::getAllRawData() : InstalledVersions::getRawData())) {
            return InstalledVersions::getPrettyVersion($packageName) . '@' . InstalledVersions::getReference($packageName);
        }
        if (isset(self::VERSIONS[$packageName])) {
            return self::VERSIONS[$packageName];
        }
        throw new OutOfBoundsException('Required package "' . $packageName . '" is not installed: check your ./vendor/composer/installed.json and/or ./composer.lock files');
    }
}
