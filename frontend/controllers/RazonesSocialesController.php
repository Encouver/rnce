<?php

namespace frontend\controllers;

use Yii;
use common\models\p\RazonesSociales;
use app\models\RazonesSocialesSearch;
use common\models\a\ActivosDocumentosRegistrados;
use common\components\BaseController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RazonesSocialesController implements the CRUD actions for RazonesSociales model.
 */
class RazonesSocialesController extends BaseController
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
     * Lists all RazonesSociales models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RazonesSocialesSearch();
         $documento= ActivosDocumentosRegistrados::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id,'tipo_documento_id'=>1]);
        if(isset($documento)){
            $searchModel->documento_registrado_id= $documento->id;
        }
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $model = new RazonesSociales();
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model'=>$model
        ]);
    }
    public function actionModificacion()
    {
        $searchModel = new RazonesSocialesSearch();
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
     * Displays a single RazonesSociales model.
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
     * Creates a new RazonesSociales model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new RazonesSociales();
        if($model->existeregistro()){
            Yii::$app->session->setFlash('error','Usuario posee una razon social ó debe crear un documento registrado');
            return $this->redirect(['index']);
                }
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
               Yii::$app->session->setFlash('success','Razon Social guardada con exito');
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
     * Updates an existing RazonesSociales model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success','Razon Social guardada con exito');
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
     * Deletes an existing RazonesSociales model.
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
     * Finds the RazonesSociales model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return RazonesSociales the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = RazonesSociales::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
