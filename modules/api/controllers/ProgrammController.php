<?php


namespace app\modules\api\controllers;


use app\modules\api\models\ChannelProgramm;

class ProgrammController extends \yii\rest\Controller
{

    public function actionFind(){
        $channel_id = \Yii::$app->request->get('channel_id') ?? null;
        $date = \Yii::$app->request->get('date_start') ?? '2021-02-07';

        $query = ChannelProgramm::find();
        $query->date($date);
        if($channel_id)
            $query->channel($channel_id);
        return $query->all();
    }
}
