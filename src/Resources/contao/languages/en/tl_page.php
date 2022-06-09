<?php

/*
 * @copyright  trilobit GmbH
 * @author     trilobit GmbH <https://github.com/trilobit-gmbh>
 * @license    LGPL-3.0-or-later
 * @link       http://github.com/trilobit-gmbh/contao-cookiebar-bundle
 */

// legends
$GLOBALS['TL_LANG']['tl_page']['cookiebar_legend'] = 'Cookie Consent settings';

// fields
$GLOBALS['TL_LANG']['tl_page']['addCookieBar'][0] = 'Add Cookie Consent';
$GLOBALS['TL_LANG']['tl_page']['addCookieBar'][1] = 'Add Cookie Consent (<a target="_blank" rel="noopener noreferrer" href="http://silktide.com/cookieconsent"><u>Cookie Consent plugin for the EU cookie law</u></a>)';
$GLOBALS['TL_LANG']['tl_page']['cookieBarTheme'][0] = 'Themes';
$GLOBALS['TL_LANG']['tl_page']['cookieBarTheme'][1] = 'Cookie Consent depends on topics. Users may select own designs. The selected design will be added to the popup container as a CSS class name with the pattern .cc-style-THEME_NAME.';
$GLOBALS['TL_LANG']['tl_page']['cookieBarPalette'][0] = 'Palette';
$GLOBALS['TL_LANG']['tl_page']['cookieBarPalette'][1] = 'Please select no, pre-defined or custom palettes.';
$GLOBALS['TL_LANG']['tl_page']['cookieBarPalettePreview'][0] = 'Palette preview';
$GLOBALS['TL_LANG']['tl_page']['cookieBarPalettePreview'][1] = 'Preview of pre-defined palette.';
$GLOBALS['TL_LANG']['tl_page']['cookieBarPaletteBanner'][0] = 'Color of banner';
$GLOBALS['TL_LANG']['tl_page']['cookieBarPaletteBanner'][1] = 'Please select the color of the banner.';
$GLOBALS['TL_LANG']['tl_page']['cookieBarPaletteButton'][0] = 'Color of button';
$GLOBALS['TL_LANG']['tl_page']['cookieBarPaletteButton'][1] = 'Please select the color of the button.';
$GLOBALS['TL_LANG']['tl_page']['cookieBarPaletteBannerText'][0] = 'Color of banner text';
$GLOBALS['TL_LANG']['tl_page']['cookieBarPaletteBannerText'][1] = 'Please select the color of the banner text.';
$GLOBALS['TL_LANG']['tl_page']['cookieBarPaletteButtonText'][0] = 'Color of button text';
$GLOBALS['TL_LANG']['tl_page']['cookieBarPaletteButtonText'][1] = 'Please select the color of the button text.';
$GLOBALS['TL_LANG']['tl_page']['cookieBarPosition'][0] = 'Position';
$GLOBALS['TL_LANG']['tl_page']['cookieBarPosition'][1] = 'The position is used to define, where on the screen the popup will be displayed. Wir verwenden auch "Position", um die Form Ihres Popups anzunehmen. Wenn Sie \'top\' oder \'bottom\' angeben, gehen wir davon aus, dass ein Banner mit voller Breite erforderlich ist. Wenn Sie jedoch eine horizontale Richtung angeben, gehen wir davon aus, dass ein Eck-Popup erforderlich ist (was wir als "floating" bezeichnen). Wir fügen CSS-Klassen \'cc-banner\' hinzu, wenn das Popup als Banner angezeigt wird, und \'cc-floating\', wenn das Popup als schwebendes Fenster angezeigt wird. Banner: oben, unten. Fenster/Floating: oben links, oben rechts, unten links, unten rechts.';
$GLOBALS['TL_LANG']['tl_page']['cookieBarMessage'][0] = 'Message';
$GLOBALS['TL_LANG']['tl_page']['cookieBarMessage'][1] = 'Please add message to be displayed to the user in cookie consent.';
$GLOBALS['TL_LANG']['tl_page']['cookieBarDismiss'][0] = 'Button text';
$GLOBALS['TL_LANG']['tl_page']['cookieBarDismiss'][1] = 'Please add the text of the button.';
$GLOBALS['TL_LANG']['tl_page']['cookieBarHref'][0] = 'Link for more information';
$GLOBALS['TL_LANG']['tl_page']['cookieBarHref'][1] = 'Please add a link for more information';
$GLOBALS['TL_LANG']['tl_page']['cookieBarLink'][0] = 'Link text for "more information".';
$GLOBALS['TL_LANG']['tl_page']['cookieBarLink'][1] = 'Please add the text for the "more information" text.';
$GLOBALS['TL_LANG']['tl_page']['cookieBarCookieName'][0] = 'Name of cookie';
$GLOBALS['TL_LANG']['tl_page']['cookieBarCookieName'][1] = 'Please add the name of the cookie, where the cookie consent is stored.';
$GLOBALS['TL_LANG']['tl_page']['cookieBarCookiePath'][0] = 'Path of cookie';
$GLOBALS['TL_LANG']['tl_page']['cookieBarCookiePath'][1] = 'Please add a path, the cookie belongs to. The cookie can be only read by subdpages of this path.';
$GLOBALS['TL_LANG']['tl_page']['cookieBarCookieDomain'][0] = 'Domain of cookie';
$GLOBALS['TL_LANG']['tl_page']['cookieBarCookieDomain'][1] = 'Please add a domain, the cookie belongs to. The cookie can be only read by this domain <a target="_blank" rel="noopener noreferrer" href="http://erik.io/blog/2014/03/04/definitive-guide-to-cookie-domains/"><u>Guide to cookie domains</u></a>.';
$GLOBALS['TL_LANG']['tl_page']['cookieBarCookieExpiryDays'][0] = 'Expiration date of cookue';
$GLOBALS['TL_LANG']['tl_page']['cookieBarCookieExpiryDays'][1] = 'Please add the number of days the cookie will be valid. (Type -1 for no expiration).';
$GLOBALS['TL_LANG']['tl_page']['cookieBarHeader'][0] = 'cookieBarHeader';
$GLOBALS['TL_LANG']['tl_page']['cookieBarHeader'][1] = '';
$GLOBALS['TL_LANG']['tl_page']['cookieBarClose'][0] = 'cookieBarClose';
$GLOBALS['TL_LANG']['tl_page']['cookieBarClose'][1] = '';

