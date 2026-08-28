<?php
/**
 * PRO upsell content, generated from the plogins.com registry by
 * scripts/gen-pro-upsell.mjs. The admin upsell renders this; curate the
 * feature list to fit this plugin's settings screen (do not invent features).
 *
 * @package plogins-tabby-pro
 */

defined('ABSPATH') || exit;

return [
    'name'       => 'Tabby Pro',
    'url'        => 'https://plogins.com/plogins-tabby-pro/pricing/',
    'sellable'   => true,
    'price_from' => 19,
    'currency'   => 'EUR',
    'lead'       => [
        'en' => 'Category rules, tab order, icons, conditional display and rich content ship today.',
        'pl' => 'Reguły kategorii, kolejność, ikony, warunkowe wyświetlanie i bogata treść są wdrożone.',
    ],
    'features'   => [
        [
            'en' => ['title' => 'Category rules', 'desc' => 'Show a global tab only on products in selected categories (shipped).'],
            'pl' => ['title' => 'Reguły kategorii', 'desc' => 'Pokaż globalną zakładkę tylko na produktach z wybranych kategorii (wdrożone).'],
        ],
        [
            'en' => ['title' => 'Tab ordering', 'desc' => 'Set a numeric sort order for global tabs on the product page (shipped).'],
            'pl' => ['title' => 'Kolejność zakładek', 'desc' => 'Ustaw numeryczną kolejność globalnych zakładek na karcie produktu (wdrożone).'],
        ],
        [
            'en' => ['title' => 'Tab icons', 'desc' => 'Add a dashicon or emoji to each tab label (shipped).'],
            'pl' => ['title' => 'Ikony zakładek', 'desc' => 'Dodaj dashicon lub emoji do etykiety zakładki (wdrożone).'],
        ],
        [
            'en' => ['title' => 'Conditional display', 'desc' => 'Show or hide tabs by stock status or user role (shipped).'],
            'pl' => ['title' => 'Warunkowe wyświetlanie', 'desc' => 'Pokaż lub ukryj zakładki według stanu magazynowego lub roli (wdrożone).'],
        ],
        [
            'en' => ['title' => 'Rich content', 'desc' => 'Shortcodes and blocks inside tab content (shipped).'],
            'pl' => ['title' => 'Bogata treść', 'desc' => 'Shortcode i bloki w treści zakładki (wdrożone).'],
        ],
    ],
];
