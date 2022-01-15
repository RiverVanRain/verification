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
		'version' => '4.0.0',
		'dependencies' => [
			'profile' => [
				'position' => 'after',
				'must_be_active' => true,
			],
			'vision_theme' => [
				'position' => 'after',
				'must_be_active' => false,
			],
			'theme' => [
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

	'settings' => [
		'verify_validate_user' => true,
		'verify_admin' => true,
	],
];

