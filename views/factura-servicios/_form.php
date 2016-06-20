<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\FacturaServicios */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="factura-servicios-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'servicios_id_servicio')->textInput() ?>

    <?= $form->field($model, 'apartamentos_id_apartamento')->textInput() ?>

    <?= $form->field($model, 'fecha_factura')->textInput() ?>

    <?= $form->field($model, 'fecha_vencimiento')->textInput() ?>

    <?= $form->field($model, 'iva')->textInput() ?>

    <?= $form->field($model, 'total')->textInput() ?>

    <?= $form->field($model, 'estado')->textInput() ?>

    <?= $form->field($model, 'observciones')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
