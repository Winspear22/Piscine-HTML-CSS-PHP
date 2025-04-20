<?php

/**
 * This file has been auto-generated
 * by the Symfony Routing Component.
 */

return [
    false, // $matchHost
    [ // $staticRoutes
        '/ex01' => [[['_route' => 'ex01_index', '_controller' => 'App\\Ex01Bundle\\Controller\\Ex01Controller::index'], null, null, null, false, false, null]],
        '/ex01/create' => [[['_route' => 'ex01_create_table', '_controller' => 'App\\Ex01Bundle\\Controller\\Ex01Controller::createTable'], null, null, null, false, false, null]],
        '/ex01/delete' => [[['_route' => 'ex01_delete_table', '_controller' => 'App\\Ex01Bundle\\Controller\\Ex01Controller::deleteTable'], null, null, null, false, false, null]],
    ],
    [ // $regexpList
        0 => '{^(?'
                .'|/_error/(\\d+)(?:\\.([^/]++))?(*:35)'
            .')/?$}sDu',
    ],
    [ // $dynamicRoutes
        35 => [
            [['_route' => '_preview_error', '_controller' => 'error_controller::preview', '_format' => 'html'], ['code', '_format'], null, null, false, true, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
