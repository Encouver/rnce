<?php

namespace frontend\controllers;

use Yii;
use common\models\p\PagosAccionistasDecretos;
use app\models\PagosAccionistasDecretosSearch;
use common\components\BaseController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PagosAccionistasDecretosController implements the CRUD actions for PagosAccionistasDecretos model.
 */
class PagosAccionistasDecretosController extends BaseController
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
     * Lists all PagosAccionistasDecretos models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PagosAccionistasDecretosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->sort = false;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PagosAccionistasDecretos model.
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
     * Creates a new PagosAccionistasDecretos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PagosAccionistasDecretos();
         if($model->existeregistro()){
            
            Yii::$app->session->setFlash('error','Usuario no posee un decreto dividiendos en curso');
            return $this->redirect(['decretos-div-excedentes/index']);
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['decretos-div-excedentes/index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing PagosAccionistasDecretos model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
             return $this->redirect(['decretos-div-excedentes/index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing PagosAccionistasDecretos model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

       return $this->redirect(['decretos-div-excedentes/index']);
    }

    /**
     * Finds the PagosAccionistasDecretos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PagosAccionistasDecretos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PagosAccionistasDecretos::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
