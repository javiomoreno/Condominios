<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\FacturaServiciosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Factura Servicios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="factura-servicios-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Factura Servicios', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_factura_servicios',
            'servicios_id_servicio',
            'apartamentos_id_apartamento',
            'fecha_factura',
            'fecha_vencimiento',
            // 'iva',
            // 'total',
            // 'estado',
            // 'observciones',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
