<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Poolstats */

$this->title = 'Create Poolstats';
$this->params['breadcrumbs'][] = ['label' => 'Poolstats', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="poolstats-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
