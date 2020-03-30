<?php

/*
 * @copyright  trilobit GmbH
 * @author     trilobit GmbH <https://github.com/trilobit-gmbh>
 * @license    LGPL-3.0-or-later
 * @link       http://github.com/trilobit-gmbh/contao-cookiebar-bundle
 */

/**
 * Register hook.
 */
$GLOBALS['TL_HOOKS']['generatePage'][] = ['Trilobit\CookiebarBundle\CookieBar', 'addCookieBar'];

define('TRILOBIT_COOKIEBAR_ASSETS', 'bundles/trilobitcookiebar/assets/build');

/*
 * Add css
 */
if (TL_MODE === 'BE') {
    $GLOBALS['TL_CSS'][] = 'bundles/trilobitcookiebar/css/backend.css';
}
