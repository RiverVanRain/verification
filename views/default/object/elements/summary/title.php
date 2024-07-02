<?php
/**
 * Outputs object title
 *
 * @uses $vars['entity'] ElggEntity
 * @uses $vars['title']  Title link (optional) false = no title, '' = default
 */

$title = elgg_extract('title', $vars);
if ($title === false) {
	return;
}

$title = (string) $title;
$entity = elgg_extract('entity', $vars);
if ($title === '' && $entity instanceof \ElggEntity) {
	$title = elgg_get_excerpt((string) $entity->getDisplayName(), 100);
	if (elgg_is_empty($title)) {
		return;
	}
	
	$href = $entity->getURL();
	if (!empty($href)) {
		$title = elgg_view_url($href, $title);
	}
	
	if ((bool) $entity->verified_user) {
		$title .= elgg_format_element('span', [
			'class' => 'verified-badge',
			'title' => elgg_echo('verified:account'),
		]);
	}
}

if (elgg_is_empty($title)) {
	return;
}

echo elgg_format_element('div', ['class' => 'elgg-listing-summary-title'], $title);
