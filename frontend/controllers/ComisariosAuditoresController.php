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
        $searchModel->comisario=true;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
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
                break;
            case "profesional":
                $model->scenario=$id;
                $model->informe_conversion=true;
                break;
            default :
                break;
            }  
        }
          if($model->existeregistro()){
            Yii::$app->session->setFlash('error','Usuario posee el limte de comisarios ó debe crear un documento registrado');
            return $this->redirect(['index']);
          }
        if ($model->load(Yii::$app->request->post()) && !$model->accionista() && $model->save()) {
    
                
          return $this->redirect(['index']);

        } else {
            if($model->accionista()){
                Yii::$app->session->setFlash('error','El comisario no puede formar parte de los accionista o junta directiva');
           
            }
            return $this->render('create', [
                'model' => $model,
                'modelPersona'=>$modelPersona,
            ]);
        }
    }
      public function actionCrearresponsable()
    {
        $responsable_contabilidad = new ComisariosAuditores();
         $searchModel = new ComisariosAuditoresSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
       
    
        return $this->render('responsables_contabilidad', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'responsable_contabilidad' => $responsable_contabilidad,
        ]);
      
        
    }
     public function actionResponsablecontabilidad(){
        
        
        
         $responsable_contabilidad = new ComisariosAuditores();
        $usuario= \common\models\p\User::findOne(Yii::$app->user->identity->id);
        if ( $responsable_contabilidad->load(Yii::$app->request->post())) {
            
             $transaction = \Yii::$app->db->beginTransaction();
           try {
          
            
            $responsable_contabilidad->contratista_id = $usuario->contratista_id;
            $responsable_contabilidad->comisario=false;
            $responsable_contabilidad->auditor=false;
           $responsable_contabilidad->responsable_contabilidad=true;
           $responsable_contabilidad->informe_conversion=false;
          
               if ( $responsable_contabilidad->save()) {
           

                               $transaction->commit();
                               return "Datos guardados con exito";
                               


                   }else{
                        $transaction->rollBack();
                       return "Datos no guardados";
                   }
             
             
           } catch (Exception $e) {
               $transaction->rollBack();
           }
        }
        
    }
    public function actionCrearcontador()
    {
        $contador_auditor = new ComisariosAuditores();
         $searchModel = new ComisariosAuditoresSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
       
    
        return $this->render('contadores_auditores', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'contador_auditor' => $contador_auditor,
        ]);
      
        
    }
    public function actionContadorauditor(){
        
       $contador_auditor = new ComisariosAuditores();
      
        $usuario= \common\models\p\User::findOne(Yii::$app->user->identity->id);
        if ( $contador_auditor->load(Yii::$app->request->post())) {
            
             $transaction = \Yii::$app->db->beginTransaction();
             
           try {
               $natural_juridica = \common\models\p\SysNaturalesJuridicas::find()->where(['id'=>$contador_auditor->natural_juridica_id])->one();
           
               $persona_natural= PersonasNaturales::find()->where(['rif'=>$natural_juridica->rif])->one();
            if(isset($persona_natural) && $contador_auditor->colegiatura==null){
                 $transaction->rollBack();
                return "Debe ingresar el numero de colegido"; 
            }
            if($contador_auditor->fecha_vencimiento==null){
                
                  $transaction->rollBack();
                return "Debe ingresar la fecha de vencimineto"; 
            }
            $contador_auditor->contratista_id = $usuario->contratista_id;
            $contador_auditor->comisario=false;
            $contador_auditor->auditor=true;
           $contador_auditor->responsable_contabilidad=false;
           $contador_auditor->informe_conversion=false;
         
               if ( $contador_auditor->save()) {
           

                               $transaction->commit();
                               return "Datos guardados con exito";
                               


                   }else{
                        $transaction->rollBack();
                       return "Datos no guardados";
                   }
             
             
           } catch (Exception $e) {
               $transaction->rollBack();
           }
        }
        
        
    }
    
      public function actionCrearprofesional()
    {
        $profesional_informe = new ComisariosAuditores();
         $searchModel = new ComisariosAuditoresSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
       
    
        return $this->render('profesionales_informes', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'profesional_informe' => $profesional_informe,
        ]);
      
        
    }
    
    public function actionProfesionalinforme(){
        
       $profesional_informe = new ComisariosAuditores();
      
        $usuario= \common\models\p\User::findOne(Yii::$app->user->identity->id);
        if (  $profesional_informe->load(Yii::$app->request->post())) {
            
             $transaction = \Yii::$app->db->beginTransaction();
             
           try {
               $natural_juridica = \common\models\p\SysNaturalesJuridicas::find()->where(['id'=> $profesional_informe->natural_juridica_id])->one();
           
               $persona_natural= PersonasNaturales::find()->where(['rif'=>$natural_juridica->rif])->one();
            if(isset($persona_natural) &&  $profesional_informe->colegiatura==null){
                 $transaction->rollBack();
                return "Debe ingresar el numero de colegido"; 
            }
            if( $profesional_informe->fecha_informe==null){
                
                  $transaction->rollBack();
                return "Debe ingresar la fecha del informe"; 
            }
            if( $profesional_informe->tipo_profesion==null){
                
                  $transaction->rollBack();
                return "Debe ingresar el tipo de profesion"; 
            }
             $profesional_informe->contratista_id = $usuario->contratista_id;
             $profesional_informe->comisario=false;
             $profesional_informe->auditor=false;
             $profesional_informe->responsable_contabilidad=false;
             $profesional_informe->informe_conversion=true;
         
               if ($profesional_informe->save()) {
           

                               $transaction->commit();
                               return "Datos guardados con exito";
                               


                   }else{
                        $transaction->rollBack();
                       return "Datos no guardados";
                   }
             
             
           } catch (Exception $e) {
               $transaction->rollBack();
           }
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
           }
        
        if ($model->load(Yii::$app->request->post()) && !$model->accionista() && $model->save()) {
            return $this->redirect(['index']);
        } else {
            if($model->accionista()){
                Yii::$app->session->setFlash('error','El comisario no puede formar parte de los accionista o junta directiva');
           
            }
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
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
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
