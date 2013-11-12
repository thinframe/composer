<?php

/**
 * /src/ThinFrame/Composer/Installer.php
 *
 * @copyright 2013 Sorin Badea <sorin.badea91@gmail.com>
 * @license   MIT license (see the license file in the root directory)
 */

namespace ThinFrame\Composer;

use Composer\Installer\LibraryInstaller;
use Composer\Package\PackageInterface;

/**
 * Class Installer
 *
 * @package ThinFrame\Composer
 * @since   0.2
 */
class Installer extends LibraryInstaller
{
    /**
     * @var array
     */
    private $packages = [];

    /**
     * @inheritdoc
     * @override
     */
    public function getInstallPath(PackageInterface $package)
    {
        $this->packages[$package->getName()] = $package->getExtra();
        return parent::getInstallPath($package);
    }

    /**
     * Save collected data
     */
    function __destruct()
    {
        foreach ($this->packages as $package => $extra) {
            if (!is_dir($this->vendorDir . DIRECTORY_SEPARATOR . $package)) {
                unset($this->packages[$package]);
            }
        }
        file_put_contents(
            $this->vendorDir . DIRECTORY_SEPARATOR . 'composer/packages_extradata.php',
            '<?php' . PHP_EOL . 'return ' . var_export($this->packages, true) . ';'
        );
    }

}