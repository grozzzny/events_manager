<?
use yii\helpers\Url;
use yii\helpers\Html;
use grozzzny\events_manager\models\Base;

$module = $this->context->module->id;
?>
<table class="table table-hover">
    <thead>
    <tr>
        <th width="50">#</th>
        <th><?= Yii::t('easyii', 'Name') ?></th>
        <th width="100"><?= Yii::t('easyii', 'Status') ?></th>
        <th width="120"></th>
    </tr>
    </thead>
    <tbody>
    <? foreach($data->models as $item) : ?>
        <tr>
            <td><?= $item->primaryKey ?></td>
            <td>
                <a href="<?= Url::to(['/admin/'.$module.'/a/edit', 'id' => $item->id, 'alias' => $item::ALIAS]) ?>">
                    <?= $item->name ?>
                </a>
            </td>
            <td class="status vtop">
                <?= Html::checkbox('', $item->status == Base::STATUS_ON, [
                    'class' => 'my-switch',
                    'data-alias' => $item::ALIAS,
                    'data-id' => $item->id,
                    'data-link' => Url::to(['/admin/'.$module.'/a/']),
                ]) ?>
            </td>
            <td>
                <div class="btn-group btn-group-sm" role="group">
                    <a href="<?= Url::to(['/admin/'.$module.'/a/up', 'id' => $item->primaryKey, 'alias' => $item::ALIAS]) ?>" class="btn btn-default move-up" title="<?= Yii::t('easyii', 'Move up') ?>"><span class="glyphicon glyphicon-arrow-up"></span></a>
                    <a href="<?= Url::to(['/admin/'.$module.'/a/down', 'id' => $item->primaryKey, 'alias' => $item::ALIAS]) ?>" class="btn btn-default move-down" title="<?= Yii::t('easyii', 'Move down') ?>"><span class="glyphicon glyphicon-arrow-down"></span></a>
                    <a href="<?= Url::to(['/admin/'.$module.'/a/delete', 'id' => $item->primaryKey, 'alias' => $item::ALIAS]) ?>" class="btn btn-default confirm-delete" title="<?= Yii::t('easyii', 'Delete item') ?>"><span class="glyphicon glyphicon-remove"></span></a>
                </div>
            </td>
    <? endforeach; ?>
    </tbody>
</table>