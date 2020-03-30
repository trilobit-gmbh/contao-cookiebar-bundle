<?php

/*
 * @copyright  trilobit GmbH
 * @author     trilobit GmbH <https://github.com/trilobit-gmbh>
 * @license    LGPL-3.0-or-later
 * @link       http://github.com/trilobit-gmbh/contao-cookiebar-bundle
 */

namespace Trilobit\CookiebarBundle;

use Symfony\Component\Yaml\Yaml;

class Helper
{
    protected function getVendowDir()
    {
        return \dirname(__DIR__);
    }

    protected function getConfigData()
    {
        $strYml = file_get_contents(self::getVendowDir().'/../config/config.yml');

        return Yaml::parse($strYml)['trilobit']['cookiebar'];
    }
}
