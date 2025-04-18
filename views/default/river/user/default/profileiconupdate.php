<?php

/**
 * Update avatar river view
 */

$item = elgg_extract('item', $vars);
if (!$item instanceof ElggRiverItem) {
    return;
}

$subject = $item->getSubjectEntity();
if (!$subject instanceof ElggUser) {
    return;
}

$subject_link = elgg_view_entity_url($subject, ['class' => 'elgg-river-subject']);

if ((bool) $subject->verified_user) {
    $subject_link .= elgg_format_element('span', [
        'class' => 'verified-badge',
        'title' => elgg_echo('verified:account'),
    ]);
}

$vars['summary'] = elgg_echo('river:update:user:avatar', [$subject_link]);
$vars['attachments'] = elgg_view_entity_icon($subject, 'tiny', [
    'use_hover' => false,
    'use_link' => false,
]);
$vars['responses'] = false;

echo elgg_view('river/elements/layout', $vars);
