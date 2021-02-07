<?php
namespace app\components;

use Yii;
use yii\web\Response;
use yii\web\ErrorHandler;
use yii\web\NotFoundHttpException;
use Sentry;

class ApiErrorHandler extends ErrorHandler
{

    protected function renderException($exception) {
        if (Yii::$app->has('response')) {
            $response = Yii::$app->getResponse();
            $response->isSent = false;
            $response->stream = null;
            $response->data = null;
            $response->content = null;
        } else {
            $response = new Response();
        }

        $response->setStatusCode(400);
        $response->data['error'] = $exception->getMessage();

        if($response->data['error'] == "Invalid JSON data in request body: Syntax error."){
            $response->data['error'] = "Не верное тело запроса";
        }
        if($exception instanceof NotFoundHttpException) {
            $response->data = "Bad endpoint";
            $response->setStatusCode(404);
        }

        $response->send();

        // Имитация записи логов ошибок во внешние источники, например, в Sentry
    }
}
