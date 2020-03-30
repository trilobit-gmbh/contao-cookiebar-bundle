<?php

/*
 * @copyright  trilobit GmbH
 * @author     trilobit GmbH <https://github.com/trilobit-gmbh>
 * @license    LGPL-3.0-or-later
 * @link       http://github.com/trilobit-gmbh/contao-cookiebar-bundle
 */

/**
 * Namespace.
 */

namespace Trilobit\CookiebarBundle;

use Contao\Controller;
use Contao\Frontend;
use Contao\PageModel;
use Symfony\Component\Yaml\Yaml;

/**
 * Class CookieBar.
 */
class CookieBar extends Frontend
{
    /**
     * @return mixed
     */
    public static function getConfigData()
    {
        $strYml = file_get_contents(self::getVendowDir().'/../config/config.yml');

        return Yaml::parse($strYml)['trilobit']['cookiebar'];
    }

    /**
     * @param DataContainer $dc
     *
     * @return array
     */
    public static function getCookiebarPalette(\Contao\DataContainer $dc)
    {
        return array_keys(self::getConfigData()['palette']);
    }

    /**
     * @param DataContainer $dc
     *
     * @return array
     */
    public static function getCookiebarTheme(\Contao\DataContainer $dc)
    {
        return array_keys(self::getConfigData()['theme']);
    }

    /**
     * @param DataContainer $dc
     *
     * @return array
     */
    public static function getCookiebarPosition(\Contao\DataContainer $dc)
    {
        return array_keys(self::getConfigData()['position']);
    }

    /**
     * @param DataContainer $dc
     *
     * @return string
     */
    public static function previewPalette(\Contao\DataContainer $dc)
    {
        $arrData = self::getConfigData()['palette'][$dc->activeRecord->cookieBarPalette];

        if ('custom' === $dc->activeRecord->cookieBarPalette) {
            $arrData = [
                'popup' => [
                    'background' => '#'.deserialize($dc->activeRecord->cookieBarPaletteBanner, true)[0].deserialize($dc->activeRecord->cookieBarPaletteBanner, true)[1],
                    'text' => '#'.deserialize($dc->activeRecord->cookieBarPaletteBannerText, true)[0].deserialize($dc->activeRecord->cookieBarPaletteBannerText, true)[1],
                ],
                'button' => [
                    'background' => '#'.deserialize($dc->activeRecord->cookieBarPaletteButton, true)[0].deserialize($dc->activeRecord->cookieBarPaletteButton, true)[1],
                    'text' => '#'.deserialize($dc->activeRecord->cookieBarPaletteButtonText, true)[0].deserialize($dc->activeRecord->cookieBarPaletteButtonText, true)[1],
                ],
            ];
            //return '<p><span>' . $dc->activeRecord->cookieBarPalette . print_r($arrData,1) . '</span></p>';
        }

        return '<div>'
            .'<div class="clr w50 wizard widget inline">'
            .'<h3><label>'.$GLOBALS['TL_LANG']['tl_page']['cookieBarPalettePreview'][0].'</label></h3>'
            .'<div class="theme-preview-container" style="background:'.$arrData['popup']['background'].'">'
            .'<p style="color:'.$arrData['popup']['text'].'">'
            .$dc->activeRecord->cookieBarMessage
            .'</p>'
            .'<div class="theme-preview-button" style="background:'.$arrData['button']['background'].'">'
            .'<p style="color:'.$arrData['button']['text'].'">'
            .$dc->activeRecord->cookieBarDismiss
            .'</p>'
            .'</div>'
            .'</div>'
            .'<p class="tl_help tl_tip" title="">'.$GLOBALS['TL_LANG']['tl_page']['cookieBarPalettePreview'][1].'</p>'
            .'</div>'
            .'</div>'
            ;
    }

