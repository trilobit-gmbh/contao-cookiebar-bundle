<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (C) 2005-2014 Leo Feyer
 *
 * @package   trilobit
 * @author    trilobit GmbH <http://www.trilobit.de>
 * @license   LPGL
 * @copyright trilobit GmbH
 */

/**
 * Namespace
 */
namespace Trilobit\CookiebarBundle;

use Contao\Frontend;
use Contao\PageModel;
use Symfony\Component\Yaml\Yaml;


class CookieBar extends Frontend
{

    protected function getVendowDir()
    {
        return dirname(dirname(__FILE__));
    }


    public function getConfigData()
    {
        $strYml = file_get_contents(self::getVendowDir() . '/../config/config.yml');

        return Yaml::parse($strYml)['trilobit']['cookiebar'];
    }


    public function addCookieBar(PageModel $objPage, \LayoutModel $objLayout, \PageRegular $objPageRegular)
    {
        $objParentPages = PageModel::findParentsById($objPage->id);

        $arrRootPage = $objParentPages->last()->row();

        if ($arrRootPage['addCookieBar'] == '')
        {
            return;
        }

        $arrRootPage['cookieBarType']              = 'info';
        $arrRootPage['cookieBarLayout']            = 'basic';
        $arrRootPage['cookieBarCookieName']        = 'cookieconsent_status';
        $arrRootPage['cookieBarCookiePath']        = '/';
        $arrRootPage['cookieBarCookieDomain']      = '';
        $arrRootPage['cookieBarCookieExpiryDays']  = $arrRootPage['cookieBarExpiryDays'];

        $arrPalette = array();

        $arrOptions = array(
            'theme' => $arrRootPage['cookieBarTheme'],
            'content' => array(
                'header'  => $arrRootPage['cookieBarHeader'],
                'message' => $arrRootPage['cookieBarMessage'],
                'dismiss' => $arrRootPage['cookieBarDismiss'],
                'link'    => $arrRootPage['cookieBarLink'],
                'close'   => $arrRootPage['cookieBarClose'],
                'href'    => $arrRootPage['cookieBarHref'],
            ),
            'type'     => $arrRootPage['cookieBarType'],
            'layout'   => $arrRootPage['cookieBarLayout'],
            'position' => $arrRootPage['cookieBarPosition'],
            'cookie' => array(
                'name'       => $arrRootPage['cookieBarCookieName'],
                'path'       => $arrRootPage['cookieBarCookiePath'],
                'domain'     => $arrRootPage['cookieBarCookieDomain'],
                'expiryDays' => $arrRootPage['cookieBarCookieExpiryDays'],
            ),
        );

        if (   $arrRootPage['cookieBarPalette'] !== 'css'
            && $arrRootPage['cookieBarPalette'] !== 'custom'
        )
        {
            $arrPalette = CookieBar::getConfigData();
            $arrOptions['palette'] = $arrPalette['palette'][$arrRootPage['cookieBarPalette']];
        }

        if ($arrRootPage['cookieBarPalette'] === 'custom')
        {
            if ($arrRootPage['cookieBarPaletteBanner'] !== '')
            {
                $arrOptions['palette']['popup']['background'] = '#' . deserialize($arrRootPage['cookieBarPaletteBanner'])[0] . deserialize($arrRootPage['cookieBarPaletteBanner'])[1];
            }

            if ($arrRootPage['cookieBarPaletteBannerText'] !== '')
            {
                $arrOptions['palette']['popup']['text'] = '#' . deserialize($arrRootPage['cookieBarPaletteBannerText'])[0] . deserialize($arrRootPage['cookieBarPaletteBannerText'])[1];
            }

            if ($arrRootPage['cookieBarPaletteButton'] !== '')
            {
                $arrOptions['palette']['button']['background'] = '#' . deserialize($arrRootPage['cookieBarPaletteButton'])[0] . deserialize($arrRootPage['cookieBarPaletteButton'])[1];
            }

            if ($arrRootPage['cookieBarPaletteButtonText'] !== '')
            {
                $arrOptions['palette']['button']['text'] = '#' . deserialize($arrRootPage['cookieBarPaletteButtonText'])[0] . deserialize($arrRootPage['cookieBarPaletteButtonText'])[1];
            }
        }


        $GLOBALS['TL_HEAD']['cookieconsent'] = "<script>\n"
                . "window.addEventListener(\"load\", function() {\n"
                    . "window.cookieconsent.initialise(" . \Controller::replaceInsertTags(json_encode ($arrOptions)) . ");\n"
                . "});\n"
            . "</script>"
        ;

        $GLOBALS['TL_CSS']['cookieconsent']        = TRILOBIT_COOKIEBAR_ASSETS . '/cookieconsent.min.css|static';
        $GLOBALS['TL_JAVASCRIPT']['cookieconsent'] = TRILOBIT_COOKIEBAR_ASSETS . '/cookieconsent.min.js|static';
    }
}

