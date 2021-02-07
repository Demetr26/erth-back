<?php


namespace app\modules\api\controllers;


use app\modules\api\models\ChannelProgramm;
use app\modules\api\models\Channels;

class ProgrammController extends \yii\rest\Controller
{

    public function actionFind(){
        $channel_id = \Yii::$app->request->get('channel_id') ?? null;
        $date = \Yii::$app->request->get('date_start') ?? '2021-02-08';

        $result = Channels::find()->asArray()->all();
        $query = ChannelProgramm::find();
        $query->date($date);
        if($channel_id)
            $query->channel($channel_id);
        $program = $query->all();
        array_walk($result, function(&$channel) use($program){
           $channel['items'] = array_values(array_filter($program, function($item) use ($channel){
               return $item['channel_id'] == $channel['id'];
           }));
        });

        return $result;
    }
}
