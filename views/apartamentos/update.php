<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Apartamentos */

$this->title = 'Modificar Apartamento #: ' . $model->id_apartamento;
?>
<div class="apartamentos-update">

    <?= $this->render('_form', [
        'model' => $model, 'model2' => $model2,
    ]) ?>

</div>
