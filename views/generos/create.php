<?php
$this->title = 'Crear un género';
$this->params['breadcrumbs'][] = ['label' => 'Géneros', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="generos-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
