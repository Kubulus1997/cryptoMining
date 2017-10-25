<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Minerhistory */

$this->title = 'Update Minerhistory: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Minerhistories', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="minerhistory-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
