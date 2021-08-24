<?php

namespace wZm\Verification\Actions;

use Elgg\EntityPermissionsException;
use Elgg\Http\ResponseBuilder;
use Elgg\Request;

class UserVerificationAction {

	public function __invoke(Request $request) {

		$entity = $request->getEntityParam();
		
		if (!$entity instanceof \ElggUser) {
			throw new EntityPermissionsException();
		}
		
		if ($entity->isAdmin()) {
			return;
		}
		
		if ($entity->verified_user == true) {
			$entity->verified_user = false;
			
			$entity->save();
			
			return elgg_ok_response('', elgg_echo('verification:user:removed'));
		} else {
			$entity->verified_user = true;
			
			$entity->save();
			
			return elgg_ok_response('', elgg_echo('verification:user:verified'));
		}
	}
}