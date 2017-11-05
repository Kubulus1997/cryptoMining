<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\MinerhistorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Minerhistories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="minerhistory-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Minerhistory', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'gpu_id',
            'time',
            'current_hashrate',
            'valid_shares',
            'invalid_shares',

            'stale_shares',
            'average_hashrate',
            // 'active_workers',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
