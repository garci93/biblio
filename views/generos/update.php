<?php
$this->title = 'Modificar un género';
$this->params['breadcrumbs'][] = ['label' => 'Géneros', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['breadcrumbs'][] = $model->id;
?>
<div class="generos-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
