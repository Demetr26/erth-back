<?php


namespace app\modules\api\controllers;


use app\modules\api\models\ChannelCategories;
use app\modules\api\models\ChannelPackages;
use app\modules\api\models\ChannelProgramm;
use app\modules\api\models\Channels;

class ProgrammController extends \yii\rest\Controller
{

    public function actionFind(){
        $channel_id = \Yii::$app->request->get('channel_id') ?? null;
        $categories_id = \Yii::$app->request->get('categories') ?? null;
        $packages_id = \Yii::$app->request->get('packages') ?? null;
        $date = \Yii::$app->request->get('date');
        if(!$date)
             $date = date('Y-m-d');

        $result = Channels::find()->asArray()->all();
        $query = ChannelProgramm::find();
        $query->date($date);
        $channels = [];
        $channelPackages = [];

        if($channel_id)
            $query->channel($channel_id);
        elseif($categories_id) {
            $categories_id = explode(',',$categories_id);
            $channels = ChannelCategories::find()->select('channel_id')->andWhere(['category_id' => $categories_id])->column();
        }
        if($packages_id) {
            $packages_id = explode(',',$packages_id);
            $channelPackages = ChannelPackages::find()->select('channel_id')->andWhere(['package_id' => $packages_id])->column();
        }
        if(count($channelPackages) && count($channels))
            $channels = array_intersect($channelPackages, $channels);

        if(count($channels) || count($channelPackages)){
            $channel_ids = count($channels) ? $channels : $channelPackages;
            $query->channels($channel_ids);
        }
        $program = $query->all();

        array_walk($result, function(&$channel) use($program){
           $channel['items'] = array_values(array_filter($program, function($item) use ($channel){
               return $item['channel_id'] == $channel['id'];
           }));
        });

        // Очищаем не используемые
        $result = array_values(array_filter($result, function($item){
            return count($item['items']) > 0;
        }));
        return $result;
    }
}
