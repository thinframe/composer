<?php

/**
 * /src/ThinFrame/Composer/Installer.php
 *
 * @copyright 2013 Sorin Badea <sorin.badea91@gmail.com>
 * @license   MIT license (see the license file in the root directory)
 */

namespace ThinFrame\Composer;

/**
 * Class ComposerHelper
 *
 * @package ThinFrame\Composer
 * @since   0.2
 */
class ComposerHelper
{
    /**
     * @var array
     */
    private static $packagesExtraData;

    /**
     * Get extra data for specific package
     *
     * @param $package
     *
     * @return array
     */
    public static function getExtraFor($package)
    {
        $extra = self::getExtraData();
        return isset($extra[$package]) ? $extra[$package] : [];
    }

    /**
     * Get stored extra data
     *
     * @return array
     */
    private static function getExtraData()
    {
        if (is_null(self::$packagesExtraData)) {
            self::$packagesExtraData = self::loadExtraData();
        }
        return self::$packagesExtraData;
    }

    /**
     * Load extra data from file
     *
     * @return array
     */
    private static function loadExtraData()
    {
        $vendorsDir = 'vendor' . DIRECTORY_SEPARATOR;
        if (file_exists($vendorsDir . 'composer/packages_extradata.php')) {
            return require $vendorsDir . 'composer/packages_extradata.php';
        } else {
            return [];
        }
    }

    /**
     * Get extra data for all processed packages
     *
     * @return array
     */
    public static function getExtraForAllPackages()
    {
        return self::getExtraData();
    }
}