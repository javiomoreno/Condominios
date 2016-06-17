<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\FacturaGastos */

$this->title = 'Create Factura Gastos';
$this->params['breadcrumbs'][] = ['label' => 'Factura Gastos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="factura-gastos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
