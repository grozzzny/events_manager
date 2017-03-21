<?
use yii\helpers\Url;
use yii\helpers\Html;
use grozzzny\events_manager\models\Base;

$module = $this->context->module->id;

$sort = $data->getSort();
?>
<table class="table table-hover">
    <thead>
    <tr>
        <th width="50">
            <?=$sort->link('id');?>
        </th>
        <th><?=$sort->link('name');?></th>
        <th><?=$sort->link('datetime',['label' => 'Дата и время']);?></th>
        <th><?=$sort->link('slider');?></th>
        <th><?=$sort->link('home_page',['label' => 'На главной']);?></th>
        <th width="100"><?=$sort->link('status');?></th>
        <th width="<?= $current_model::SHOW_ORDER_NUM ? '120' : '40'?>"></th>
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
            <td>
                <?=date('d.m.Y H:i',$item->datetime)?>
            </td>
            <td>
                <?= $item->slider == true ? '<i class="glyphicon glyphicon-ok text-success"></i>': ''?>
            </td>
            <td>
                <?= $item->home_page == true ? '<i class="glyphicon glyphicon-ok text-success"></i>': ''?>
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

                    <? if($item::SHOW_ORDER_NUM):?>
                        <a href="<?= Url::to(['/admin/'.$module.'/a/up', 'id' => $item->primaryKey, 'alias' => $item::ALIAS]) ?>" class="btn btn-default move-up" title="<?= Yii::t('easyii', 'Move up') ?>"><span class="glyphicon glyphicon-arrow-up"></span></a>
                        <a href="<?= Url::to(['/admin/'.$module.'/a/down', 'id' => $item->primaryKey, 'alias' => $item::ALIAS]) ?>" class="btn btn-default move-down" title="<?= Yii::t('easyii', 'Move down') ?>"><span class="glyphicon glyphicon-arrow-down"></span></a>
                    <? endif;?>

                    <a href="<?= Url::to(['/admin/'.$module.'/a/delete', 'id' => $item->primaryKey, 'alias' => $item::ALIAS]) ?>" class="btn btn-default confirm-delete" title="<?= Yii::t('easyii', 'Delete item') ?>"><span class="glyphicon glyphicon-remove"></span></a>
                </div>
            </td>
    <? endforeach; ?>
    </tbody>
</table>