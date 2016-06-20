<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\search\FacturaGastosSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="factura-gastos-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_factura_gastos') ?>

    <?= $form->field($model, 'items_id_item') ?>

    <?= $form->field($model, 'apartamentos_id_apartamento') ?>

    <?= $form->field($model, 'fecha_registro') ?>

    <?= $form->field($model, 'iva') ?>

    <?php // echo $form->field($model, 'total') ?>

    <?php // echo $form->field($model, 'descripcion') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
