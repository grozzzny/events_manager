<?php
use yii\bootstrap\BootstrapPluginAsset;
use grozzzny\events_manager\assets\ModuleAsset;

BootstrapPluginAsset::register($this);
ModuleAsset::register($this);

$this->title = $current_model::TITLE;

?>

<?= $this->render('_menu', ['current_model' => $current_model]) ?>

<? if($data->count > 0) : ?>

    <?= $this->render('_list/'.$current_model::ALIAS, [
        'data' => $data
    ]) ?>

    <?= yii\widgets\LinkPager::widget([
        'pagination' => $data->pagination
    ]) ?>

<? else : ?>
    <p><?= Yii::t('easyii', 'No records found') ?></p>
<? endif; ?>