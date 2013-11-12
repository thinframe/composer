<?php

/**
 * /src/ThinFrame/Composer/Plugin.php
 *
 * @copyright 2013 Sorin Badea <sorin.badea91@gmail.com>
 * @license   MIT license (see the license file in the root directory)
 */

namespace ThinFrame\Composer;

use Composer\Composer;
use Composer\IO\IOInterface;
use Composer\Plugin\PluginInterface;

/**
 * Class Plugin
 *
 * @package ThinFrame\Composer
 * @since   0.2
 */
class Plugin implements PluginInterface
{
    /**
     * Apply plugin modifications to composer
     *
     * @param Composer    $composer
     * @param IOInterface $io
     */
    public function activate(Composer $composer, IOInterface $io)
    {
        $manager = $composer->getInstallationManager();

        $libraryInstaller = $manager->getInstaller('library');

        $manager->removeInstaller($libraryInstaller);

        $installer = new Installer($io, $composer);
        $manager->addInstaller($installer);

    }

}