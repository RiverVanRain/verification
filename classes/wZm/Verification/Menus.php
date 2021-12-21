<?php

namespace wZm\Verification;

use Elgg\Hook;
use ElggMenuItem;

class Menus {
	
	public function __invoke(Hook $hook) {
		$entity = $hook->getEntityParam();
		$return = $hook->getValue();
		
		if(!elgg_is_admin_logged_in()) {
			return;
		}

		if (!$entity instanceof \ElggUser) {
			return;
		}
		
		if (elgg_get_logged_in_user_guid() == $entity->guid) {
			return;
		}
		
		$verified = (bool) $entity->verified_user;

		$return[] = ElggMenuItem::factory([
			'name' => 'verify',
			'text' => elgg_echo('verification:user:verify'),
			'icon' => 'check',
			'href' => elgg_generate_action_url('verification/user', [
				'guid' => $entity->guid,
			]),
			'item_class' => $verified ? 'hidden' : '',
			'data-toggle' => 'unverify',
			'section' => 'admin',
		]);
		
		$return[] = ElggMenuItem::factory([
			'name' => 'unverify',
			'text' => elgg_echo('verification:user:verify:remove'),
			'icon' => 'times',
			'href' => elgg_generate_action_url('verification/user', [
				'guid' => $entity->guid,
			]),
			'item_class' => $verified ? '' : 'hidden',
			'data-toggle' => 'verify',
			'section' => 'admin',
		]);

		return $return;
	}
}
