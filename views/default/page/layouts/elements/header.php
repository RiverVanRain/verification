<?php

/**
 * Header for layouts
 *
 * @uses $vars['title']  Title
 * @uses $vars['header'] Optional override for the header
 */

$header = elgg_extract('header', $vars);
unset($vars['header']);

if (!isset($header)) {
    $title = elgg_extract('title', $vars, '');
    unset($vars['title']);

    if ($title) {
        $title_head = elgg_view_title($title, ['class' => 'elgg-heading-main']);

        $entity = elgg_extract('entity', $vars);

        if ($entity instanceof \ElggUser && $entity->verified_user) {
            $title_head = elgg_format_element('h1', ['class' => 'elgg-heading-main'], $title . elgg_format_element('span', [
                'class' => 'verified-badge',
                'title' => elgg_echo('verified:account'),
            ]));
        }
    }

    $menu_params = $vars;
    $menu_params['sort_by'] = 'priority';
    $menu_params['class'] = 'elgg-menu-hz';

    $buttons = elgg_view_menu('title', $menu_params);

    $header = $title_head . $buttons;
}

if (empty($header)) {
    return;
}

echo elgg_format_element('div', ['class' => ['elgg-head', 'elgg-layout-header']], $header);
