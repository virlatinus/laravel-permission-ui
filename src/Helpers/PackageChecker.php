<?php

namespace virlatinus\PermissionsUI\Helpers;

use JsonException;

/**
 * Checks if a package is installed by inspecting the 'composer.lock' file
 *
 *  Example usage:
 *  if (PackageChecker::isPackageInstalled('phpunit/phpunit')) {
 *      echo "phpunit/phpunit is installed.";
 *  } else {
 *      echo "phpunit/phpunit is not installed.";
 *  }
 */
class PackageChecker
{
    /**
     * Checks if a composer package is installed
     *
     * @param string $packageName
     * @return bool
     */
    public static function isPackageInstalled(string $packageName): bool
    {
        if (!config('permission_ui.enable_tenants_admin')) {
            return false;
        }

        $composerLockPath = base_path('composer.lock');

        if (!file_exists($composerLockPath)) {
            return false; // composer.lock not found
        }

        $composerLockContents = file_get_contents($composerLockPath);

        try {
            $data = json_decode($composerLockContents, true, 512, JSON_THROW_ON_ERROR);
        } catch (JsonException $e) {
            return false; // error decoding composer.lock
        }

        if (!isset($data['packages'])) {
            return false; // missing packages section in composer.lock
        }

        return array_any($data['packages'], static fn($package) => $package['name'] === $packageName);
    }
}
