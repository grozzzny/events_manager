<?
use yii\bootstrap\Html;
use yii\helpers\Url;
?>

<?=Html::beginForm(Url::toRoute(['a/', 'alias' => $current_model::ALIAS]), 'get');?>


    <li style="float:right; margin-left: 20px;">
        <?=Html::input('string','name', Yii::$app->request->get('name'),[
            'placeholder'=> 'Поиск...',
            'class'=> 'form-control',
            'onblur' => 'submit();'
        ])?>
    </li>


<?=Html::endForm();?>