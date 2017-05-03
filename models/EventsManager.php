<?php
namespace grozzzny\events_manager\models;

use Yii;
use yii\easyii\models\Photo;

class EventsManager extends Base
{
    const CACHE_KEY = 'gr_events_manager';

    const TITLE = 'Менеджер событий';
    const ALIAS = 'events_manager';

    const SUBMENU_PHOTOS = true;
    const SUBMENU_FILES = true;
    const SHOW_ORDER_NUM = false;
    const PRIMARY_MODEL = true;

    const SLIDER_OFF = 0;
    const SLIDER_ON = 1;

    const TAB_OFF = 0;
    const TAB_ON = 1;

    const HOME_PAGE_OFF = 0;
    const HOME_PAGE_ON = 1;


    public $audioFiles;

    public $months = ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'];
    public $months_d = ['Января', 'Февраля', 'Марта', 'Апреля', 'Мая', 'Июня', 'Июля', 'Августа', 'Сентября', 'Октября', 'Ноября', 'Декабря'];

    public static function tableName()
    {
        return 'gr_events_manager';
    }

    public function rules()
    {
        return [
            ['id', 'number', 'integerOnly' => true],
            [['name', 'address','color1','color2','color3'], 'string'],
            ['preview', 'image'],
            [['datetime','order_num'], 'integer'],
            ['description', 'safe'],
//            ['audio', 'file', 'mimeTypes' => ['audio/mp3']],
            ['status', 'default', 'value' => self::STATUS_ON],
            ['slider', 'default', 'value' => self::SLIDER_OFF],
            ['tab', 'default', 'value' => self::TAB_OFF],
            ['home_page', 'default', 'value' => self::HOME_PAGE_ON],
            [['soc_vk', 'soc_fb', 'soc_inst'], 'url'],
            ['name', 'required'],
            [['sort'], 'integer'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Наименование',
            'datetime' => 'Дата и время мероприятия',
            'preview' => 'Превью мероприятия',
            'soc_vk' => 'Ссылка на VK',
            'soc_fb' => 'Ссылка на FACEBOOK',
            'soc_inst' => 'Ссылка на INSTAGRAM',
            'address' => 'Место проведения мероприятия',
            'description' => 'Описание',
            'slider' => 'Слайдер на главной',
            'home_page' => 'Размещение на главной',
            'order_num' => 'Индекс сортировки',
            'sort' => 'Индекс сортировки',
            'tab' => 'Описание',
            'audio' => 'Аудиозапись',
            'status' => 'Состояние',
            'color1' => 'Цвет №1',
            'color2' => 'Цвет №2',
            'color3' => 'Цвет №3',
        ];
    }

    public static function queryFilter(&$query, $get)
    {
        if(!empty($get['name'])){
            $query->andFilterWhere(['LIKE', 'name', $get['name']]);
        }

        if(!empty($get['month']) || $get['month'] === 0){
            $query->andFilterWhere(["FROM_UNIXTIME(datetime, '%c')" => $get['month']+1]);
        }

        if(!empty($get['year'])){
            $query->andFilterWhere(["FROM_UNIXTIME(datetime, '%Y')" => $get['year']]);
        }
    }

    public static function querySort(&$provider)
    {
        $sort = [];

        $attributes = [
            'id',
            'name',
            'datetime',
            'slider',
            'home_page',
            'status'
        ];

        if(self::SHOW_ORDER_NUM){
            $sort = $sort + ['defaultOrder' => ['order_num' => SORT_DESC]];
            $attributes = $attributes + ['order_num'];
        }

        $sort = $sort + ['attributes' => $attributes] + ['defaultOrder' => ['id' => SORT_DESC]];

        $provider->setSort($sort);
    }

    /**
     * Список годов
     * @return array
     */
    public static function getYears()
    {
        $years = Yii::$app->cache->getOrSet('years', function () {

            $years = [];
            foreach (EventsManager::find()->where(['status' => EventsManager::STATUS_ON])->all() as $event){
                $years[$event->year] = $event->id;
            }
            $years = array_flip ($years);

            arsort ($years);

            return $years;

        }, 86400);

        return $years;
    }


    public function getYear()
    {
        return date('Y',$this->datetime);
    }

    public function getDate1()
    {
        $day = date('d',$this->datetime);
        $month = $this->months_d[date('n',$this->datetime)-1];

        return $day . ' <span class="month">' . $month . ' </span>';
    }

    public function getDate2()
    {
        $day = date('d',$this->datetime);
        $month = $this->months_d[date('n',$this->datetime)-1];
        $year_and_time = date('Y, H:i',$this->datetime);

        return $day . ' ' . $month . ' ' . $year_and_time;
    }

    public function getDate3()
    {
        $day = date('d',$this->datetime);
        $month = $this->months_d[date('n',$this->datetime)-1];
        $year_and_time = date('H:i',$this->datetime);

        return $day . ' ' . $month . ' ' . $year_and_time;
    }

    public function getFiles()
    {
        return $this->hasMany(Files::className(), ['event_id' => 'id']);
    }

    public function getAllFiles()
    {
        return Files::find()->all();
    }


    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes); // TODO: Change the autogenerated stub

        Yii::$app->cache->offsetUnset('years');
    }

    public function getPhotos()
    {
        return $this->hasMany(Photo::className(), ['item_id' => 'id'])->where(['class' => self::className()])->sort();
    }

}
