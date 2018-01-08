<?php

/**
 * SubPalettes
 */
$GLOBALS['TL_DCA']['tl_page']['subpalettes']['addCookieBar'] = ''
    . ',cookieBarPosition'
    . ',cookieBarTheme'
    . ',cookieBarPalette'
    . ',cookieBarMessage,cookieBarDismiss,cookieBarHref,cookieBarLink'
    . ',cookieBarCookieName,cookieBarCookieExpiryDays,cookieBarCookiePath,cookieBarCookieDomain';

$GLOBALS['TL_DCA']['tl_page']['subpalettes']['cookieBarPalette_custom'] = 'cookieBarPaletteBanner,cookieBarPaletteBannerText,cookieBarPaletteButton,cookieBarPaletteButtonText,cookieBarPalettePreview';

foreach (array_keys(\Trilobit\CookiebarBundle\CookieBar::getConfigData()['palette']) as $key)
{
    if ($key === 'custom' || $key === 'css') continue;

    $GLOBALS['TL_DCA']['tl_page']['subpalettes']['cookieBarPalette_' . $key] = 'cookieBarPalettePreview';
}

$GLOBALS['TL_DCA']['tl_page']['palettes']['__selector__'][] = 'addCookieBar';
$GLOBALS['TL_DCA']['tl_page']['palettes']['__selector__'][] = 'cookieBarPalette';


/**
 * Palettes
 */
$GLOBALS['TL_DCA']['tl_page']['palettes']['root'] = str_replace
(
    ';{dns_legend',
    ';{cookiebar_legend},addCookieBar;{dns_legend',
    $GLOBALS['TL_DCA']['tl_page']['palettes']['root']
);


/**
 * Fields
 */
