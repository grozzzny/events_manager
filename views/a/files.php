<?php
use yii\helpers\Url;
use kartik\file\FileInput;
use yii\widgets\ActiveForm;
use yii\web\JsExpression;

$module = $this->context->module->id;
$this->title = 'Добавить аудиозаписи';
?>

<?= $this->render('_menu', ['current_model' => $current_model]) ?>
<?= $this->render('_submenu', ['current_model' => $current_model]) ?>

<?

$form = ActiveForm::begin([
    'options'=>['enctype'=>'multipart/form-data'] // important
]);

echo  $form->field($files_model, 'file')->widget(FileInput::className(),[
    'name' => 'file[]',
    'language' => 'ru',
    'options' => [
        'multiple' => true,
        'accept' => 'audio/mp3'
    ],
    'pluginOptions' => [
        'previewFileType' => 'any',
        'uploadUrl' => Url::to(['/admin/'.$module.'/a/upload',
            'id' => $current_model->id,
        ]),
    ],
    'pluginEvents' => [
        'fileunlock' => new JsExpression("function () { location.reload() }"),
    ]
]);

ActiveForm::end();
?>

<table class="table">

    <tr>
        <th width="50">#</th>
        <th>Файл</th>
        <th></th>
    </tr>

<? foreach ($current_model->files as $file): ?>
    <tr>
        <td>
            <?=$file->id?>
        </td>
        <td>
            <?=basename(Yii::getAlias('@webroot').$file->file)?>
            (<?=Yii::$app->formatter->asShortSize(filesize(Yii::getAlias('@webroot').$file->file), 2)?>)
            <a href="<?= Url::to([
                '/admin/'.$module.'/a/file-delete',
                'id' => $file->id,
                'attribute' => 'file'
            ]) ?>">
                <i class="glyphicon glyphicon-trash"></i> Удалить
            </a>
        </td>
        <td>
            <audio controls='controls'>
                <source src='<?=$file->file?>' type='audio/mp3' />
            </audio>
        </td>
    </tr>
<? endforeach;?>

</table>
