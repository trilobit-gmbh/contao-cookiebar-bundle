<?php

/*
 * @copyright  trilobit GmbH
 * @author     trilobit GmbH <https://github.com/trilobit-gmbh>
 * @license    LGPL-3.0-or-later
 * @link       http://github.com/trilobit-gmbh/contao-cookiebar-bundle
 */

use Contao\CoreBundle\DataContainer\PaletteManipulator;
use Trilobit\CookiebarBundle\CookieBar;

PaletteManipulator::create()
    ->addLegend('cookiebar_legend', 'protected_legend', PaletteManipulator::POSITION_BEFORE)
    ->addField(['addCookieBar'], 'cookiebar_legend', PaletteManipulator::POSITION_APPEND)
    ->applyToPalette('regular', 'tl_page')
;

if (array_key_exists('rootfallback', $GLOBALS['TL_DCA']['tl_page']['palettes'])) {
    PaletteManipulator::create()
        ->addLegend('cookiebar_legend', 'meta_legend', PaletteManipulator::POSITION_BEFORE)
        ->addField(['addCookieBar'], 'cookiebar_legend', PaletteManipulator::POSITION_APPEND)
        ->applyToPalette('root', 'tl_page')
        ->applyToPalette('rootfallback', 'tl_page')
    ;
} else {
    PaletteManipulator::create()
        ->addLegend('cookiebar_legend', 'meta_legend', PaletteManipulator::POSITION_BEFORE)
        ->addField(['addCookieBar'], 'cookiebar_legend', PaletteManipulator::POSITION_APPEND)
        ->applyToPalette('root', 'tl_page')
    ;
}

$GLOBALS['TL_DCA']['tl_page']['subpalettes']['addCookieBar'] = ''
    .',cookieBarPosition'
    .',cookieBarTheme'
    .',cookieBarPalette'
    .',cookieBarMessage,cookieBarDismiss,cookieBarHref,cookieBarLink'
    .',cookieBarCookieName,cookieBarCookieExpiryDays,cookieBarCookiePath,cookieBarCookieDomain';

$GLOBALS['TL_DCA']['tl_page']['subpalettes']['cookieBarPalette_custom'] = 'cookieBarPaletteBanner,cookieBarPaletteBannerText,cookieBarPaletteButton,cookieBarPaletteButtonText,cookieBarPalettePreview';

foreach (array_keys(CookieBar::getConfigData()['palette']) as $key) {
    if ('custom' === $key || 'css' === $key) {
        continue;
    }
    $GLOBALS['TL_DCA']['tl_page']['subpalettes']['cookieBarPalette_'.$key] = 'cookieBarPalettePreview';
}

$GLOBALS['TL_DCA']['tl_page']['palettes']['__selector__'][] = 'addCookieBar';
$GLOBALS['TL_DCA']['tl_page']['palettes']['__selector__'][] = 'cookieBarPalette';

/*
 * Fields
 */
$GLOBALS['TL_DCA']['tl_page']['fields']['addCookieBar'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_page']['addCookieBar'],
    'exclude' => true,
    'inputType' => 'checkbox',
    'eval' => ['submitOnChange' => true, 'tl_class' => 'clr'],
    'sql' => "char(1) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_page']['fields']['cookieBarPalette'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_page']['cookieBarPalette'],
    'inputType' => 'select',
    'options_callback' => [CookieBar::class, 'getCookiebarPalette'],
    'reference' => &$GLOBALS['TL_LANG']['tl_page']['options']['cookieBarPalette'],
    'eval' => ['mandatory' => true, 'submitOnChange' => true, 'chosen' => true, 'includeBlankOption' => true, 'tl_class' => 'w50 clr'],
    'sql' => "char(64) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_page']['fields']['cookieBarPalettePreview'] = [
    'input_field_callback' => [CookieBar::class, 'previewPalette'],
    'eval' => ['doNotShow' => true],
];

