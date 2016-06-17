<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\FacturaServicios */

$this->title = 'Update Factura Servicios: ' . $model->id_factura_servicios;
$this->params['breadcrumbs'][] = ['label' => 'Factura Servicios', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_factura_servicios, 'url' => ['view', 'id' => $model->id_factura_servicios]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="factura-servicios-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
