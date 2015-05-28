<?php

namespace frontend\controllers;

use Yii;
use common\models\p\PrincipiosContables;
use app\models\PrincipiosContablesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PrincipiosContablesController implements the CRUD actions for PrincipiosContables model.
 */
class PrincipiosContablesController extends Controller
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
     * Lists all PrincipiosContables models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PrincipiosContablesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $model = new PrincipiosContables();
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model'=>$model
        ]);
    }

    /**
     * Displays a single PrincipiosContables model.
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
     * Creates a new PrincipiosContables model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PrincipiosContables();
        if($model->existeregistro()){
             Yii::$app->session->setFlash('error','Contratista posee un principio contable asociado');
                 return $this->redirect(['index']);
        }
        if ($model->load(Yii::$app->request->post())) {
            if($model->codigo_sudeaseg==''){
                $model->codigo_sudeaseg=null;
            }
            if($model->save()){
                Yii::$app->session->setFlash('success','Principio Contable agregado con exito');
                 return $this->redirect(['index']);
            }else{
                Yii::$app->session->setFlash('error','Error en la carga');
                return $this->render('create', [
                'model' => $model,
                ]);
            }
           
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing PrincipiosContables model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            if($model->codigo_sudeaseg==''){
                $model->codigo_sudeaseg=null;
            }
            if($model->save()){
                Yii::$app->session->setFlash('success','Principio Contable actualizado con exito');
                 return $this->redirect(['index']);
            }else{
                Yii::$app->session->setFlash('error','Error en la carga');
                return $this->render('update', [
                'model' => $model,
                ]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing PrincipiosContables model.
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
     * Finds the PrincipiosContables model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PrincipiosContables the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PrincipiosContables::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
