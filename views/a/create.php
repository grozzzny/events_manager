<? $this->title = 'Создать';?>

<?= $this->render('_menu', ['current_model' => $current_model]) ?>

<?= $this->render('_form/'.$current_model::ALIAS, ['current_model' => $current_model]) ?>