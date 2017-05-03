<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\easyii\helpers\Image;
use yii\easyii\widgets\Redactor;
use yii\helpers\BaseHtml;
use grozzzny\events_manager\widgets\switch_checkbox\SwitchCheckbox;
use yii\easyii\widgets\DateTimePicker;
use kartik\color\ColorInput;

$module = $this->context->module->id;
?>

<?php $form = ActiveForm::begin([
    'enableAjaxValidation' => true,
    'options' => ['enctype' => 'multipart/form-data', 'class' => 'model-form']
]); ?>


<?php if($current_model->preview) : ?>
    <div class="form-group">
        <img src="<?= Image::thumb($current_model->preview, 240) ?>">
    </div>
    <div class="form-group">
        <a href="<?= Url::to([
            '/admin/'.$module.'/a/clear-file',
            'id' => $current_model->id,
            'alias' => $current_model::ALIAS,
            'attribute' => 'preview'
        ]) ?>" class="text-danger confirm-delete" title="<?= Yii::t('easyii', 'Clear image')?>"><?= Yii::t('easyii', 'Clear image')?></a>
    </div>
<?php endif; ?>
<?= $form->field($current_model, 'preview')->fileInput() ?>

<?= $form->field($current_model, 'name') ?>

<div class="row">
    <div class="col-md-4">
        <?= $form->field($current_model, 'color1')->widget(ColorInput::classname(), [
            'options' => ['placeholder' => 'Выберите цвет ...'],
        ]); ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($current_model, 'color2')->widget(ColorInput::classname(), [
            'options' => ['placeholder' => 'Выберите цвет ...'],
        ]); ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($current_model, 'color3')->widget(ColorInput::classname(), [
            'options' => ['placeholder' => 'Выберите цвет ...'],
        ]); ?>
    </div>
</div>

<?= $form->field($current_model, 'soc_vk') ?>
<?= $form->field($current_model, 'soc_fb') ?>
<?= $form->field($current_model, 'soc_inst') ?>

<?= $form->field($current_model, 'datetime')->widget(DateTimePicker::className()); ?>

<?= $form->field($current_model, 'address')->textarea() ?>


<?=SwitchCheckbox::widget([
    'model' => $current_model,
    'attributes' => ['tab']
])?>

<?= $form->field($current_model, 'description')->widget(Redactor::className(),[
    'options' => [
        'minHeight' => 400,
        'imageUpload' => Url::to(['/admin/redactor/upload', 'dir' => $module]),
        'fileUpload' => Url::to(['/admin/redactor/upload', 'dir' => $module]),
        'plugins' => ['fullscreen']
    ]
])?>

<?//= $form->field($current_model, 'audio')->fileInput(['multiple']) ?>
<?php //if($current_model->audio) : ?>
<!--    <div>-->
<!--        <a href="--><?//= $current_model->audio ?><!--" target="_blank">--><?//= basename($current_model->audio) ?><!--</a>-->
<!--        (--><?//= Yii::$app->formatter->asShortSize(filesize(Yii::getAlias('@webroot').$current_model->audio), 2) ?><!--)-->
<!--        <span> / </span>-->
<!--        <a href="--><?//= Url::to([
//            '/admin/'.$module.'/a/clear-file',
//            'id' => $current_model->id,
//            'alias' => $current_model::ALIAS,
//            'attribute' => 'audio'
//        ]) ?><!--" class="text-danger confirm-delete" title="Удалить файл">Удалить файл</a>-->
<!--    </div>-->
<!--    <br>-->
<?php //endif; ?>

<?= $form->field($current_model, 'sort') ?>

<?=SwitchCheckbox::widget([
    'model' => $current_model,
    'attributes' => [
        'slider',
        'home_page',
        'status'
    ]
])?>

<?= Html::submitButton(Yii::t('easyii', 'Save'), ['class' => 'btn btn-primary']) ?>
<?php ActiveForm::end(); ?>
