<?php

namespace wZm\Verification\Actions;

class UserVerificationAction {

	public function __invoke(\Elgg\Request $request) {

		$entity = $request->getEntityParam();
		
		if (!$entity instanceof \ElggUser) {
			throw new \Elgg\Exceptions\Http\EntityPermissionsException();
		}
		
		if ($entity->verified_user == true) {
			$entity->verified_user = false;
			
			$entity->save();
			
			return elgg_ok_response('', elgg_echo('verification:user:removed'));
		} else {
			$entity->verified_user = true;
			
			$entity->save();
			
			// Notify user
			if ((bool) elgg_get_plugin_setting('notify_user', 'verification')) {
				$url = elgg_view('output/url', [
					'text' => elgg_get_site_entity()->getDisplayName(),
					'href' => elgg_get_site_url(),
				]);
				
				$subject = elgg_echo('verification:notify:subject', [
					elgg_get_site_entity()->getDisplayName(),
				], $entity->language);

				$body = elgg_echo('verification:notify:body', [
					$entity->getDisplayName(),
					$url,
				], $entity->language);

				$params = [
					'action' => 'verification',
					'object' => $entity,
					'url' => $url,
				];
				notify_user($entity->guid, elgg_get_site_entity()->guid, $subject, $body, $params);
			}
			
			return elgg_ok_response('', elgg_echo('verification:user:verified'));
		}
	}
}