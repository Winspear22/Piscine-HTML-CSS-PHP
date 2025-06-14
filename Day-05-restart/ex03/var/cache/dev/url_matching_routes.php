<?php

/**
 * This file has been auto-generated
 * by the Symfony Routing Component.
 */

return [
    false, // $matchHost
    [ // $staticRoutes
        '/ex03' => [[['_route' => 'ex03_index', '_controller' => 'App\\Ex03Bundle\\Controller\\Ex03Controller::index'], null, null, null, false, false, null]],
        '/ex03/insert' => [[['_route' => 'ex03_insert', '_controller' => 'App\\Ex03Bundle\\Controller\\Ex03Controller::insert'], null, null, null, false, false, null]],
        '/ex03/select' => [[['_route' => 'ex03_select', '_controller' => 'App\\Ex03Bundle\\Controller\\Ex03Controller::select'], null, null, null, false, false, null]],
        '/ex03/delete' => [[['_route' => 'ex03_delete', '_controller' => 'App\\Ex03Bundle\\Controller\\Ex03Controller::delete'], null, null, null, false, false, null]],
    ],
    [ // $regexpList
        0 => '{^(?'
                .'|/_error/(\\d+)(?:\\.([^/]++))?(*:35)'
                .'|/(.*)(*:47)'
            .')/?$}sDu',
    ],
    [ // $dynamicRoutes
        35 => [[['_route' => '_preview_error', '_controller' => 'error_controller::preview', '_format' => 'html'], ['code', '_format'], null, null, false, true, null]],
        47 => [
            [['_route' => 'app_ex03_ex03_notfound', '_controller' => 'App\\Ex03Bundle\\Controller\\Ex03Controller::notFound'], ['wildcard'], null, null, false, true, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
