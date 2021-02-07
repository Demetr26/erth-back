<?php
return [
    'components' => [
        'request' => [
            'class' => 'yii\web\Request',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ],
            'cookieValidationKey' => 'kDHcpDtnAUG5akDpM2RIQBmUtyHWVvwK',
            'enableCsrfValidation' => false
        ],
        'errorHandler' => [
            'class' => 'app\components\ApiErrorHandler',
            'errorAction' => 'site/error',
        ],
        'response' => [
            'class' => 'yii\web\Response',
            'on beforeSend' => function($event){
                $response = $event->sender;
                $response->headers->set("Access-Control-Allow-Origin","*");
                $response->headers->set("Access-Control-Allow-Headers","accept, content-type, authorization, x-user");
                $response->headers->set("Access-Control-Allow-Methods","POST, GET, PUT, DELETE, OPTIONS");

                $actualStatusCode = $response->statusCode;
                $response->data = [
                    'success' => $response->isSuccessful,
                    'statusCode' => $actualStatusCode,
                    'data' => $response->data
                ];
            },
            'format' => yii\web\Response::FORMAT_JSON,
        ],
    ],
];