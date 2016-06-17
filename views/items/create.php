<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Items */

$this->title = 'Nuevo Item';
?>
<div class="items-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
