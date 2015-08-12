<?php

namespace frontend\controllers;

use common\components\BaseController;
use Yii;
use common\models\p\BancosContratistas;
use common\models\p\Model;
use app\models\BancosContratistasSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BancosContratistasController implements the CRUD actions for BancosContratistas model.
 */
class BancosContratistasController extends BaseController
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
     * Lists all BancosContratistas models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BancosContratistasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single BancosContratistas model.
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
     * Creates a new BancosContratistas model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new BancosContratistas();

        if ($model->load(Yii::$app->request->post())) {
            
            $model->contratista_id=Yii::$app->user->identity->id;
            if($model->tipo_nacionalidad=="EXTRANJERA"){
                $model->tipo_moneda=null;
                $model->tipo_cuenta=null;
            }
            if($model->save()){
                 return $this->redirect(['index']);
            }else{
                Yii::$app->session->setFlash('error','Error en la carga del banco');
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
     * Updates an existing BancosContratistas model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
           if($model->tipo_nacionalidad=="EXTRANJERA"){
                $model->tipo_moneda=null;
                $model->tipo_cuenta=null;
            }
            if($model->save()){
                 return $this->redirect(['index']);
            }else{
                Yii::$app->session->setFlash('error','Error en la carga del banco');
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
     * Deletes an existing BancosContratistas model.
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
     * Finds the BancosContratistas model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BancosContratistas the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BancosContratistas::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
