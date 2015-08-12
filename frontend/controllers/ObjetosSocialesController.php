<?php

namespace frontend\controllers;

use Yii;
use common\models\p\ObjetosSociales;
use common\models\a\ActivosDocumentosRegistrados;
use app\models\ObjetosSocialesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ObjetosSocialesController implements the CRUD actions for ObjetosSociales model.
 */
class ObjetosSocialesController extends BaseController
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
     * Lists all ObjetosSociales models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ObjetosSocialesSearch();
         $documento= ActivosDocumentosRegistrados::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id,'tipo_documento_id'=>1]);
        if(isset($documento)){
            $searchModel->documento_registrado_id= $documento->id;
        }
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $model = new ObjetosSociales();
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model'=> $model,
        ]);
    }
     public function actionModificacion()
    {
        $searchModel = new ObjetosSocialesSearch();
        $documento=$searchModel->Modificacionactual();
        if(isset($documento)){
            $searchModel->documento_registrado_id= $documento->documento_registrado_id;
          
        }
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('modificacion', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'documento'=>$documento
          
        ]);
    }

    /**
     * Displays a single ObjetosSociales model.
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
     * Creates a new ObjetosSociales model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ObjetosSociales();

        if($model->existeregistro()){
            Yii::$app->session->setFlash('error','Usuario posee objeto social ó debe crear un documento registrado');
            return $this->redirect(['index']);
                }
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
               
               Yii::$app->session->setFlash('success','Objeto Social guardado con exito');
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
     * Updates an existing ObjetosSociales model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
             Yii::$app->session->setFlash('success','Objeto Social actualizado con exito');
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
     * Deletes an existing ObjetosSociales model.
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
     * Finds the ObjetosSociales model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ObjetosSociales the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ObjetosSociales::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
}
