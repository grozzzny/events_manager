<?
use yii\bootstrap\BootstrapPluginAsset;
use grozzzny\events_manager\assets\ModuleAsset;

BootstrapPluginAsset::register($this);
ModuleAsset::register($this);
?>

<? $this->title = 'Редактировать';?>

<?= $this->render('_menu', ['current_model' => $current_model]) ?>

<?= $this->render('_submenu', ['current_model' => $current_model]) ?>

<?= $this->render($current_model::ALIAS.'/_form', ['current_model' => $current_model]) ?>
