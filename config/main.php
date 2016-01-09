<?php

return [
    'modules' => [
        'love' => [
            'class' => 'lo\modules\love\Module',
            'defaultRoute' => 'aphorism/index'
        ],
    ],

    'components'=>[
        'urlManager'=>[
            'rules'=>[
                'aphorism/<cat:[\w\-]+>' => 'love/aphorism/category',
                'aphorism/<slug:[\w\-]+>' => 'love/aphorism/view',
                'aphorism/p<page:\d+>' => 'love/aphorism/index',
                'aphorism' => 'love/aphorism/index',
            ]
        ]
    ]

];