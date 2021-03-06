<?php
/**
 * Outputs object title
 *
 * @uses $vars['entity']    ElggEntity
 * @uses $vars['title']     Title link (optional) false = no title, '' = default
 */

$title = elgg_extract('title', $vars, '');
if ($title === false) {
	return;
}

$entity = elgg_extract('entity', $vars);
if ($title === '' && $entity instanceof ElggEntity) {
	$title = elgg_view('output/url', [
		'text' => elgg_get_excerpt($entity->getDisplayName(), 100),
		'href' => $entity->getURL() ?: false,
	]);
	
	if ($entity instanceof \ElggUser && (bool) $entity->verified_user) {
		$title .= elgg_format_element('span', [
			'class' => 'verified-badge',
			'title' => elgg_echo('verified:account'),
		]);
	}
}

echo elgg_format_element('div', [
	'class' => [
		'elgg-listing-summary-title',
	]
], elgg_format_element('h3', [], $title));
