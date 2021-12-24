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
		'version' => '3.0.0',
		'dependencies' => [
			'profile' => [
				'position' => 'after',
			],
			'vision_theme' => [
				'position' => 'after',
			],
			'theme' => [
				'position' => 'after',
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
