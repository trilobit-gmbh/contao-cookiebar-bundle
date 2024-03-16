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

use Contao\DataContainer;
use Contao\Frontend;
use Contao\LayoutModel;
use Contao\PageModel;
use Contao\PageRegular;
use Contao\StringUtil;
use Contao\System;
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
        $strYml = file_get_contents((new self())->getVendowDir().'/../config/config.yml');

        return Yaml::parse($strYml)['trilobit']['cookiebar'];
    }

    /**
     * @return array
     */
    public static function getCookiebarPalette(DataContainer $dc)
    {
        return array_keys(self::getConfigData()['palette']);
    }

    /**
     * @return array
     */
    public static function getCookiebarTheme(DataContainer $dc)
    {
        return array_keys(self::getConfigData()['theme']);
    }

    /**
     * @return array
     */
    public static function getCookiebarPosition(DataContainer $dc)
    {
        return array_keys(self::getConfigData()['position']);
    }

    /**
     * @return string
     */
    public static function previewPalette(DataContainer $dc)
    {
        $arrData = self::getConfigData()['palette'][$dc->activeRecord->cookieBarPalette];

        if ('custom' === $dc->activeRecord->cookieBarPalette) {
            $arrData = [
                'popup' => [
                    'background' => '#'.StringUtil::deserialize($dc->activeRecord->cookieBarPaletteBanner, true)[0].StringUtil::deserialize($dc->activeRecord->cookieBarPaletteBanner, true)[1],
                    'text' => '#'.StringUtil::deserialize($dc->activeRecord->cookieBarPaletteBannerText, true)[0].StringUtil::deserialize($dc->activeRecord->cookieBarPaletteBannerText, true)[1],
                ],
                'button' => [
                    'background' => '#'.StringUtil::deserialize($dc->activeRecord->cookieBarPaletteButton, true)[0].StringUtil::deserialize($dc->activeRecord->cookieBarPaletteButton, true)[1],
                    'text' => '#'.StringUtil::deserialize($dc->activeRecord->cookieBarPaletteButtonText, true)[0].StringUtil::deserialize($dc->activeRecord->cookieBarPaletteButtonText, true)[1],
                ],
            ];
            //return '<p><span>' . $dc->activeRecord->cookieBarPalette . print_r($arrData,1) . '</span></p>';
        }

        return '<div>'
            .'<div class="clr w50 wizard widget inline">'
            .'<h3><label>'.$GLOBALS['TL_LANG']['tl_page']['cookieBarPalettePreview'][0].'</label></h3>'
            .'<div class="theme-preview-container" style="background:'.$arrData['popup']['background'].'">'
            .'<p style="color:'.($arrData['popup']['text'] ?? '').'">'
            .$dc->activeRecord->cookieBarMessage
            .'</p>'
            .'<div class="theme-preview-button" style="background:'.$arrData['button']['background'].'">'
            .'<p style="color:'.($arrData['button']['text'] ?? '').'">'
            .$dc->activeRecord->cookieBarDismiss
            .'</p>'
            .'</div>'
            .'</div>'
            .'<p class="tl_help tl_tip" title="">'.$GLOBALS['TL_LANG']['tl_page']['cookieBarPalettePreview'][1].'</p>'
            .'</div>'
            .'</div>'
            ;
    }

    public function addCookieBar(PageModel $objPage, LayoutModel $objLayout, PageRegular $objPageRegular)
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

        $arrOptions = [
            'theme' => $arrRootPage['cookieBarTheme'],
            'content' => [
                'header' => trim(System::getContainer()->get('contao.insert_tag.parser')->replaceInline($arrRootPage['cookieBarHeader'])),
                'message' => trim(System::getContainer()->get('contao.insert_tag.parser')->replaceInline($arrRootPage['cookieBarMessage'])),
                'dismiss' => trim(System::getContainer()->get('contao.insert_tag.parser')->replaceInline($arrRootPage['cookieBarDismiss'])),
                'link' => trim(System::getContainer()->get('contao.insert_tag.parser')->replaceInline($arrRootPage['cookieBarLink'])),
                'close' => trim(System::getContainer()->get('contao.insert_tag.parser')->replaceInline($arrRootPage['cookieBarClose'])),
                'href' => trim(System::getContainer()->get('contao.insert_tag.parser')->replaceInline($arrRootPage['cookieBarHref'])),
            ],
            'type' => $arrRootPage['cookieBarType'],
            'layout' => $arrRootPage['cookieBarLayout'],
            'position' => $arrRootPage['cookieBarPosition'],
            'cookie' => [
                'name' => $arrRootPage['cookieBarCookieName'],
                'path' => $arrRootPage['cookieBarCookiePath'],
                'domain' => trim($arrRootPage['cookieBarCookieDomain']),
                'expiryDays' => (int) $arrRootPage['cookieBarCookieExpiryDays'],
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
                $arrOptions['palette']['popup']['background'] = '#'.StringUtil::deserialize($arrRootPage['cookieBarPaletteBanner'])[0].StringUtil::deserialize($arrRootPage['cookieBarPaletteBanner'])[1];
            }

            if ('' !== $arrRootPage['cookieBarPaletteBannerText']) {
                $arrOptions['palette']['popup']['text'] = '#'.StringUtil::deserialize($arrRootPage['cookieBarPaletteBannerText'])[0].StringUtil::deserialize($arrRootPage['cookieBarPaletteBannerText'])[1];
            }

            if ('' !== $arrRootPage['cookieBarPaletteButton']) {
                $arrOptions['palette']['button']['background'] = '#'.StringUtil::deserialize($arrRootPage['cookieBarPaletteButton'])[0].StringUtil::deserialize($arrRootPage['cookieBarPaletteButton'])[1];
            }

            if ('' !== $arrRootPage['cookieBarPaletteButtonText']) {
                $arrOptions['palette']['button']['text'] = '#'.StringUtil::deserialize($arrRootPage['cookieBarPaletteButtonText'])[0].StringUtil::deserialize($arrRootPage['cookieBarPaletteButtonText'])[1];
            }
        }

        $GLOBALS['TL_HEAD']['cookieconsent'] = "<script>\n"
            ."window.addEventListener(\"load\", function() {\n"
            .'window.cookieconsent.initialise('.System::getContainer()->get('contao.insert_tag.parser')->replaceInline(json_encode($arrOptions)).");\n"
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
