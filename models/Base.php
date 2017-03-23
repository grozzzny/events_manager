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
        $models = [];

        foreach (glob(__DIR__ . "/*.php") as $file){
            $file_name = basename($file, '.php');

            if($file_name == 'Base') continue;

            $class_name = 'grozzzny\events_manager\models\\' . $file_name;

            $class = Yii::createObject($class_name);

            if(!$class::PRIMARY_MODEL) continue;

            $models[$class::ALIAS] = $class;
        }

        return $models;
    }

    public static function getModel($alias)
    {
        $models = self::getModels();
        return empty($alias) ? current($models) : $models[$alias];
    }

    public static function queryFilter(&$query, $get)
    {

    }

    /**
     * Проверяет, имеется ли данный валидатор у атрибута или нет
     * @param $validator
     * @param $attribute
     * @return bool
     */
    public function hasValidator($validator, $attribute)
    {
        foreach ($this->rules() as $rule){
            $attributes = is_array($rule[0]) ? $rule[0] : [$rule[0]];

            if(in_array($attribute, $attributes) && $validator == $rule[1]){
                return true;
            }
        }

        return false;
    }
}