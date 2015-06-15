<?php

namespace frontend\controllers;

use Yii;
use common\models\a\ActivosDocumentosRegistrados;
use common\models\p\ComisariosAuditores;
use common\models\p\PersonasNaturales;
use app\models\ComisariosAuditoresSearch;
use common\components\BaseController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ComisariosAuditoresController implements the CRUD actions for ComisariosAuditores model.
 */
class ComisariosAuditoresController extends BaseController
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
     * Lists all ComisariosAuditores models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ComisariosAuditoresSearch();
        $documento= ActivosDocumentosRegistrados::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id,'tipo_documento_id'=>1]);
        if(isset($documento)){
            $searchModel->documento_registrado_id= $documento->id;
        }
        $searchModel->comisario=true;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
     public function actionComisario()
    {
        $searchModel = new ComisariosAuditoresSearch();
        $documento=$searchModel->Modificacionactual();
        if(isset($documento)){
            $searchModel->documento_registrado_id= $documento->documento_registrado_id;
          
        }
        $searchModel->comisario=true;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $model= new ComisariosAuditores();
        return $this->render('comisario', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'documento'=>$documento,
        ]);
    }
     public function actionResponsable()
    {
        $searchModel = new ComisariosAuditoresSearch();
        $searchModel->responsable_contabilidad=true;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('responsable', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
     public function actionAuditor()
    {
        $searchModel = new ComisariosAuditoresSearch();
        $searchModel->auditor=true;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('auditor', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
     public function actionProfesional()
    {
        $searchModel = new ComisariosAuditoresSearch();
        $searchModel->informe_conversion=true;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('profesional', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ComisariosAuditores model.
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
     * Creates a new ComisariosAuditores model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id=null)
    {
        $model = new ComisariosAuditores();
        $modelPersona= new PersonasNaturales(['scenario'=>'basico']);
       
        if (!is_null($id)){
            switch ($id){
            case "comisario":
                $model->scenario=$id;
                $model->comisario=true;
                break;
            case "auditor":
                $model->scenario=$id;
                $model->auditor=true;
                $model->comisario=false;
                break;
            case "profesional":
                $model->scenario=$id;
                $model->informe_conversion=true;
                $model->comisario=false;
                $model->tipo_profesion='CONTADOR PUBLICO';
                break;
              case "responsable":
                $model->scenario=$id;
                $model->responsable_contabilidad=true;
                $model->tipo_profesion='CONTADOR PUBLICO';
                $model->comisario=false;
                break;
            default :
                break;
            }  
        }
          if($model->existeregistro()){
            Yii::$app->session->setFlash('error','Usuario posee el limte de comisarios ó debe crear un documento registrado');
            return $this->redirect(['index']);
          }
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
    
                
            if($model->comisario){
              if($model->documentoRegistrado->tipo_documento_id==2){
                   return $this->redirect(['comisario']);
              }
               return $this->redirect(['index']);
           }else{
               if($model->auditor){
                    return $this->redirect(['auditor']);
               }else{
                   if($model->responsable_contabilidad){
                       return $this->redirect(['responsable']);
                   }else{
                       return $this->redirect(['profesional']);
                   }
               }
                        
           }

        } else {
            return $this->render('create', [
                'model' => $model,
                'modelPersona'=>$modelPersona,
            ]);
        }
    }
    
    /**
     * Updates an existing ComisariosAuditores model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $modelPersona= new PersonasNaturales(['scenario'=>'basico']);
        if($model->comisario){
               $model->scenario='comisario';
           }else{
               if($model->auditor){
                   $model->scenario='auditor';
               }else{
                   if($model->responsable_contabilidad){
                       $model->scenario='responsable';
                   }else{
                       $model->scenario='profesional';
                   }
               }
                        
           }
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
             if($model->comisario){
              if($model->documentoRegistrado->tipo_documento_id==2){
                   return $this->redirect(['comisario']);
              }
               return $this->redirect(['index']);
           }else{
               if($model->auditor){
                    return $this->redirect(['auditor']);
               }else{
                   if($model->responsable_contabilidad){
                       return $this->redirect(['responsable']);
                   }else{
                       return $this->redirect(['profesional']);
                   }
               }
                        
           }
           
        } else {
           
            return $this->render('update', [
                'model' => $model,
                 'modelPersona'=>$modelPersona,
            ]);
        }
    }

    /**
     * Deletes an existing ComisariosAuditores model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model= $this->findModel($id);
        $comisario=$model->comisario;
       if($comisario){
           $documento=$model->documentoRegistrado->tipo_documento_id;
       }
        $responsable=$model->responsable_contabilidad;
        $auditor=$model->auditor;
        $profesional=$model->informe_conversion;
        $model->delete();
         if($comisario){
              if($documento==2){
                   return $this->redirect(['comisario']);
              }
               return $this->redirect(['index']);
           }else{
               if($auditor){
                    return $this->redirect(['auditor']);
               }else{
                   if($responsable){
                       return $this->redirect(['responsable']);
                   }else{
                       return $this->redirect(['profesional']);
                   }
               }
                        
           }
    }

    /**
     * Finds the ComisariosAuditores model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ComisariosAuditores the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ComisariosAuditores::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
