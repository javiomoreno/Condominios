<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\FacturaGastos */

$this->title = 'Nueva Factura de Gastos';
?>
<div class="factura-gastos-create">

    <?= $this->render('_form', [
        'model' => $model, 'modelItems' => $modelItems,
    ]) ?>

</div>
