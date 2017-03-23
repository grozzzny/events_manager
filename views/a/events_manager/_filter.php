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

    <li style="float:right; margin-left: 20px;">
        <?=Html::dropDownList('year', Yii::$app->request->get('year'),
            $current_model::getYears()
            , [
                'onchange' => 'submit();',
                'class'=> 'form-control',
                'prompt' => 'Год'
            ]) ?>
    </li>


    <li style="float:right; margin-left: 20px;">
        <?=Html::dropDownList('month', Yii::$app->request->get('month'),
            $current_model->months
            , [
                'onchange' => 'submit();',
                'class'=> 'form-control',
                'prompt' => 'Месяц'
            ]) ?>
    </li>

<?=Html::endForm();?>