<?php
use yii\helpers\Url;

$action = $this->context->action->id;
$module = $this->context->module->id;

$items = [];
foreach ($current_model->models as $model){
    $items[] = [
        'label' => $model::TITLE,
        'url' => ['a/', 'alias' => $model::ALIAS],
        'active' => $model::ALIAS == $current_model::ALIAS,
    ];
}

?>

<?=\yii\bootstrap\Nav::widget([
    'items' => $items,
    'options' => ['class' =>'nav nav-tabs', 'style'=> 'margin-bottom: 30px;']
]);?>



<ul class="nav nav-pills">

    <li <?= ($action === 'index') ? 'class="active"' : '' ?>>
        <a href="<?= Url::to(['/admin/'.$module, 'alias' => $current_model::ALIAS]) ?>">
            <?php if($action != 'index') : ?>
                <i class="glyphicon glyphicon-chevron-left font-12"></i>
            <?php endif; ?>
            <?= Yii::t('easyii', 'List') ?>
        </a>
    </li>
    <li <?= ($action === 'create') ? 'class="active"' : '' ?>>
        <a href="<?= Url::to([
        '/admin/'.$module.'/a/create',
        'alias' => $current_model::ALIAS
        ]) ?>">
            <?= Yii::t('easyii', 'Create') ?>
        </a>
    </li>

    <? if($action === 'index'):?>

        <?= $this->render($current_model::ALIAS.'/_filter', [
            'current_model' => $current_model
        ]) ?>

    <? endif;?>

</ul>
<br/>