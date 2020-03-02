<?php

use app\models\Generos;
use yii\bootstrap4\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Libros */

$this->title = 'Create Libros';
$this->params['breadcrumbs'][] = ['label' => 'Libros', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="libros-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'lista' => Generos::lista(),
    ]) ?>

</div>
