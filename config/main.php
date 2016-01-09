<?php

return [
    'modules' => [
        'love' => [
            'class' => 'lo\modules\love\Module',
            //'defaultRoute' => 'aphorism/index'
        ],
    ],

    'components'=>[
        'urlManager'=>[
            'rules'=>[
                //'aphorism/p<page:\d+>' => 'love/aphorism/index',
                'aphorism/<cat:[\w\-]+>' => 'love/aphorism/index',
                'aphorism/<slug:[\w\-]+>' => 'love/aphorism/view',
                'aphorism' => 'love/aphorism/index',

                'love/author/<slug:[\w\-]+>' => 'love/author/view',
                'love/author' => 'love/author/index',
            ]
        ]
    ]

];