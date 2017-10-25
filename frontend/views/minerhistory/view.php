<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Minerhistory */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Minerhistories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="minerhistory-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
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
            'id',
            'time',
            'current_hashrate',
            'valid_shares',
            'invalid_shares',
            'stale_shares',
            'average_hashrate',
            'active_workers',
        ],
    ]) ?>

</div>
