<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\FacturaGastos */

$this->title = 'Update Factura Gastos: ' . $model->id_factura_gastos;
$this->params['breadcrumbs'][] = ['label' => 'Factura Gastos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_factura_gastos, 'url' => ['view', 'id' => $model->id_factura_gastos]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="factura-gastos-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
