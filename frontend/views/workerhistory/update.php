<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\workerhistory */

$this->title = 'Update Workerhistory: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Workerhistories', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="workerhistory-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