$GLOBALS['TL_LANG']['tl_page']['options']['cookieBarPosition']['top'] = 'Banner at top';
$GLOBALS['TL_LANG']['tl_page']['options']['cookieBarPosition']['bottom'] = 'Banner at bottom';
$GLOBALS['TL_LANG']['tl_page']['options']['cookieBarPosition']['top-left'] = 'Layer in top left corner';
$GLOBALS['TL_LANG']['tl_page']['options']['cookieBarPosition']['top-right'] = 'Layer in top right corner';
$GLOBALS['TL_LANG']['tl_page']['options']['cookieBarPosition']['bottom-left'] = 'Layer in bottom left corner';
$GLOBALS['TL_LANG']['tl_page']['options']['cookieBarPosition']['bottom-right'] = 'Layer in bottom right corner';

$GLOBALS['TL_LANG']['tl_page']['options']['cookieBarTheme']['block'] = 'Block';
$GLOBALS['TL_LANG']['tl_page']['options']['cookieBarTheme']['edgeless'] = 'edgeless';
$GLOBALS['TL_LANG']['tl_page']['options']['cookieBarTheme']['classic'] = 'classic';

$GLOBALS['TL_LANG']['tl_page']['options']['cookieBarPalette']['css'] = 'Custom CSS';
$GLOBALS['TL_LANG']['tl_page']['options']['cookieBarPalette']['custom'] = 'Definition';
$GLOBALS['TL_LANG']['tl_page']['options']['cookieBarPalette']['theme1'] = 'Theme 1';
$GLOBALS['TL_LANG']['tl_page']['options']['cookieBarPalette']['theme2'] = 'Theme 2';
$GLOBALS['TL_LANG']['tl_page']['options']['cookieBarPalette']['theme3'] = 'Theme 3';
$GLOBALS['TL_LANG']['tl_page']['options']['cookieBarPalette']['theme4'] = 'Theme 4';
$GLOBALS['TL_LANG']['tl_page']['options']['cookieBarPalette']['theme5'] = 'Theme 5';
$GLOBALS['TL_LANG']['tl_page']['options']['cookieBarPalette']['theme6'] = 'Theme 6';
$GLOBALS['TL_LANG']['tl_page']['options']['cookieBarPalette']['theme7'] = 'Theme 7';
$GLOBALS['TL_LANG']['tl_page']['options']['cookieBarPalette']['theme8'] = 'Theme 8';
$GLOBALS['TL_LANG']['tl_page']['options']['cookieBarPalette']['theme9'] = 'Theme 9';
$GLOBALS['TL_LANG']['tl_page']['options']['cookieBarPalette']['theme10'] = 'Theme 10';
$GLOBALS['TL_LANG']['tl_page']['options']['cookieBarPalette']['theme11'] = 'Theme 11';
$GLOBALS['TL_LANG']['tl_page']['options']['cookieBarPalette']['theme12'] = 'Theme 12';
$GLOBALS['TL_LANG']['tl_page']['options']['cookieBarPalette']['theme13'] = 'Theme 13';
$GLOBALS['TL_LANG']['tl_page']['options']['cookieBarPalette']['theme14'] = 'Theme 14';
$GLOBALS['TL_LANG']['tl_page']['options']['cookieBarPalette']['theme15'] = 'Theme 15';
$GLOBALS['TL_LANG']['tl_page']['options']['cookieBarPalette']['theme16'] = 'Theme 16';
