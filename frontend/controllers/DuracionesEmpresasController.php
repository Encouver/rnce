<?php

namespace frontend\controllers;

use Yii;
use common\models\p\DuracionesEmpresas;
use app\models\DuracionesEmpresasSearch;
use common\models\a\ActivosDocumentosRegistrados;
use common\components\BaseController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DuracionesEmpresasController implements the CRUD actions for DuracionesEmpresas model.
 */
class DuracionesEmpresasController extends BaseController
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
     * Lists all DuracionesEmpresas models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DuracionesEmpresasSearch();
        $documento= ActivosDocumentosRegistrados::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id,'tipo_documento_id'=>1]);
        if(isset($documento)){
            $searchModelFiscal->documento_registrado_id= $documento->id;
        }
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $model= new DuracionesEmpresas();
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model'=>$model
        ]);
    }
     public function actionModificacion()
    {
        $searchModel = new DuracionesEmpresasSearch();
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
     * Displays a single DuracionesEmpresas model.
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
     * Creates a new DuracionesEmpresas model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new DuracionesEmpresas();

      if($model->existeregistro()){
            Yii::$app->session->setFlash('error','Usuario ya posse una duracion empresa ó debe crear un documento registrado');
            return $this->redirect(['index']);
                }
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
               Yii::$app->session->setFlash('success','Duracion empresa guardado con exito');
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
     * Updates an existing DuracionesEmpresas model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
             Yii::$app->session->setFlash('success','Duracion empresa guardado con exito');
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
     * Deletes an existing DuracionesEmpresas model.
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
     * Finds the DuracionesEmpresas model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return DuracionesEmpresas the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DuracionesEmpresas::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
