<?php
use yii\helpers\Url;

$action = $this->context->action->id;
$module = $this->context->module->id;
?>

<ul class="nav nav-tabs">
    <li <?= ($action === 'edit') ? 'class="active"' : '' ?>>
        <a href="<?= Url::to(['/admin/'.$module.'/a/edit', 'id' => $current_model->primaryKey, 'alias' => $current_model::ALIAS]) ?>">
            <?= Yii::t('easyii', 'Edit') ?>
        </a>
    </li>


    <? if($current_model::SUBMENU_PHOTOS): ?>
    <li <?= ($action === 'photos') ? 'class="active"' : '' ?>>
        <a href="<?= Url::to(['/admin/'.$module.'/a/photos', 'id' => $current_model->primaryKey, 'alias' => $current_model::ALIAS]) ?>">
            <span class="glyphicon glyphicon-camera"></span>
            <?= Yii::t('easyii', 'Photos') ?>
        </a>
    </li>
    <? endif;?>

    <? if($current_model::SUBMENU_FILES): ?>
        <li <?= ($action === 'files') ? 'class="active"' : '' ?>>
            <a href="<?= Url::to(['/admin/'.$module.'/a/files', 'id' => $current_model->primaryKey, 'alias' => $current_model::ALIAS]) ?>">
                Аудиозаписи
            </a>
        </li>
    <? endif;?>

</ul>
<br>