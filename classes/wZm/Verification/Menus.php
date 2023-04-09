<?php

namespace wZm\Verification;

class Menus {
	
	//Administrators
	public static function adminMenu(\Elgg\Hook $hook) {
		$entity = $hook->getEntityParam();
		$return = $hook->getValue();
		
		if (!$entity instanceof \ElggUser || !elgg_is_admin_logged_in()) {
			return;
		}
		
		if (elgg_get_logged_in_user_guid() === $entity->guid) {
			return;
		}
		
		$verified = (bool) $entity->verified_user;

		$return[] = \ElggMenuItem::factory([
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
		
		$return[] = \ElggMenuItem::factory([
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
	
	//Moderators
	public static function moderatorMenu(\Elgg\Hook $hook) {
		if (!elgg_is_active_plugin('theme')) {
			return;
		}
		
		if (!(bool) elgg_get_plugin_setting('verify_allow_moderators', 'verification')) {
			return;
		}
		
		$entity = $hook->getEntityParam();
		$return = $hook->getValue();
		
		if (!$entity instanceof \ElggUser) {
			return;
		}
		
		$user = elgg_get_logged_in_user_entity();
		
		$svc = elgg()->roles;
		/* @var $svc \wZm\Capabilities\Roles */
			
		if (!$svc->hasRole('moderator', $user)) {
			return;
		}
		
		if ($user === $entity) {
			return;
		}
		
		$verified = (bool) $entity->verified_user;

		$return[] = \ElggMenuItem::factory([
			'name' => 'verify',
			'text' => elgg_echo('verification:user:verify'),
			'icon' => 'check',
			'href' => elgg_generate_action_url('verification/user', [
				'guid' => $entity->guid,
			]),
			'item_class' => $verified ? 'hidden' : '',
			'data-toggle' => 'unverify',
		]);
		
		$return[] = \ElggMenuItem::factory([
			'name' => 'unverify',
			'text' => elgg_echo('verification:user:verify:remove'),
			'icon' => 'times',
			'href' => elgg_generate_action_url('verification/user', [
				'guid' => $entity->guid,
			]),
			'item_class' => $verified ? '' : 'hidden',
			'data-toggle' => 'verify',
		]);

		return $return;
	}
	
	//Super moderators
	public static function supermoderatorMenu(\Elgg\Hook $hook) {
		if (!elgg_is_active_plugin('theme')) {
			return;
		}
		
		if (!(bool) elgg_get_plugin_setting('verify_allow_supermoderators', 'verification')) {
			return;
		}
		
		$entity = $hook->getEntityParam();
		$return = $hook->getValue();
		
		if (!$entity instanceof \ElggUser) {
			return;
		}
		
		$user = elgg_get_logged_in_user_entity();
		
		$svc = elgg()->roles;
		/* @var $svc \wZm\Capabilities\Roles */
			
		if (!$svc->hasRole('super_moderator', $user)) {
			return;
		}
		
		if ($user === $entity) {
			return;
		}
		
		$verified = (bool) $entity->verified_user;

		$return[] = \ElggMenuItem::factory([
			'name' => 'verify',
			'text' => elgg_echo('verification:user:verify'),
			'icon' => 'check',
			'href' => elgg_generate_action_url('verification/user', [
				'guid' => $entity->guid,
			]),
			'item_class' => $verified ? 'hidden' : '',
			'data-toggle' => 'unverify',
		]);
		
		$return[] = \ElggMenuItem::factory([
			'name' => 'unverify',
			'text' => elgg_echo('verification:user:verify:remove'),
			'icon' => 'times',
			'href' => elgg_generate_action_url('verification/user', [
				'guid' => $entity->guid,
			]),
			'item_class' => $verified ? '' : 'hidden',
			'data-toggle' => 'verify',
		]);

		return $return;
	}
}