    public function addCookieBar(\Contao\PageModel $objPage, \Contao\LayoutModel $objLayout, \Contao\PageRegular $objPageRegular)
    {
        $objParentPages = PageModel::findParentsById($objPage->id);

        $arrRootPage = $objParentPages->last()->row();

        if (empty($arrRootPage['addCookieBar'])) {
            return;
        }

        $arrRootPage['cookieBarType'] = 'info';
        $arrRootPage['cookieBarLayout'] = 'basic';
        $arrRootPage['cookieBarCookieName'] = !empty($arrRootPage['cookieBarCookieName']) ? $arrRootPage['cookieBarCookieName'] : 'cookieconsent_status';
        $arrRootPage['cookieBarCookiePath'] = !empty($arrRootPage['cookieBarCookiePath']) ? $arrRootPage['cookieBarCookiePath'] : '/';
        $arrRootPage['cookieBarCookieDomain'] = !empty($arrRootPage['cookieBarCookieDomain']) ? $arrRootPage['cookieBarCookieDomain'] : '';
        $arrRootPage['cookieBarCookieExpiryDays'] = !empty($arrRootPage['cookieBarCookieExpiryDays']) ? $arrRootPage['cookieBarCookieExpiryDays'] : '30';

        $arrPalette = [];

        $arrOptions = [
            'theme' => $arrRootPage['cookieBarTheme'],
            'content' => [
                'header' => $arrRootPage['cookieBarHeader'],
                'message' => $arrRootPage['cookieBarMessage'],
                'dismiss' => $arrRootPage['cookieBarDismiss'],
                'link' => $arrRootPage['cookieBarLink'],
                'close' => $arrRootPage['cookieBarClose'],
                'href' => $arrRootPage['cookieBarHref'],
            ],
            'type' => $arrRootPage['cookieBarType'],
            'layout' => $arrRootPage['cookieBarLayout'],
            'position' => $arrRootPage['cookieBarPosition'],
            'cookie' => [
                'name' => $arrRootPage['cookieBarCookieName'],
                'path' => $arrRootPage['cookieBarCookiePath'],
                'domain' => $arrRootPage['cookieBarCookieDomain'],
                'expiryDays' => \intval($arrRootPage['cookieBarCookieExpiryDays'], 10),
            ],
        ];

        if ('css' !== $arrRootPage['cookieBarPalette']
            && 'custom' !== $arrRootPage['cookieBarPalette']
        ) {
            $arrPalette = self::getConfigData();
            $arrOptions['palette'] = $arrPalette['palette'][$arrRootPage['cookieBarPalette']];
        }

        if ('custom' === $arrRootPage['cookieBarPalette']) {
            if ('' !== $arrRootPage['cookieBarPaletteBanner']) {
                $arrOptions['palette']['popup']['background'] = '#'.deserialize($arrRootPage['cookieBarPaletteBanner'])[0].deserialize($arrRootPage['cookieBarPaletteBanner'])[1];
            }

            if ('' !== $arrRootPage['cookieBarPaletteBannerText']) {
                $arrOptions['palette']['popup']['text'] = '#'.deserialize($arrRootPage['cookieBarPaletteBannerText'])[0].deserialize($arrRootPage['cookieBarPaletteBannerText'])[1];
            }

            if ('' !== $arrRootPage['cookieBarPaletteButton']) {
                $arrOptions['palette']['button']['background'] = '#'.deserialize($arrRootPage['cookieBarPaletteButton'])[0].deserialize($arrRootPage['cookieBarPaletteButton'])[1];
            }

            if ('' !== $arrRootPage['cookieBarPaletteButtonText']) {
                $arrOptions['palette']['button']['text'] = '#'.deserialize($arrRootPage['cookieBarPaletteButtonText'])[0].deserialize($arrRootPage['cookieBarPaletteButtonText'])[1];
            }
        }

        $GLOBALS['TL_HEAD']['cookieconsent'] = "<script>\n"
            ."window.addEventListener(\"load\", function() {\n"
            .'window.cookieconsent.initialise('.Controller::replaceInsertTags(json_encode($arrOptions)).");\n"
            ."});\n"
            .'</script>'
        ;

        $GLOBALS['TL_CSS']['cookieconsent'] = TRILOBIT_COOKIEBAR_ASSETS.'/cookieconsent.min.css|static';
        $GLOBALS['TL_JAVASCRIPT']['cookieconsent'] = TRILOBIT_COOKIEBAR_ASSETS.'/cookieconsent.min.js|static';
    }

    /**
     * @return string
     */
    protected function getVendowDir()
    {
        return \dirname(__DIR__);
    }
}
