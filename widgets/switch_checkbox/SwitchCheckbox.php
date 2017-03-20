<?php
namespace grozzzny\events_manager\widgets\switch_checkbox;

use yii\base\Widget;
use grozzzny\events_manager\widgets\switch_checkbox\assets\SwitchCheckboxAsset;

class SwitchCheckbox extends Widget
{

    public $model;
    public $attribute;

    /**
     * Инициализация виджита
     */
    public function init()
    {
        parent::init();
        $this->registerAssets();
    }

    /**
     * Метод run выводит HTML
     * @return string
     */
    public function run()
    {

        return $this->render('index', [
            'model' => $this->model,
            'attribute' => $this->attribute
        ]);
    }

    /**
     * Регистрация assets (Файлы относящие к виджету CSS, JS)
     */
    public function registerAssets()
    {
        $view = $this->getView();
        SwitchCheckboxAsset::register($view);
    }



}