$GLOBALS['TL_DCA']['tl_page']['fields']['cookieBarTheme'] = [
    'inputType' => 'select',
    'options_callback' => [CookieBar::class, 'getCookiebarTheme'],
    'reference' => &$GLOBALS['TL_LANG']['tl_page']['options']['cookieBarTheme'],
    'eval' => ['mandatory' => true, 'chosen' => true, 'includeBlankOption' => true, 'tl_class' => 'w50'],
    'sql' => "char(64) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_page']['fields']['cookieBarPaletteBanner'] = [
    'inputType' => 'text',
    'eval' => ['maxlength' => 6, 'multiple' => true, 'size' => 2, 'colorpicker' => true, 'isHexColor' => true, 'decodeEntities' => true, 'tl_class' => 'clr w50 wizard'],
    'sql' => "varchar(64) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_page']['fields']['cookieBarPaletteButton'] = [
    'inputType' => 'text',
    'eval' => ['maxlength' => 6, 'multiple' => true, 'size' => 2, 'colorpicker' => true, 'isHexColor' => true, 'decodeEntities' => true, 'tl_class' => 'clr w50 wizard'],
    'sql' => "varchar(64) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_page']['fields']['cookieBarPaletteBannerText'] = [
    'inputType' => 'text',
    'eval' => ['maxlength' => 6, 'multiple' => true, 'size' => 2, 'colorpicker' => true, 'isHexColor' => true, 'decodeEntities' => true, 'tl_class' => 'w50 wizard'],
    'sql' => "varchar(64) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_page']['fields']['cookieBarPaletteButtonText'] = [
    'inputType' => 'text',
    'eval' => ['maxlength' => 6, 'multiple' => true, 'size' => 2, 'colorpicker' => true, 'isHexColor' => true, 'decodeEntities' => true, 'tl_class' => 'w50 wizard'],
    'sql' => "varchar(64) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_page']['fields']['cookieBarPosition'] = [
    'inputType' => 'select',
    'options_callback' => [CookieBar::class, 'getCookiebarPosition'],
    'reference' => &$GLOBALS['TL_LANG']['tl_page']['options']['cookieBarPosition'],
    'eval' => ['mandatory' => true, 'chosen' => true, 'includeBlankOption' => true, 'tl_class' => 'w50 clr'],
    'sql' => "char(64) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_page']['fields']['cookieBarMessage'] = [
    'inputType' => 'text',
    'eval' => ['mandatory' => true, 'maxlength' => 255, 'tl_class' => 'clr w50'],
    'sql' => "varchar(255) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_page']['fields']['cookieBarHeader'] = [
    'inputType' => 'text',
    'eval' => ['mandatory' => true, 'maxlength' => 255, 'tl_class' => 'clr w50'],
    'sql' => "varchar(255) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_page']['fields']['cookieBarClose'] = [
    'inputType' => 'text',
    'eval' => ['mandatory' => true, 'maxlength' => 255, 'tl_class' => 'clr w50'],
    'sql' => "varchar(255) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_page']['fields']['cookieBarDismiss'] = [
    'inputType' => 'text',
    'eval' => ['mandatory' => true, 'maxlength' => 255, 'tl_class' => 'w50'],
    'sql' => "varchar(255) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_page']['fields']['cookieBarHref'] = [
    'inputType' => 'text',
    'eval' => ['mandatory' => true, 'rgxp' => 'url', 'decodeEntities' => true, 'maxlength' => 255, 'dcaPicker' => true, 'tl_class' => 'clr w50 wizard'],
    'sql' => "varchar(255) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_page']['fields']['cookieBarLink'] = [
    'inputType' => 'text',
    'eval' => ['mandatory' => true, 'maxlength' => 255, 'tl_class' => 'w50'],
    'sql' => "varchar(255) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_page']['fields']['cookieBarCookieName'] = [
    'inputType' => 'text',
    'eval' => ['maxlength' => 255, 'tl_class' => 'clr w50'],
    'sql' => "varchar(255) NOT NULL default 'cookieconsent_status'",
];

$GLOBALS['TL_DCA']['tl_page']['fields']['cookieBarCookiePath'] = [
    'inputType' => 'text',
    'eval' => ['maxlength' => 255, 'tl_class' => 'clr w50'],
    'sql' => "varchar(255) NOT NULL default '/'",
];

$GLOBALS['TL_DCA']['tl_page']['fields']['cookieBarCookieDomain'] = [
    'inputType' => 'text',
    'eval' => ['maxlength' => 255, 'tl_class' => 'w50'],
    'sql' => "varchar(255) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_page']['fields']['cookieBarCookieExpiryDays'] = [
    'inputType' => 'text',
    'eval' => ['rgxp' => 'natural', 'maxlength' => 3, 'tl_class' => 'w50'],
    'sql' => "smallint(5) unsigned NOT NULL default '365'",
];
