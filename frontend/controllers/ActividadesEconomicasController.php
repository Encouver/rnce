<?php

namespace frontend\controllers;

use Yii;
use common\models\p\ActividadesEconomicas;
use common\models\a\ActivosDocumentosRegistrados;
use app\models\ActividadesEconomicasSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ActividadesEconomicasController implements the CRUD actions for ActividadesEconomicas model.
 */
class ActividadesEconomicasController extends Controller
{
    public function behaviors()
    {
        return array_merge(parent::behaviors(),[
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ]);
    }

    /**
     * Lists all ActividadesEconomicas models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ActividadesEconomicasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $model = new ActividadesEconomicas();
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model'=>$model
        ]);
    }

    /**
     * Displays a single ActividadesEconomicas model.
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
     * Creates a new ActividadesEconomicas model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ActividadesEconomicas();

         if($model->existeregistro()){
            Yii::$app->session->setFlash('error','Usuario posee actividades economicas ó debe crear un documento registrado');
            return $this->redirect(['index']);
                }
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
               Yii::$app->session->setFlash('success','Actividad Economica guardada con exito');
                    return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
    

    /**
     * Updates an existing ActividadesEconomicas model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
             Yii::$app->session->setFlash('success','Actividad Economica actualizada con exito');
                    return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing ActividadesEconomicas model.
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
     * Finds the ActividadesEconomicas model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ActividadesEconomicas the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ActividadesEconomicas::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
