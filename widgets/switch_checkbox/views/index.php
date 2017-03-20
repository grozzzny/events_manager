<?php
use yii\helpers\Html;
use yii\helpers\BaseHtml;
?>

<?
$for = BaseHtml::getInputId($model, $attribute);
$label = $model->getAttributeLabel($attribute);
?>

<?=$label?>
<div class="material-switch pull-right">
    &nbsp;
    <?=Html::activeCheckbox($model, $attribute, ['uncheck' => 0, 'label' => false])?>
    <?=Html::label('', $for, ['class' => 'label-success'])?>
</div>