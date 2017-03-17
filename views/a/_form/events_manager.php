<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\easyii\helpers\Image;

$module = $this->context->module->id;
?>

<?php $form = ActiveForm::begin([
    'enableAjaxValidation' => true,
    'options' => ['enctype' => 'multipart/form-data', 'class' => 'model-form']
]); ?>


<?php if($current_model->logo) : ?>
<div class="form-group">
    <img src="<?= Image::thumb($current_model->logo, 240) ?>">
</div>
<div class="form-group">
    <a href="<?= Url::to([
        '/admin/'.$module.'/a/clear-image',
        'id' => $current_model->id,
        'alias' => $current_model::ALIAS,
        'attribute' => 'logo'
    ]) ?>" class="text-danger confirm-delete" title="<?= Yii::t('easyii', 'Clear image')?>"><?= Yii::t('easyii', 'Clear image')?></a>
</div>
<?php endif; ?>
<?= $form->field($current_model, 'logo')->fileInput() ?>

<?= $form->field($current_model, 'name') ?>
<?= $form->field($current_model, 'link') ?>

<div class="checkbox"><label><?=Html::activeCheckbox($current_model, 'status', ['uncheck' => 0]) ?></label></div>

<?= Html::submitButton(Yii::t('easyii', 'Save'), ['class' => 'btn btn-primary']) ?>
<?php ActiveForm::end(); ?>
