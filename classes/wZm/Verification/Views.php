<?php

namespace wZm\Verification;

class Views
{
    public function __invoke(\Elgg\Event $event)
    {

        $vars = $event->getValue();

        $entity = elgg_extract('entity', $vars);
        if (!$entity instanceof \ElggUser) {
            return;
        }

        if (!(bool) $entity->verified_user) {
            return;
        }

        $title = (string) elgg_extract('title', $vars);
        if (empty($title)) {
            return;
        }

        $vars['title'] .= elgg_format_element('span', [
            'class' => 'verified-badge',
            'title' => elgg_echo('verified:account'),
        ]);

        return $vars;
    }
}
