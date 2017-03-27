<?php
namespace grozzzny\events_manager\models;

use yii\easyii\behaviors\CacheFlush;
use Yii;
use yii\easyii\behaviors\SortableModel;

class Base extends \yii\easyii\components\ActiveRecord
{
    use TraitModel;

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

            $class_name = __NAMESPACE__ . '\\' . $file_name;

            if(!class_exists($class_name)) continue;

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
     * Используется при отчистке ранее загруженных файлов
     * @param bool $insert
     * @return bool
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if(!$insert){
                foreach ($this->getAttributes() as $attribute => $value){
                    if($this->hasValidator(['image', 'file'], $attribute)) {
                        if($this->$attribute !== $this->oldAttributes[$attribute]){
                            @unlink(Yii::getAlias('@webroot') . $this->oldAttributes[$attribute]);
                        }
                    }
                }
            }
            return true;
        } else {
            return false;
        }
    }

    /**
     * Используется при отчистке файлов
     */
    public function afterDelete()
    {
        parent::afterDelete();

        foreach ($this->getAttributes() as $attribute => $value){
            if($this->hasValidator(['image', 'file'], $attribute)) {
                @unlink(Yii::getAlias('@webroot').$this->$attribute);
            }
        }
    }
}