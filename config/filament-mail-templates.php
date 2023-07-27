<?php

return [
    'default' => [
        'view' => 'filament-mail-templates::mail.template',
        'to_email' => null,
    ],
    'navigation' => [
        'templates' => [
            'icon' => 'heroicon-o-envelope',
            'group' => 'Mails',
            'shown' => true,
        ],
        'history' => [
            'icon' => 'heroicon-o-inbox',
            'group' => 'Mails',
            'shown' => true,
        ],
    ],
];
