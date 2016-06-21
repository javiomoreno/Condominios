<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Apartamentos */

$this->title = 'Nuevo Apartamento';
?>
<div class="apartamentos-create">

    <?= $this->render('_form', [
        'model' => $model, 'model2' => $model2,
    ]) ?>

</div>
