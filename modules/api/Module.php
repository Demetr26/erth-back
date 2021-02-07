<?php

namespace app\modules\api;

class Module extends \yii\base\Module
{
    public function init()
    {
        \Yii::configure(\Yii::$app, require __DIR__.'/config.php');
        parent::init();
    }
}
