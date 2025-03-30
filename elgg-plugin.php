<?php

/**
 * Verification
 * @author Nikolai Shcherbin
 * @license GNU Affero General Public License version 3
 * @copyright (c) Nikolai Shcherbin 2021
 * @link https://wzm.me
**/

$required = true;

if (elgg_is_active_plugin('theme')) {
    $required = false;
}

return [
    'plugin' => [
        'name' => 'Verification',
        'version' => '6.1.1',
        'dependencies' => [
            'profile' => [
                'position' => 'after',
                'must_be_active' => $required,
            ],
            'theme' => [
                'position' => 'before',
                'must_be_active' => false,
            ],
            'thewire' => [
                'position' => 'after',
                'must_be_active' => false,
            ],
            'tidypics' => [
                'position' => 'after',
                'must_be_active' => false,
            ],
        ],
        'activate_on_install' => true,
    ],

    'bootstrap' => \wZm\Verification\Bootstrap::class,

    'actions' => [
        'verification/user' => [
            'controller' => \wZm\Verification\Actions\UserVerificationAction::class,
            'access' => 'admin',
        ],
    ],

    'events' => [
        'register' => [
            'menu:user_hover' => [
                \wZm\Verification\Menus::class => [],
            ],
        ],
        'view_vars' => [
            'user/elements/summary' => [
                \wZm\Verification\Views::class => [
                    'priority' => 999,
                ],
            ],
        ],
        'make_admin' => [
            'user' => [
                '\wZm\Verification\Events::makeAdminEvent' => [],
            ],
        ],
        'remove_admin' => [
            'user' => [
                '\wZm\Verification\Events::removeAdminEvent' => [],
            ],
        ],
        'validate' => [
            'user' => [
                '\wZm\Verification\Events::validateUserEvent' => [],
            ],
        ],
    ],

    'view_extensions' => [
        'elgg.css' => [
            'verification/verification.css' => [],
        ],
        'admin.css' => [
            'verification/verification.css' => [],
        ],
    ],

    'settings' => [
        'verify_validate_user' => true,
        'verify_admin' => true,
    ],
];
