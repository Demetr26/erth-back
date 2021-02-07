<?php

use yii\db\Migration;

/**
 * Class m210206_120353_fill_data
 */
class m210206_120353_fill_data extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $transaction = Yii::$app->db->beginTransaction();
        try {
            $packages = [0 => ['name' => 'Основные'], 1 => ['name' => 'Спорт+'], 2 => ['name' => 'HD'], 3 => ['name' => 'Для взрослых']];
            $genres = [0 => ['name' => 'Кино'], 1 => ['name' => 'Сериалы'], 2 => ['name' => 'Музыка'], 3 => ['name' => 'Спорт']];
            $categories = [0 => ['name' => 'Детские'], 1 => ['name' => 'Взрослые'], 2 => ['name' => 'Умные'], 3 => ['name' => 'Обучающие']];
            $channels = [
                [
                    'title' => 'Первый',
                    'is_hd' => 0,
                ],
                [
                    'title' => 'Россия 1',
                    'is_hd' => 0,
                ],
                [
                    'title' => 'Россия 2',
                    'is_hd' => 0,
                    'age_restriction' => '18+'
                ],
                [
                    'title' => 'Россия 3',
                    'is_hd' => 0,
                ],
                [
                    'title' => 'Биатлон HD',
                    'is_hd' => 0,
                ],
                [
                    'title' => 'National Geographic',
                    'is_hd' => 1,
                ],
                [
                    'title' => 'Двадцать первый',
                    'is_hd' => 1,
                    'age_restriction' => '18+'
                ],
                [
                    'title' => 'НТВ',
                    'is_hd' => 0,
                ],
            ];

            $faker = Faker\Factory::create('ru_RU');
            foreach ($packages as &$package) {
                $oPackage = new \app\modules\api\models\Packages();
                $oPackage->title = $package['name'];
                $oPackage->description = $faker->realText(rand(100, 200));
                $oPackage->insert();
                $package['id'] = $oPackage->id;
            }

            foreach ($genres as &$genre) {
                $oGenre = new \app\modules\api\models\Genres();
                $oGenre->title = $genre['name'];
                $oGenre->insert();
                $genre['id'] = $oGenre->id;
            }

            foreach ($categories as &$category) {
                $oCategory = new \app\modules\api\models\Categories();
                $oCategory->title = $category['name'];
                $oCategory->insert();
                $category['id'] = $oCategory->id;
            }

            foreach ($channels as $i => &$channel) {
                $oChannel = new \app\modules\api\models\Channels();
                $oChannel->title = $channel['title'];
                $oChannel->is_hd = $channel['is_hd'];
                $oChannel->age_restriction = $channel['age_restriction'] ?? null;
                $oChannel->logo = '/uploads/images/logos/' . $i . '.jpg';
                $oChannel->insert();
                $channel['id'] = $oChannel->id;
            }

            // Заполняем связки каналов и пакетов
            foreach ($packages as $i => $package) {
                $targetChannels = [];
                if ($i == 2) { //HD
                    $targetChannels = array_filter($channels, function ($element) {
                        return $element['is_hd'];
                    });
                } elseif ($i == 3) { //Для взрослых
                    $targetChannels = array_filter($channels, function ($element) {
                        return isset($element['age_restriction']);
                    });
                } else { //Остальные
                    $cnt = mt_rand(1, count($channels));
                    $rand_keys = array_rand($channels, $cnt);
                    foreach ((array)$rand_keys as $key) {
                        $targetChannels[] = $channels[$key];
                    }
                }
                foreach ($targetChannels as $target) {
                    $object = new \app\modules\api\models\ChannelPackages();
                    $object->channel_id = $target['id'];
                    $object->package_id = $package['id'];
                    $object->insert();
                }
            }

            // Заполняем связки каналов, жанров и категорий
            // Большая вложенность - зло, но один раз можно
            foreach (['genres', 'categories'] as $dataType) {
                foreach ($$dataType as $data) {
                    $targetChannels = [];
                    $cnt = mt_rand(1, count($channels));
                    $rand_keys = array_rand($channels, $cnt);
                    foreach ((array)$rand_keys as $key) {
                        $targetChannels[] = $channels[$key];
                    }

                    foreach ($targetChannels as $target) {
                        $object = ($dataType === 'genres') ? new \app\modules\api\models\ChannelGenres() : new \app\modules\api\models\ChannelCategories();
                        $object->channel_id = $target['id'];
                        if ($dataType === 'genres')
                            $object->genre_id = $data['id'];
                        else
                            $object->category_id = $data['id'];
                        $object->insert();
                    }
                }
            }
            $times = ['00:00', '01:30', '02:15', '6:00', '10:15', '11:45',
                '13:00', '13:40', '14:50', '15:55', '18:00', '19:25', '21:00',
                '22:35', '23:40', '00:00'];
            // Заполняем программу передач
            for ($i = 0; $i < 15; $i++) {
                $targetDate = date('Y-m-d', time() + (60 * 60 * 24 * ($i - 7)));
                foreach ($channels as $channel) {
                    for ($t = 0; $t < count($times) - 1; $t++) {
                        $oProgramm = new \app\modules\api\models\ChannelProgramm();
                        $oProgramm->channel_id = $channel['id'];
                        $oProgramm->date = $targetDate;
                        $oProgramm->title = $faker->realText(rand(10, 40));
                        $oProgramm->time_start = $targetDate . ' ' . $times[$t].':00';
                        $oProgramm->time_end = $targetDate . ' ' . $times[$t + 1].':00';
                        $oProgramm->insert();
                    }
                }
            }
        }catch(Exception $e){
            $transaction->rollBack();
        }
        $transaction->commit();
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->execute('SET FOREIGN_KEY_CHECKS = 0;');
        $this->truncateTable('channel_categories');
        $this->truncateTable('channel_genres');
        $this->truncateTable('channel_packages');
        $this->truncateTable('channel_programm');
        $this->truncateTable('categories');
        $this->truncateTable('channels');
        $this->truncateTable('genres');
        $this->truncateTable('packages');
        $this->execute('SET FOREIGN_KEY_CHECKS = 1;');
    }

}
