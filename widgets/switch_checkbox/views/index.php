<?php
use yii\helpers\Html;
use yii\helpers\BaseHtml;
?>

<div class="row">
    <div class="col-md-6">
        <ul class="list-group">

            <? foreach ($attributes as $attribute):?>

                <li class="list-group-item">

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
                </li>

            <? endforeach;?>

        </ul>
    </div>
</div>