$GLOBALS['TL_DCA']['tl_page']['fields']['addCookieBar'] = array
(
    'label'            => &$GLOBALS['TL_LANG']['tl_page']['addCookieBar'],
    'exclude'          => true,
    'inputType'        => 'checkbox',
    'eval'             => array('submitOnChange'=>true, 'tl_class'=>'clr'),
    'sql'              => "char(1) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_page']['fields']['cookieBarPalette'] = array
(
    'label'            => &$GLOBALS['TL_LANG']['tl_page']['cookieBarPalette'],
    'inputType'        => 'select',
    'options_callback' => array('tl_page_cookiebar', 'getCookiebarPalette'),
    'reference'        => &$GLOBALS['TL_LANG']['tl_page']['options']['cookieBarPalette'],
    'eval'             => array('mandatory'=>true, 'submitOnChange'=>true, 'chosen'=>true, 'includeBlankOption'=>true, 'tl_class'=>'w50 clr'),
    'sql'              => "char(64) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_page']['fields']['cookieBarPalettePreview'] = array
(
    'label'            => &$GLOBALS['TL_LANG']['tl_page']['cookieBarPalettePreview'],
    'input_field_callback' => array('tl_page_cookiebar', 'previewPalette'),
    'eval'                 => array('doNotShow'=>true)
);

$GLOBALS['TL_DCA']['tl_page']['fields']['cookieBarTheme'] = array
(
    'label'            => &$GLOBALS['TL_LANG']['tl_page']['cookieBarTheme'],
    'inputType'        => 'select',
    'options_callback' => array('tl_page_cookiebar', 'getCookiebarTheme'),
    'reference'        => &$GLOBALS['TL_LANG']['tl_page']['options']['cookieBarTheme'],
    'eval'             => array('mandatory'=>true, 'chosen'=>true, 'includeBlankOption'=>true, 'tl_class'=>'w50'),
    'sql'              => "char(64) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_page']['fields']['cookieBarPaletteBanner'] = array
(
    'label'            => &$GLOBALS['TL_LANG']['tl_page']['cookieBarPaletteBanner'],
    'inputType'        => 'text',
    'eval'             => array('maxlength'=>6, 'multiple'=>true, 'size'=>2, 'colorpicker'=>true, 'isHexColor'=>true, 'decodeEntities'=>true, 'tl_class'=>'clr w50 wizard'),
    'sql'              => "varchar(64) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_page']['fields']['cookieBarPaletteButton'] = array
(
    'label'            => &$GLOBALS['TL_LANG']['tl_page']['cookieBarPaletteButton'],
    'inputType'        => 'text',
    'eval'             => array('maxlength'=>6, 'multiple'=>true, 'size'=>2, 'colorpicker'=>true, 'isHexColor'=>true, 'decodeEntities'=>true, 'tl_class'=>'clr w50 wizard'),
    'sql'              => "varchar(64) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_page']['fields']['cookieBarPaletteBannerText'] = array
(
    'label'            => &$GLOBALS['TL_LANG']['tl_page']['cookieBarPaletteBannerText'],
    'inputType'        => 'text',
    'eval'             => array('maxlength'=>6, 'multiple'=>true, 'size'=>2, 'colorpicker'=>true, 'isHexColor'=>true, 'decodeEntities'=>true, 'tl_class'=>'w50 wizard'),
    'sql'              => "varchar(64) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_page']['fields']['cookieBarPaletteButtonText'] = array
(
    'label'            => &$GLOBALS['TL_LANG']['tl_page']['cookieBarPaletteButtonText'],
    'inputType'        => 'text',
    'eval'             => array('maxlength'=>6, 'multiple'=>true, 'size'=>2, 'colorpicker'=>true, 'isHexColor'=>true, 'decodeEntities'=>true, 'tl_class'=>'w50 wizard'),
    'sql'              => "varchar(64) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_page']['fields']['cookieBarPosition'] = array
(
    'label'            => &$GLOBALS['TL_LANG']['tl_page']['cookieBarPosition'],
    'inputType'        => 'select',
    'options_callback' => array('tl_page_cookiebar', 'getCookiebarPosition'),
    'reference'        => &$GLOBALS['TL_LANG']['tl_page']['options']['cookieBarPosition'],
    'eval'             => array('mandatory'=>true, 'chosen'=>true, 'includeBlankOption'=>true, 'tl_class'=>'w50 clr'),
    'sql'              => "char(64) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_page']['fields']['cookieBarMessage'] = array
(
    'label'            => &$GLOBALS['TL_LANG']['tl_page']['cookieBarMessage'],
    'inputType'        => 'text',
    'eval'             => array('mandatory'=>true, 'maxlength'=>255, 'tl_class'=>'clr w50'),
    'sql'              => "varchar(255) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_page']['fields']['cookieBarHeader'] = array
(
    'label'            => &$GLOBALS['TL_LANG']['tl_page']['cookieBarHeader'],
    'inputType'        => 'text',
    'eval'             => array('mandatory'=>true, 'maxlength'=>255, 'tl_class'=>'clr w50'),
    'sql'              => "varchar(255) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_page']['fields']['cookieBarClose'] = array
(
    'label'            => &$GLOBALS['TL_LANG']['tl_page']['cookieBarClose'],
    'inputType'        => 'text',
    'eval'             => array('mandatory'=>true, 'maxlength'=>255, 'tl_class'=>'clr w50'),
    'sql'              => "varchar(255) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_page']['fields']['cookieBarDismiss'] = array
(
    'label'            => &$GLOBALS['TL_LANG']['tl_page']['cookieBarDismiss'],
    'inputType'        => 'text',
    'eval'             => array('mandatory'=>true, 'maxlength'=>255, 'tl_class'=>'w50'),
    'sql'              => "varchar(255) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_page']['fields']['cookieBarHref'] = array
(
    'label'            => &$GLOBALS['TL_LANG']['tl_page']['cookieBarHref'],
    'inputType'        => 'text',
    'eval'             => array('mandatory'=>true, 'rgxp'=>'url', 'decodeEntities'=>true, 'maxlength'=>255, 'dcaPicker'=>true, 'tl_class'=>'clr w50 wizard'),
    'sql'              => "varchar(255) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_page']['fields']['cookieBarLink'] = array
(
    'label'            => &$GLOBALS['TL_LANG']['tl_page']['cookieBarLink'],
    'inputType'        => 'text',
    'eval'             => array('mandatory'=>true, 'maxlength'=>255, 'tl_class'=>'w50'),
    'sql'              => "varchar(255) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_page']['fields']['cookieBarCookieName'] = array
(
    'label'            => &$GLOBALS['TL_LANG']['tl_page']['cookieBarCookieName'],
    'inputType'        => 'text',
    'eval'             => array('maxlength'=>255, 'tl_class'=>'clr w50'),
    'sql'              => "varchar(255) NOT NULL default 'cookieconsent_status'"
);

$GLOBALS['TL_DCA']['tl_page']['fields']['cookieBarCookiePath'] = array
(
    'label'            => &$GLOBALS['TL_LANG']['tl_page']['cookieBarCookiePath'],
    'inputType'        => 'text',
    'eval'             => array('maxlength'=>255, 'tl_class'=>'clr w50'),
    'sql'              => "varchar(255) NOT NULL default '/'"
);

$GLOBALS['TL_DCA']['tl_page']['fields']['cookieBarCookieDomain'] = array
(
    'label'            => &$GLOBALS['TL_LANG']['tl_page']['cookieBarCookieDomain'],
    'inputType'        => 'text',
    'eval'             => array('maxlength'=>255, 'tl_class'=>'w50'),
    'sql'              => "varchar(255) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_page']['fields']['cookieBarCookieExpiryDays'] = array
(
    'label'            => &$GLOBALS['TL_LANG']['tl_page']['cookieBarCookieExpiryDays'],
    'inputType'        => 'text',
    'eval'             => array('rgxp'=>'natural', 'maxlength'=>3, 'tl_class'=>'w50'),
    'sql'              => "smallint(5) unsigned NOT NULL default '365'"
);


/**
 * Class tl_page_cookiebar
 *
 * Provide miscellaneous methods that are used by the data configuration array.
 *
 */
class tl_page_cookiebar extends Backend
{

    /**
     * Import the back end user object
     */
    public function __construct()
    {
        parent::__construct();
        $this->import('BackendUser', 'User');
    }


    /**
     * @param DataContainer $dc
     * @return string
     */
    public function pagePicker(DataContainer $dc)
    {
        return ' <a href="' . (($dc->value == '' || strpos($dc->value, '{{link_url::') !== false) ? 'contao/page.php' : 'contao/file.php') . '?do=' . Input::get('do') . '&amp;table=' . $dc->table . '&amp;field=' . $dc->field . '&amp;value=' . rawurlencode(str_replace(array('{{link_url::', '}}'), '', $dc->value)) . '&amp;switch=1' . '" title="' . specialchars($GLOBALS['TL_LANG']['MSC']['pagepicker']) . '" onclick="Backend.getScrollOffset();Backend.openModalSelector({\'width\':768,\'title\':\'' . specialchars(str_replace("'", "\\'", $GLOBALS['TL_LANG']['MOD']['page'][0])) . '\',\'url\':this.href,\'id\':\'' . $dc->field . '\',\'tag\':\'ctrl_'. $dc->field . ((Input::get('act') == 'editAll') ? '_' . $dc->id : '') . '\',\'self\':this});return false">' . Image::getHtml('pickpage.gif', $GLOBALS['TL_LANG']['MSC']['pagepicker'], 'style="vertical-align:top;cursor:pointer"') . '</a>';
    }


    /**
     * @return string
     */
    protected function getVendowDir()
    {
        return dirname(dirname(__FILE__));
    }


    /**
     * @return mixed
     */
    protected function getConfigData()
    {
        $strYml = file_get_contents(self::getVendowDir() . '/../config/config.yml');

        return Yaml::parse($strYml)['trilobit']['cookiebar'];
    }


    /**
     * @param DataContainer $dc
     * @return array
     */
    public function getCookiebarPalette(DataContainer $dc)
    {
        return array_keys(\Trilobit\CookiebarBundle\CookieBar::getConfigData()['palette']);
    }


    /**
     * @param DataContainer $dc
     * @return array
     */
    public function getCookiebarTheme(DataContainer $dc)
    {
        return array_keys(\Trilobit\CookiebarBundle\CookieBar::getConfigData()['theme']);
    }


    /**
     * @param DataContainer $dc
     * @return array
     */
    public function getCookiebarPosition(DataContainer $dc)
    {
        return array_keys(\Trilobit\CookiebarBundle\CookieBar::getConfigData()['position']);
    }


    /**
     * @param DataContainer $dc
     * @return string
     */
    public function previewPalette(DataContainer $dc)
    {
        $arrData = \Trilobit\CookiebarBundle\CookieBar::getConfigData()['palette'][$dc->activeRecord->cookieBarPalette];


        if ($dc->activeRecord->cookieBarPalette === 'custom')
        {
            $arrData = array
            (
                'popup' => array(
                    'background' => '#' . deserialize($dc->activeRecord->cookieBarPaletteBanner, true)[0] . deserialize($dc->activeRecord->cookieBarPaletteBanner, true)[1],
                    'text' => '#' . deserialize($dc->activeRecord->cookieBarPaletteBannerText, true)[0] . deserialize($dc->activeRecord->cookieBarPaletteBannerText, true)[1],
                ),
                'button' => array(
                    'background' => '#' . deserialize($dc->activeRecord->cookieBarPaletteButton, true)[0] . deserialize($dc->activeRecord->cookieBarPaletteButton, true)[1],
                    'text' => '#' . deserialize($dc->activeRecord->cookieBarPaletteButtonText, true)[0] . deserialize($dc->activeRecord->cookieBarPaletteButtonText, true)[1],
                ),
            );
            //return '<p><span>' . $dc->activeRecord->cookieBarPalette . print_r($arrData,1) . '</span></p>';
        }

        return '<div>'
            . '<div class="clr w50 wizard widget inline">'
                . '<h3><label>' . $GLOBALS['TL_LANG']['tl_page']['cookieBarPalettePreview'][0] . '</label></h3>'
                . '<div class="theme-preview-container" style="background:'.$arrData['popup']['background'].'">'
                    . '<p style="color:'.$arrData['popup']['text'].'">'
                        . $dc->activeRecord->cookieBarMessage
                    . '</p>'
                    . '<div class="theme-preview-button" style="background:'.$arrData['button']['background'].'">'
                        . '<p style="color:'.$arrData['button']['text'].'">'
                            . $dc->activeRecord->cookieBarDismiss
                        . '</p>'
                    . '</div>'
                . '</div>'
                . '<p class="tl_help tl_tip" title="">' . $GLOBALS['TL_LANG']['tl_page']['cookieBarPalettePreview'][1] . '</p>'
            . '</div>'
            . '</div>'
            ;
    }
}
