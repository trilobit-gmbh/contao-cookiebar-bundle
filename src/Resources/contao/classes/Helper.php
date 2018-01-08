<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2015 Leo Feyer
 *
 * @license LGPL-3.0+
 */

namespace Trilobit\CookiebarBundle;

use Frontend;
use Symfony\Component\Yaml\Yaml;


class Helper
{

    protected function getVendowDir()
    {
        return dirname(dirname(__FILE__));
    }
    
    
    protected function getConfigData()
    {
        $strYml = file_get_contents(self::getVendowDir() . '/../config/config.yml');

        return Yaml::parse($strYml)['trilobit']['cookiebar'];
    }
}
