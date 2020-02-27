<?php

use yii\bootstrap4\Html;
use kartik\datecontrol\DateControl;

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
    ]) ?>

</div>
