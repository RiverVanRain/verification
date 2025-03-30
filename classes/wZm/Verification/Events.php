<?php

namespace wZm\Verification;

use Elgg\Event;

class Events
{
    public static function validateUserEvent(Event $event)
    {

        $entity = $event->getObject();

        if (!$entity instanceof \ElggUser) {
            return;
        }

        if (!(bool) $entity->validated) {
            return;
        }

        if ((bool) $entity->verified_user) {
            return;
        }

        $entity->verified_user = true;

        $entity->save();
    }

    public static function makeAdminEvent(Event $event)
    {
        if (!(bool) elgg_get_plugin_setting('verify_admin', 'verification')) {
            return;
        }

        $entity = $event->getObject();

        if (!$entity instanceof \ElggUser) {
            return;
        }

        if ((bool) $entity->verified_user) {
            return;
        }

        $entity->verified_user = true;

        $entity->save();
    }

    public static function removeAdminEvent(Event $event)
    {
        if (!(bool) elgg_get_plugin_setting('verify_admin', 'verification')) {
            return;
        }

        $entity = $event->getObject();

        if (!$entity instanceof \ElggUser || !$entity->isAdmin()) {
            return;
        }

        if (!(bool) $entity->verified_user) {
            return;
        }

        $entity->verified_user = false;

        $entity->save();
    }
}
