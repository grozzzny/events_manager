<?php
use yii\easyii\widgets\Photos;

$this->title = 'Добавить фотографии';
?>

<?= $this->render('_menu', ['current_model' => $current_model]) ?>
<?= $this->render('_submenu', ['current_model' => $current_model]) ?>

<?= Photos::widget(['model' => $current_model])?>