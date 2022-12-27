<?php
/**
 * Verification
 * @author Nikolai Shcherbin
 * @license GNU Affero General Public License version 3
 * @copyright (c) Nikolai Shcherbin 2021
 * @link https://wzm.me
**/

return [
	'plugin' => [
		'name' => 'Verification',
		'version' => '4.3.3',
		'dependencies' => [
			'profile' => [
				'position' => 'after',
				'must_be_active' => true,
			],
			'theme' => [
				'position' => 'before',
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
	
	'hooks' => [
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
    ],
	
	'events' => [
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
		'notify_user' => false,
	],
];

