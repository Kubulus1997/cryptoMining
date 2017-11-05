<?php

namespace frontend\controllers;

use common\models\Gpu;
use common\models\Minerhistory;
use common\models\MinerhistorySearch;
use common\models\Poolstats;
use common\models\Rounds;
use common\models\Workerhistory;
use common\models\WorkerhistorySearch;
use Yii;
use common\models\Transactions;
use common\models\TransactionsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


/**
 * TransactionsController implements the CRUD actions for Transactions model.
 */
class TransactionsController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Transactions models.
     * @return mixed
     */
    public function actionIndex()
    {

        // find the block numbers that have been mined
        $poolStats = Poolstats::find()->all();
        foreach($poolStats as $blockNumber){
            // foreach blocknumber we need to check if that block has been paid out to the miners.
            $miners = Gpu::find()->all();

            foreach($miners as $gpu){
                //foreach gpu check to see if there is a record for that block.
                $number = $blockNumber->block_number;
                $gpu_id = $gpu->id;
                $find = Transactions::find()->where(['block_number' => $number])->andWhere(['gpu_id' => $gpu_id])->exists();
                if ($find == false){
                    // record does not exsist so we must calculate how much the worker is to be paid.
                    // first we must find all the workers that were mining around that block time.
                    $workerHistory = Workerhistory::find()->where(['<= ','last_seen',  $blockNumber->time])->andWhere(['gpu_id' => $gpu_id])->orderBy(['last_seen' => SORT_DESC])->one();
                    $totalHashrate = Minerhistory::find()->where(['<=', 'time' , $blockNumber->time])->one();
                    $totalHashrate = $totalHashrate->current_hashrate;

                    // we divide the workers hashrate by the total to get his percentage of the coin
                    $coinPercentage = $workerHistory->current_hashrate / $totalHashrate;

                    // now we create the transaction making his account current with the amount of coin we will have eventually.
                    // some of the blocks may not have been payed out yet by the mining pool.
                    $round = Rounds::find()->where(['block_number' => $blockNumber->block_number])->one();
                    if ($round != null){
                        $coinTotal = $round->zec;
                    }
                    else
                        $coinTotal = 0;
                    $workersCoin = $coinTotal/$coinPercentage;
                    $model = new Transactions();
                    $model->block_number = $blockNumber->block_number;
                    $model->current_hashrate = $workerHistory->current_hashrate;
                    $model->time = $blockNumber->time;
                    $model->gpu_id = $gpu->id;
                    $model->amount = $workersCoin;
                    $model->type = 'payment';
                    $model->user_id = $gpu->member_id;
                    $model->save();


                }else {


                    // record does not exsist so we must calculate how much the worker is to be paid.
                    // first we must find all the workers that were mining around that block time.
                    $workerHistory = Workerhistory::find()->where(['<= ','last_seen',  $blockNumber->time])->andWhere(['gpu_id' => $gpu_id])->orderBy(['last_seen' => SORT_DESC])->one();
                    $totalHashrate = Minerhistory::find()->where(['<=', 'time' , $blockNumber->time])->one();
                    $totalHashrate = $totalHashrate->current_hashrate;

                    // we divide the workers hashrate by the total to get his percentage of the coin
                    $coinPercentage = $workerHistory->current_hashrate / $totalHashrate;

                    // now we create the transaction making his account current with the amount of coin we will have eventually.
                    // some of the blocks may not have been payed out yet by the mining pool.
                    $round = Rounds::find()->where(['block_number' => $blockNumber->block_number])->one();
                    if ($round != null){
                        $coinTotal = $round->zec;
                    }
                    else
                        $coinTotal = 0;
                    $workersCoin = $coinTotal*$coinPercentage;

                    $transaction = Transactions::find()->where(['block_number' => $blockNumber->block_number])->andWhere(['gpu_id' => $gpu->id])->one();
                    $transaction->user_id = $gpu->member_id;
                    $transaction->amount = $workersCoin;
                    $transaction->current_hashrate = $workerHistory->current_hashrate;
                    $transaction->save();
                }

            }
        }

        $searchModel = new TransactionsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Transactions model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Transactions model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Transactions();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Transactions model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Transactions model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Transactions model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Transactions the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Transactions::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
