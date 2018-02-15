<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2015 Leo Feyer
 *
 * @license LGPL-3.0+
 */

/**
 * Register hook
 */
$GLOBALS['TL_HOOKS']['generatePage'][] = array('Trilobit\CookiebarBundle\CookieBar', 'addCookieBar');


define('TRILOBIT_COOKIEBAR_ASSETS', 'bundles/trilobitcookiebar/assets/build');


/**
 * Add css
 */
if (TL_MODE == 'BE')
{
    $GLOBALS['TL_CSS'][] = 'bundles/trilobitcookiebar/css/backend.css';
}
