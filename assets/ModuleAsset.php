<?php
namespace grozzzny\events_manager\assets;

class ModuleAsset extends \yii\web\AssetBundle
{
    public $sourcePath = '@grozzzny/events_manager/media';

    public $css = [];

    public $js = [
        'js/admin_module.js'
    ];

    public $jsOptions = array(
        'position' => \yii\web\View::POS_HEAD
    );
}
