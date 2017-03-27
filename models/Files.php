<?php
namespace grozzzny\events_manager\models;


class Files extends \yii\easyii\components\ActiveRecord
{
    use TraitModel;

    const CACHE_KEY = 'gr_events_files';

    const TITLE = 'Файлы событий';
    const ALIAS = 'events_files';

    const PRIMARY_MODEL = false;

    public static function tableName()
    {
        return 'gr_events_files';
    }

    public function rules()
    {
        return [
            ['id', 'number', 'integerOnly' => true],
            [['event_id'], 'integer'],
            [['file'], 'file', 'extensions' => 'mp3', 'maxFiles' => 50],
            [['event_id'], 'required'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'event_id' => 'ID события',
            'file' => 'Файл',
        ];
    }
}
