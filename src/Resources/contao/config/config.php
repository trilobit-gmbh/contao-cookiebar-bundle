<?php

/*
 * @copyright  trilobit GmbH
 * @author     trilobit GmbH <https://github.com/trilobit-gmbh>
 * @license    LGPL-3.0-or-later
 * @link       http://github.com/trilobit-gmbh/contao-cookiebar-bundle
 */

/*
 * Register hook.
 */

use Contao\System;
use Trilobit\CookiebarBundle\CookieBar;

$GLOBALS['TL_HOOKS']['generatePage'][] = [CookieBar::class, 'addCookieBar'];

define('TRILOBIT_COOKIEBAR_ASSETS', 'bundles/trilobitcookiebar/assets/build');

/*
 * Add css
 */
$request = System::getContainer()->get('request_stack')->getCurrentRequest();

if (null !== $request && System::getContainer()->get('contao.routing.scope_matcher')->isBackendRequest($request)) {
    $GLOBALS['TL_CSS'][] = 'bundles/trilobitcookiebar/css/backend.css';
}
