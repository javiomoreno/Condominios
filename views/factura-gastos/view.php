<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\FacturaGastos */

$this->title = $model->id_factura_gastos;
$this->params['breadcrumbs'][] = ['label' => 'Factura Gastos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="factura-gastos-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_factura_gastos], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_factura_gastos], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_factura_gastos',
            'items_id_item',
            'apartamentos_id_apartamento',
            'fecha_registro',
            'iva',
            'total',
            'descripcion',
        ],
    ]) ?>

</div>
