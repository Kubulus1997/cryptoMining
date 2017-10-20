<?php

namespace backend\controllers;

use common\models\PayoutsQuery;
use common\models\PayoutsSearch;
use Yii;
use common\models\Payouts;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\i18n\Formatter;

/**
 * PayoutsController implements the CRUD actions for Payouts model.
 */
class PayoutsController extends Controller
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
     * Lists all Payouts models.
     * @return mixed
     */
    public function actionIndex()
    {

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api-zcash.flypool.org/miner/t1MZ9MUkTBQ57x8Rx6AmED9gHD9tqFwHrTp/payouts",
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

        foreach ($array as $payOut){
            $find = false;
            $trxHash = ArrayHelper::getValue($payOut,'txHash');
            $find = Payouts::find()->where(['tx_hash' => $trxHash])->exists();

            if ($find == null){
                $model = new Payouts();
                $model->tx_hash = $trxHash;
                $model->start_block = ArrayHelper::getValue($payOut, 'start');
                $model->end_block = ArrayHelper::getValue($payOut, 'end');
                $model->amount = ArrayHelper::getValue($payOut, 'amount');
                $timeStamp = ArrayHelper::getValue($payOut, 'paidOn');
                $timeStamp = Yii::$app->formatter->asDatetime($timeStamp, 'yyyy-MM-dd hh:mm');
                $model->paid_on = $timeStamp;
                $model->save();
            }
        }

        $searchModel = new PayoutsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Payouts model.
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
     * Creates a new Payouts model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Payouts();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Payouts model.
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
     * Deletes an existing Payouts model.
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
     * Finds the Payouts model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Payouts the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Payouts::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
