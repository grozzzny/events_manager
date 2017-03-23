<? $this->title = 'Создать';?>

<?= $this->render('_menu', ['current_model' => $current_model]) ?>

<?= $this->render($current_model::ALIAS.'/_form', ['current_model' => $current_model]) ?>