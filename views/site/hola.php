<?php
use yii\bootstrap4\Html;

var_dump($fila);
?>

<h3>Hola <?= Html::encode($nombre) ?></h3>
<?= Html::a('Acerca de nosotros', ['site/about'], ['class' => 'btn btn-primary']) ?>