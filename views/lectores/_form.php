<?php

use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Lectores */
/* @var $form yii\bootstrap4\ActiveForm */

$url = Url::to(['lectores/devolver-poblacion-provincia']);
$js = <<<EOF
$( document ).ready(function() {
  $('#lectores-codpostal_id').change(function(){
    if(this.value.length == 5){
        var codpostal = $(this).val();
        console.log(codpostal);
        $.ajax ({
            method: 'GET',
            url: '$url',
            data: { codpostal: codpostal },
            success: 
                function(data){
                    $('#lectores-poblacion').val(data.poblacion);
                    $('#lectores-provincia').val(data.provincia);
                },
        });
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

    <?= $form->field($model, 'poblacion')->textInput(['maxlength' => true, 'readonly' => true]) ?>

    <?= $form->field($model, 'provincia')->textInput(['maxlength' => true, 'readonly' => true]) ?>

    <?= $form->field($model, 'codpostal_id')->textInput() ?>

    <?= $form->field($model, 'fecha_nac')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
