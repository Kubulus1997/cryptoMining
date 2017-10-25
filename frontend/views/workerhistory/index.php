<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\workerhistorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Workerhistories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="workerhistory-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Workerhistory', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'last_seen',
            'reported_hashrate',
            'average_hashrate',
            'current_hashrate',
            'valid_shares',
            // 'invalid_shares',
            // 'stale_shares',
            // 'gpu_id',
            // 'id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
