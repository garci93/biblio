<?php

use yii\bootstrap4\Html;
use yii\widgets\DetailView;

$this->title = 'Ver un género';
$this->params['breadcrumbs'][] = ['label' => 'Géneros', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['breadcrumbs'][] = $model->id;
?>
<div class="generos-view">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'denom'
        ],
    ]) ?>
</div>
