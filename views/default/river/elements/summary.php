<?php
/**
 * Short summary of the action that occurred
 *
 * @vars['item'] ElggRiverItem
 */

$item = elgg_extract('item', $vars);
if (!$item instanceof ElggRiverItem) {
	return;
}

$subject = $item->getSubjectEntity();
if (!$subject instanceof ElggEntity) {
	return;
}

$object = $item->getObjectEntity();
if (!$object instanceof ElggEntity) {
	return;
}

$subject_link = elgg_view_entity_url($subject, ['class' => 'elgg-river-subject']);

if ($subject instanceof \ElggUser && (bool) $subject->verified_user) {
	$subject_link .= elgg_format_element('span', [
		'class' => 'verified-badge',
		'title' => elgg_echo('verified:account'),
	]);
}

$object_link = elgg_view('output/url', [
	'href' => $object->getURL(),
	'text' => elgg_get_excerpt($object->getDisplayName(), 100),
	'class' => 'elgg-river-object',
	'is_trusted' => true,
]);

if ($object instanceof \ElggUser && (bool) $object->verified_user) {
	$object_link .= elgg_format_element('span', [
		'class' => 'verified-badge',
		'title' => elgg_echo('verified:account'),
	]);
}

$action = $item->action_type;
$type = $item->type;
$subtype = $item->subtype;

// if activity happened in a group
$group_string = '';
$container = $object->getContainerEntity();
if ($container instanceof ElggGroup && $container->guid != elgg_get_page_owner_guid()) {
	$group_link = elgg_view('output/url', [
		'href' => $container->getURL(),
		'text' => $container->getDisplayName(),
		'is_trusted' => true,
	]);
	$group_string = elgg_echo('river:ingroup', [$group_link]);
}

// check summary translation keys
$key = false;
$keys = [
	"river:{$type}:{$subtype}:{$action}",
	"river:{$type}:{$subtype}:default",
	"river:{$type}:{$action}",
	"river:{$type}:default",
];
foreach ($keys as $try_key) {
	if (elgg_language_key_exists($try_key)) {
		$key = $try_key;
		break;
	}
}
// try the old translation keys
if ($key === false) {
	$deprecated_keys = [
		"river:$action:$type:$subtype",
		"river:$action:$type:default",
	];
	foreach ($deprecated_keys as $try_key) {
		if (elgg_language_key_exists($try_key)) {
			$key = $try_key;

			$notice = "Please update your river language key: '{$try_key}', suggested new key 'river:{$type}:{$subtype}:{$action}'.";
			$notice .= " See views/default/river/elements/summary";
			elgg_deprecated_notice($notice, '3.0');
			break;
		}
	}
}
$summary = '';
if ($key !== false) {
	$summary = elgg_echo($key, [$subject_link, $object_link]);
}

echo trim("$summary $group_string");