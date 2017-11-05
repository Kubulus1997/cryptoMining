<?php

namespace frontend\controllers;

use common\models\Gpu;
use Yii;
use common\models\Workerhistory;
use yii\helpers\ArrayHelper;
use common\models\WorkerhistorySearch;
use common\models\workerhistoryQuery;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * WorkerhistoryController implements the CRUD actions for workerhistory model.
 */
class WorkerhistoryController extends Controller
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
     * Lists all workerhistory models.
     * @return mixed
     */
    public function actionIndex()
    {
        $workers = Gpu::find()->all();
        foreach ($workers as $worker){
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://api-zcash.flypool.org/miner/t1MZ9MUkTBQ57x8Rx6AmED9gHD9tqFwHrTp/worker/" . $worker->gpu_name . "/history",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => array(
                    "cache-control: no-cache"
                ),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);
            $response = json_decode($response, true);
            $response = ArrayHelper::toArray($response);
            $array = ArrayHelper::getValue($response,'data');
            foreach ($array as $gpu){
                $time = ArrayHelper::getValue($gpu, 'time');
                $time = date('Y-m-d H:i:s', $time);
                $find = Workerhistory::find()->where(['last_seen' => $time])->andWhere(['gpu_id' => $worker->id])->exists();

                if ($find == false){
                    $model = new workerhistory();
                    $model->last_seen = $time;
                    $averageHashrate = ArrayHelper::getValue($gpu, 'averageHashrate');
                    $model ->average_hashrate = (int)$averageHashrate;
                    $currentHashrate = ArrayHelper::getValue($gpu, 'currentHashrate');
                    $model->current_hashrate = (int)$currentHashrate;
                    $reportedHashrate = ArrayHelper::getValue($gpu, 'reportedHashrate');
                    $model->reported_hashrate = (int)$reportedHashrate;
                    $model->valid_shares = ArrayHelper::getValue($gpu,'validShares');
                    $model->invalid_shares = ArrayHelper::getValue($gpu, 'invalidShares');
                    $model->stale_shares = ArrayHelper::getValue($gpu, 'staleShares');
                    $model->gpu_id = $worker->id;
                    $model->save();
                }
            }


        }





        $searchModel = new workerhistorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single workerhistory model.
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
     * Creates a new workerhistory model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new workerhistory();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing workerhistory model.
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
     * Deletes an existing workerhistory model.
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
     * Finds the workerhistory model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return workerhistory the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = workerhistory::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
