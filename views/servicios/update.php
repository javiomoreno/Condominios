<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Servicios */

$this->title = 'Modificar Servicio #: ' . $model->id_servicio;
?>
<div class="servicios-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
