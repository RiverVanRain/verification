<?php

/* @var $entity ElggPlugin */
$entity = elgg_extract('entity', $vars);

echo elgg_view_field([
    '#type' => 'fieldset',
    'fields' => [
        [
            '#type' => 'checkbox',
            '#label' => elgg_echo('settings:verification:verify_validate_user'),
            '#help' => elgg_echo('settings:verification:verify_validate_user:help'),
            'name' => 'params[verify_validate_user]',
            'checked' => (bool) $entity->verify_validate_user,
            'switch' => true,
        ],
        [
            '#type' => 'checkbox',
            '#label' => elgg_echo('settings:verification:verify_admin'),
            '#help' => elgg_echo('settings:verification:verify_admin:help'),
            'name' => 'params[verify_admin]',
            'checked' => (bool) $entity->verify_admin,
            'switch' => true,
        ],
    ],
]);
