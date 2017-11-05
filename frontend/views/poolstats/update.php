<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Poolstats */

$this->title = 'Update Poolstats: ' . $model->block_number;
$this->params['breadcrumbs'][] = ['label' => 'Poolstats', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->block_number, 'url' => ['view', 'id' => $model->block_number]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="poolstats-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
