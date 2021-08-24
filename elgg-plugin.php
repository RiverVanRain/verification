<?php
/**
 * Verification
 * @author Nikolai Shcherbin
 * @license GNU Affero General Public License version 3
 * @copyright (c) Nikolai Shcherbin 2021
 * @link https://wzm.me
**/

return [
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

