<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\search\FacturaServiciosSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="factura-servicios-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_factura_servicios') ?>

    <?= $form->field($model, 'servicios_id_servicio') ?>

    <?= $form->field($model, 'apartamentos_id_apartamento') ?>

    <?= $form->field($model, 'fecha_factura') ?>

    <?= $form->field($model, 'fecha_vencimiento') ?>

    <?php // echo $form->field($model, 'iva') ?>

    <?php // echo $form->field($model, 'total') ?>

    <?php // echo $form->field($model, 'estado') ?>

    <?php // echo $form->field($model, 'observciones') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
