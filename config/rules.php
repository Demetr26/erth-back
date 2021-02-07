<?php

return [
    'enablePrettyUrl' => true,
    'enableStrictParsing' => true,
    'showScriptName' => false,
    'rules' => [
        [
            'class' => 'yii\rest\UrlRule',
            'controller' => [
                'api/categories',
                'api/packages',
                'api/genres',
                'api/channels',
            ],
            'pluralize' => false,
        ],
    ],
];
