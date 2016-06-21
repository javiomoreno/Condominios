<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\FacturaServicios */

$this->title = 'Nueva Factura de Servicios';
?>
<div class="factura-servicios-create">

    <?= $this->render('_form', [
        'model' => $model, 'modelServicios' => $modelServicios,
    ]) ?>

</div>
