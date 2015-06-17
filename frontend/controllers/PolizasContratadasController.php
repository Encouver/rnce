<?php

namespace frontend\controllers;

use Yii;
use common\models\p\PolizasContratadas;
use app\models\PolizasContratadasSearch;
use common\components\BaseController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\p\PersonasJuridicas;

/**
 * PolizasContratadasController implements the CRUD actions for PolizasContratadas model.
 */
class PolizasContratadasController extends BaseController
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
     * Lists all PolizasContratadas models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PolizasContratadasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PolizasContratadas model.
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
     * Creates a new PolizasContratadas model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PolizasContratadas();
  $modelJuridica= new PersonasJuridicas();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
             
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
                'modelJuridica'=>$modelJuridica,
            ]);
        }
    }

    /**
     * Updates an existing PolizasContratadas model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
         $model = $this->findModel($id);
         $modelJuridica= new PersonasJuridicas();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
                'modelJuridica'=>$modelJuridica,
            ]);
        }
    }

    /**
     * Deletes an existing PolizasContratadas model.
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
     * Finds the PolizasContratadas model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PolizasContratadas the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PolizasContratadas::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
