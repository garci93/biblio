<?php

use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Lectores */
/* @var $form yii\bootstrap4\ActiveForm */
$js = <<<EOF

$( document ).ready(function() {
  $('#codPostal').keyup(function(){
    if(this.value.length == 5){
      // TODO:
      // $.ajax({});
    }
  });
});
EOF;
$this->registerJs($js);
?>

<div class="lectores-form">

    <?php $form = ActiveForm::begin(['enableAjaxValidation' => true]); ?>

    <?= $form->field($model, 'numero')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'direccion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cod_postal', ['inputOptions' => ['id' => 'codPostal']])->textInput() ?>

    <?= $form->field($model, 'poblacion')->textInput(['maxlength' => true, 'readonly' => true]) ?>

    <?= $form->field($model, 'provincia')->textInput(['maxlength' => true, 'readonly' => true]) ?>

    <?= $form->field($model, 'fecha_nac')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
