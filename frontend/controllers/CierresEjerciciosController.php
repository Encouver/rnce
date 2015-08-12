<?php

namespace frontend\controllers;

use common\components\BaseController;
use Yii;
use common\models\p\CierresEjercicios;
use common\models\a\ActivosDocumentosRegistrados;
use app\models\CierresEjerciciosSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CierresEjerciciosController implements the CRUD actions for CierresEjercicios model.
 */
class CierresEjerciciosController extends BaseController
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
     * Lists all CierresEjercicios models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CierresEjerciciosSearch();
        $documento= ActivosDocumentosRegistrados::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id,'tipo_documento_id'=>1]);
        if(isset($documento)){
            $searchModel->documento_registrado_id= $documento->id;
        }
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $model= new CierresEjercicios();
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model'=>$model
        ]);
    }
    public function actionModificacion()
    {
        $searchModel = new CierresEjerciciosSearch();
        $documento=$searchModel->Modificacionactual();
        if(isset($documento)){
            $searchModel->documento_registrado_id= $documento->documento_registrado_id;
          
        }
      
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('modificacion', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'documento'=>$documento,
        ]);
    }

    /**
     * Displays a single CierresEjercicios model.
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
     * Creates a new CierresEjercicios model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CierresEjercicios();

         if($model->existeregistro()){
            Yii::$app->session->setFlash('error','Usuario posee una razon social ó debe crear un documento registrado');
            return $this->redirect(['index']);
                }
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
               Yii::$app->session->setFlash('success','Cierre Ejercicio guardado con exito');
                if($model->documentoRegistrado->tipo_documento_id==2){
                                   return $this->redirect(['modificacion']);
                               }
                                return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
    /**
     * Updates an existing CierresEjercicios model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
           Yii::$app->session->setFlash('success','Cierre Ejercicio actualizado con exito');
                  if($model->documentoRegistrado->tipo_documento_id==2){
                                   return $this->redirect(['modificacion']);
                               }
                                return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing CierresEjercicios model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
       if($model->documentoRegistrado->tipo_documento_id==2){
            $model->delete();          
             return $this->redirect(['modificacion']);
        }
         $model->delete();                    

        return $this->redirect(['index']);
    }

    /**
     * Finds the CierresEjercicios model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CierresEjercicios the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CierresEjercicios::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
