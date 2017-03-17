<?php
namespace grozzzny\events_manager\models;

use yii\easyii\behaviors\CacheFlush;
use Yii;
use yii\easyii\behaviors\SortableModel;

class Base extends \yii\easyii\components\ActiveRecord
{
    const STATUS_OFF = 0;
    const STATUS_ON = 1;

    public function behaviors()
    {
        return [
            CacheFlush::className(),
            SortableModel::className()
        ];
    }

    public function getModels()
    {
        return [
            EventsManager::ALIAS => Yii::createObject(EventsManager::className())
        ];
    }

    public static function getModel($alias)
    {
        $models = self::getModels();
        return empty($alias) ? current($models) : $models[$alias];
    }

    public static function getAttributesImage()
    {
        return ['preview', 'photo', 'logo', 'icon'];
    }

    public static function queryFilter(&$query, $get)
    {

    }
}