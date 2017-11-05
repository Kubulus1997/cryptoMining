<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Poolstats */

$this->title = $model->block_number;
$this->params['breadcrumbs'][] = ['label' => 'Poolstats', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="poolstats-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->block_number], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->block_number], [
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
            'block_number',
            'miner:ntext',
            'time',
        ],
    ]) ?>

</div>
