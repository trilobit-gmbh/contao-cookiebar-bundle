<?php

/*
 * @copyright  trilobit GmbH
 * @author     trilobit GmbH <https://github.com/trilobit-gmbh>
 * @license    LGPL-3.0-or-later
 * @link       http://github.com/trilobit-gmbh/contao-cookiebar-bundle
 */

$GLOBALS['TL_DCA']['tl_page']['subpalettes']['addCookieBar'] = ''
    .',cookieBarPosition'
    .',cookieBarTheme'
    .',cookieBarPalette'
    .',cookieBarMessage,cookieBarDismiss,cookieBarHref,cookieBarLink'
    .',cookieBarCookieName,cookieBarCookieExpiryDays,cookieBarCookiePath,cookieBarCookieDomain';

$GLOBALS['TL_DCA']['tl_page']['subpalettes']['cookieBarPalette_custom'] = 'cookieBarPaletteBanner,cookieBarPaletteBannerText,cookieBarPaletteButton,cookieBarPaletteButtonText,cookieBarPalettePreview';

foreach (array_keys(\Trilobit\CookiebarBundle\CookieBar::getConfigData()['palette']) as $key) {
    if ('custom' === $key || 'css' === $key) {
        continue;
    }
    $GLOBALS['TL_DCA']['tl_page']['subpalettes']['cookieBarPalette_'.$key] = 'cookieBarPalettePreview';
}

$GLOBALS['TL_DCA']['tl_page']['palettes']['__selector__'][] = 'addCookieBar';
$GLOBALS['TL_DCA']['tl_page']['palettes']['__selector__'][] = 'cookieBarPalette';

/*
 * Palettes
 */
$GLOBALS['TL_DCA']['tl_page']['palettes']['root'] = str_replace(
    ';{dns_legend',
    ';{cookiebar_legend},addCookieBar;{dns_legend',
    $GLOBALS['TL_DCA']['tl_page']['palettes']['root']
);

$GLOBALS['TL_DCA']['tl_page']['palettes']['rootfallback'] = str_replace(
    ';{dns_legend',
    ';{cookiebar_legend},addCookieBar;{dns_legend',
    $GLOBALS['TL_DCA']['tl_page']['palettes']['rootfallback']
);

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
    'options_callback' => ['\Trilobit\CookiebarBundle\CookieBar', 'getCookiebarPalette'],
    'reference' => &$GLOBALS['TL_LANG']['tl_page']['options']['cookieBarPalette'],
    'eval' => ['mandatory' => true, 'submitOnChange' => true, 'chosen' => true, 'includeBlankOption' => true, 'tl_class' => 'w50 clr'],
    'sql' => "char(64) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_page']['fields']['cookieBarPalettePreview'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_page']['cookieBarPalettePreview'],
    'input_field_callback' => ['\Trilobit\CookiebarBundle\CookieBar', 'previewPalette'],
    'eval' => ['doNotShow' => true],
];

