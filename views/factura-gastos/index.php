<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\FacturaGastosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Factura Gastos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="factura-gastos-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Factura Gastos', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_factura_gastos',
            'apartamentos_id_apartamento',
            'fecha_registro',
            'iva',
            // 'total',
            // 'descripcion',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
