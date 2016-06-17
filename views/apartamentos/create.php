<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Apartamentos */

$this->title = 'Create Apartamentos';
$this->params['breadcrumbs'][] = ['label' => 'Apartamentos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="apartamentos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
