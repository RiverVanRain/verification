<?php
/**
 * File river view.
 */

if (!elgg_is_active_plugin('thewire')) {
	return;
}

$item = elgg_extract('item', $vars);
if (!$item instanceof \ElggRiverItem) {
	return;
}

$object = $item->getObjectEntity();
$vars['message'] = thewire_filter((string) $object->description);

$subject = $item->getSubjectEntity();
$subject_link = elgg_view_entity_url($subject, ['class' => 'elgg-river-subject']);

if ($subject instanceof \ElggUser && (bool) $subject->verified_user) {
	$subject_link .= elgg_format_element('span', [
		'class' => 'verified-badge',
		'title' => elgg_echo('verified:account'),
	]);
}

$object_link = elgg_view('output/url', [
	'href' => elgg_generate_url('collection:object:thewire:owner', [
		'username' => (string) $subject->username,
	]),
	'text' => elgg_echo('thewire:wire'),
	'class' => 'elgg-river-object',
	'is_trusted' => true,
]);

$vars['summary'] = elgg_echo('river:object:thewire:create', [$subject_link, $object_link]);

echo elgg_view('river/elements/layout', $vars);
