<?php

/**
 * This file has been auto-generated
 * by the Symfony Routing Component.
 */

return [
    false, // $matchHost
    [ // $staticRoutes
        '/ex00' => [[['_route' => 'ex00_index', '_controller' => 'App\\Ex00Bundle\\Controller\\Ex00Controller::index'], null, null, null, false, false, null]],
        '/ex00/create' => [[['_route' => 'ex00_create_table', '_controller' => 'App\\Ex00Bundle\\Controller\\Ex00Controller::createTable'], null, null, null, false, false, null]],
        '/ex00/delete' => [[['_route' => 'ex00_delete_table', '_controller' => 'App\\Ex00Bundle\\Controller\\Ex00Controller::deleteTable'], null, null, null, false, false, null]],
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
