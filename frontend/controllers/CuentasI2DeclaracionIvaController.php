<?php

namespace frontend\controllers;

use Yii;
use common\models\c\CuentasI2DeclaracionIva;
use app\models\CuentasI2DeclaracionIvaSearch;
use common\components\BaseController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CuentasI2DeclaracionIvaController implements the CRUD actions for CuentasI2DeclaracionIva model.
 */
class CuentasI2DeclaracionIvaController extends BaseController
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all CuentasI2DeclaracionIva models.
     * @return mixed
     */
    public function actionIndex()
    {
        $model = new CuentasI2DeclaracionIva();
        $searchModel = new CuentasI2DeclaracionIvaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'model' => $model,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CuentasI2DeclaracionIva model.
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
     * Creates a new CuentasI2DeclaracionIva model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CuentasI2DeclaracionIva();
        $model->inicializar();
        $searchModel = new CuentasI2DeclaracionIvaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $models = $dataProvider->getModels();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model, 'dataProvider'=>$dataProvider,
            ]);
        }
    }
    public function actionBatchUpdate()
    {
        $sourceModel = new CuentasI2DeclaracionIva();
        $sourceModel->inicializar();
        $sourceModel->isNewRecord = false;
        $searchModel = new CuentasI2DeclaracionIvaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $models = $dataProvider->getModels();


        if (CuentasI2DeclaracionIva::loadMultiple($models, Yii::$app->request->post()) && CuentasI2DeclaracionIva::validateMultiple($models)) {
            $count = 0;
            foreach ($models as $index => $model) {
                // populate and save records for each model
                if ($model->save()) {
                    $count++;
                }
            }
            Yii::$app->session->setFlash('success', "Processed {$count} records successfully.");
            return $this->redirect(['index']); // redirect to your next desired page
        } else {
            return $this->render('update', [
                'model'=>$sourceModel,
                'dataProvider'=>$dataProvider
            ]);
        }
    }
    /**
     * Updates an existing CuentasI2DeclaracionIva model.
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
     * Deletes an existing CuentasI2DeclaracionIva model.
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
     * Finds the CuentasI2DeclaracionIva model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CuentasI2DeclaracionIva the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CuentasI2DeclaracionIva::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