$GLOBALS['TL_DCA']['tl_page']['fields']['cookieBarTheme'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_page']['cookieBarTheme'],
    'inputType' => 'select',
    'options_callback' => ['\Trilobit\CookiebarBundle\CookieBar', 'getCookiebarTheme'],
    'reference' => &$GLOBALS['TL_LANG']['tl_page']['options']['cookieBarTheme'],
    'eval' => ['mandatory' => true, 'chosen' => true, 'includeBlankOption' => true, 'tl_class' => 'w50'],
    'sql' => "char(64) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_page']['fields']['cookieBarPaletteBanner'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_page']['cookieBarPaletteBanner'],
    'inputType' => 'text',
    'eval' => ['maxlength' => 6, 'multiple' => true, 'size' => 2, 'colorpicker' => true, 'isHexColor' => true, 'decodeEntities' => true, 'tl_class' => 'clr w50 wizard'],
    'sql' => "varchar(64) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_page']['fields']['cookieBarPaletteButton'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_page']['cookieBarPaletteButton'],
    'inputType' => 'text',
    'eval' => ['maxlength' => 6, 'multiple' => true, 'size' => 2, 'colorpicker' => true, 'isHexColor' => true, 'decodeEntities' => true, 'tl_class' => 'clr w50 wizard'],
    'sql' => "varchar(64) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_page']['fields']['cookieBarPaletteBannerText'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_page']['cookieBarPaletteBannerText'],
    'inputType' => 'text',
    'eval' => ['maxlength' => 6, 'multiple' => true, 'size' => 2, 'colorpicker' => true, 'isHexColor' => true, 'decodeEntities' => true, 'tl_class' => 'w50 wizard'],
    'sql' => "varchar(64) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_page']['fields']['cookieBarPaletteButtonText'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_page']['cookieBarPaletteButtonText'],
    'inputType' => 'text',
    'eval' => ['maxlength' => 6, 'multiple' => true, 'size' => 2, 'colorpicker' => true, 'isHexColor' => true, 'decodeEntities' => true, 'tl_class' => 'w50 wizard'],
    'sql' => "varchar(64) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_page']['fields']['cookieBarPosition'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_page']['cookieBarPosition'],
    'inputType' => 'select',
    'options_callback' => ['\Trilobit\CookiebarBundle\CookieBar', 'getCookiebarPosition'],
    'reference' => &$GLOBALS['TL_LANG']['tl_page']['options']['cookieBarPosition'],
    'eval' => ['mandatory' => true, 'chosen' => true, 'includeBlankOption' => true, 'tl_class' => 'w50 clr'],
    'sql' => "char(64) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_page']['fields']['cookieBarMessage'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_page']['cookieBarMessage'],
    'inputType' => 'text',
    'eval' => ['mandatory' => true, 'maxlength' => 255, 'tl_class' => 'clr w50'],
    'sql' => "varchar(255) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_page']['fields']['cookieBarHeader'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_page']['cookieBarHeader'],
    'inputType' => 'text',
    'eval' => ['mandatory' => true, 'maxlength' => 255, 'tl_class' => 'clr w50'],
    'sql' => "varchar(255) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_page']['fields']['cookieBarClose'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_page']['cookieBarClose'],
    'inputType' => 'text',
    'eval' => ['mandatory' => true, 'maxlength' => 255, 'tl_class' => 'clr w50'],
    'sql' => "varchar(255) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_page']['fields']['cookieBarDismiss'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_page']['cookieBarDismiss'],
    'inputType' => 'text',
    'eval' => ['mandatory' => true, 'maxlength' => 255, 'tl_class' => 'w50'],
    'sql' => "varchar(255) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_page']['fields']['cookieBarHref'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_page']['cookieBarHref'],
    'inputType' => 'text',
    'eval' => ['mandatory' => true, 'rgxp' => 'url', 'decodeEntities' => true, 'maxlength' => 255, 'dcaPicker' => true, 'tl_class' => 'clr w50 wizard'],
    'sql' => "varchar(255) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_page']['fields']['cookieBarLink'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_page']['cookieBarLink'],
    'inputType' => 'text',
    'eval' => ['mandatory' => true, 'maxlength' => 255, 'tl_class' => 'w50'],
    'sql' => "varchar(255) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_page']['fields']['cookieBarCookieName'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_page']['cookieBarCookieName'],
    'inputType' => 'text',
    'eval' => ['maxlength' => 255, 'tl_class' => 'clr w50'],
    'sql' => "varchar(255) NOT NULL default 'cookieconsent_status'",
];

$GLOBALS['TL_DCA']['tl_page']['fields']['cookieBarCookiePath'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_page']['cookieBarCookiePath'],
    'inputType' => 'text',
    'eval' => ['maxlength' => 255, 'tl_class' => 'clr w50'],
    'sql' => "varchar(255) NOT NULL default '/'",
];

$GLOBALS['TL_DCA']['tl_page']['fields']['cookieBarCookieDomain'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_page']['cookieBarCookieDomain'],
    'inputType' => 'text',
    'eval' => ['maxlength' => 255, 'tl_class' => 'w50'],
    'sql' => "varchar(255) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_page']['fields']['cookieBarCookieExpiryDays'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_page']['cookieBarCookieExpiryDays'],
    'inputType' => 'text',
    'eval' => ['rgxp' => 'natural', 'maxlength' => 3, 'tl_class' => 'w50'],
    'sql' => "smallint(5) unsigned NOT NULL default '365'",
];

/**
 * Class tl_page_cookiebar.
 *
 * Provide miscellaneous methods that are used by the data configuration array.
 */
class tl_page_cookiebar extends Backend
{
    /**
     * Import the back end user object.
     */
    public function __construct()
    {
        parent::__construct();
        $this->import('BackendUser', 'User');
    }

    /**
     * @return string
     */
    public function pagePicker(DataContainer $dc)
    {
        return ' <a href="'.(('' === $dc->value || false !== strpos($dc->value, '{{link_url::')) ? 'contao/page.php' : 'contao/file.php').'?do='.Input::get('do').'&amp;table='.$dc->table.'&amp;field='.$dc->field.'&amp;value='.rawurlencode(str_replace(['{{link_url::', '}}'], '', $dc->value)).'&amp;switch=1'.'" title="'.specialchars($GLOBALS['TL_LANG']['MSC']['pagepicker']).'" onclick="Backend.getScrollOffset();Backend.openModalSelector({\'width\':768,\'title\':\''.specialchars(str_replace("'", "\\'", $GLOBALS['TL_LANG']['MOD']['page'][0])).'\',\'url\':this.href,\'id\':\''.$dc->field.'\',\'tag\':\'ctrl_'.$dc->field.(('editAll' === Input::get('act')) ? '_'.$dc->id : '').'\',\'self\':this});return false">'.Image::getHtml('pickpage.gif', $GLOBALS['TL_LANG']['MSC']['pagepicker'], 'style="vertical-align:top;cursor:pointer"').'</a>';
    }
}
