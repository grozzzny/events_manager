<?php
namespace grozzzny\events_manager\models;


class EventsManager extends Base
{
    const CACHE_KEY = 'gr_events_manager';

    const TITLE = 'Менеджер событий';
    const ALIAS = 'events_manager';

    const SUBMENU_PHOTOS = true;

    public static function tableName()
    {
        return 'gr_events_manager';
    }

    public function rules()
    {
        return [
            ['id', 'number', 'integerOnly' => true],
            [['name','link'], 'string'],
            ['logo', 'image'],
            ['order_num', 'integer'],
            ['status', 'default', 'value' => self::STATUS_ON],
            ['name', 'required'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Наименование',
            'link' => 'Ссылка',
            'logo' => 'Логотип',
            'status' => 'Активно',
            'order_num' => 'Индекс сортировки'
        ];
    }

    public static function queryFilter(&$query, $get)
    {
        if(!empty($get['name'])){
            $query->andFilterWhere(['LIKE', 'name', $get['name']]);
        }
    }

}