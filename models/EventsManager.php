<?php
namespace grozzzny\events_manager\models;


class EventsManager extends Base
{
    const CACHE_KEY = 'gr_events_manager';

    const TITLE = 'Менеджер событий';
    const ALIAS = 'events_manager';

    const SLIDER_OFF = 0;
    const SLIDER_ON = 1;

    const HOME_PAGE_OFF = 0;
    const HOME_PAGE_ON = 1;

    const SUBMENU_PHOTOS = false;
    const SHOW_ORDER_NUM = false;

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
            [['name', 'address'], 'string'],
            ['preview', 'image'],
            [['datetime','order_num'], 'integer'],
            ['description', 'safe'],
            ['status', 'default', 'value' => self::STATUS_ON],
            ['slider', 'default', 'value' => self::SLIDER_OFF],
            ['home_page', 'default', 'value' => self::HOME_PAGE_ON],
            [['soc_vk', 'soc_fb', 'soc_inst'], 'url'],
            ['name', 'required'],
            [['sort'], 'integer']
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
            'status' => 'Состояние'
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

        $sort = $sort + ['attributes' => $attributes];

        $provider->setSort($sort);
    }

    /**
     * Список годов
     * @return array
     */
    public static function getYears()
    {
        $year = date('Y')-5;
        $years = [];
        for($x=0;$x<7;$x++){
            $year++;
            $years[$year] = $year;
        }

        return $years;
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

}