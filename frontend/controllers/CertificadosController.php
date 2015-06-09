<?php

namespace frontend\controllers;

use Yii;
use common\models\p\Certificados;
use common\models\a\ActivosDocumentosRegistrados;
use common\models\p\ActasConstitutivas;
use common\models\p\OrigenesCapitales;
use common\models\p\Acciones;
use common\models\p\Suplementarios;
use app\models\CertificadosSearch;
use common\components\BaseController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CertificadosController implements the CRUD actions for Certificados model.
 */
class CertificadosController extends BaseController
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
     * Lists all Certificados models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CertificadosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $model= new Certificados();
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model'=>$model,
        ]);
    }
    public function actionPagocapital()
    {
        $searchModel = new CertificadosSearch();
        $searchModel->tipo_certificado="PAGO_CAPITAL";
        $documento=$searchModel->Modificacionactual();
        if(isset($documento)){
            $searchModel->documento_registrado_id= $documento->documento_registrado_id;
          
        }
      
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('pagocapital', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'documento'=>$documento,
        ]);
    }
    public function actionCreate($id='principal')
    {
        $model = new Certificados();
        switch ($id){
            case 'principal':
                $model->scenario='principal';
                $model->tipo_certificado='PRINCIPAL';
                break;
            case 'pago':
                $model->scenario='pago';
                $model->tipo_certificado='PAGO_CAPITAL';
                
                break;
            default :
                break;
        }
        
        if($model->scenario=='principal'){
            if(!$model->validardenominacion()){
                Yii::$app->session->setFlash('error','Su denominacion comercial no le permite crear certificados');
                return $this->redirect(['index']);
            }
        }
      
        if($model->existeregistro()){
            
            Yii::$app->session->setFlash('error','Usuario posee certificados cargados o no ha creado un documento registrado');
            switch ($model->tipo_accion){
                case 'PRINCIPAL':
                    return $this->redirect(['index']);
                    break;
                case 'PAGO_CAPITAL':
                    return $this->redirect(['pagocapital']);
                    break;
                default :
                    break;
            }
        }
        
        if ( $model->load(Yii::$app->request->post())) {
            
            switch ($model->tipo_certificado){
                case 'PRINCIPAL':
                    $model->suscrito=true;
                    $model->actual=true;
                    $model->contratista_id = Yii::$app->user->identity->contratista_id;
                    $paga_acta = new Certificados();
                    $paga_acta->numero_asociacion= $model->numero_asociacion_pagada;
       
                    $paga_acta->numero_aportacion= $model->numero_aportacion_pagada;
                    
                    $paga_acta->numero_rotativo= $model->numero_rotativo_pagada;
                  
                    $paga_acta->numero_inversion= $model->numero_inversion_pagada;
                    $paga_acta->capital=$model->capital_pagado;
             
                    $paga_acta->contratista_id = $model->contratista_id;
                    $paga_acta->documento_registrado_id= $model->documento_registrado_id;
                    $paga_acta->suscrito=false;
                    $paga_acta->actual=true;
                    $paga_acta->tipo_certificado=$model->tipo_certificado;
                    $paga_acta->certificacion_aporte_id=$model->certificacion_aporte_id;
                                
                        $transaction = \Yii::$app->db->beginTransaction();
             
                        try {
                            if ($paga_acta->save(false)) {
                                if ($model->save()) {
                               
                                $transaction->commit();
                                 return $this->redirect(['index']);

                          
                          
                               
                            }else{
                                $transaction->rollBack();
                               // Yii::$app->session->setFlash('error','Erroren la carga del capital sucrito');
                             return $this->render('create',['model'=>$model]);
                                            }
                            
                        }else{
                            
                            $transaction->rollBack();
                          
                           // Yii::$app->session->setFlash('error','Erroren la carga del capital pagado');
                             return $this->render('create',['model'=>$model]);
                        }
                      
                    
                    } catch (Exception $e) {
                         $transaction->rollBack();
                    }
                break;
                
                case 'PAGO_CAPITAL':
                
                    $model->suscrito=false;
                    if($model->save()){
                        Yii::$app->session->setFlash('success','Registro creado con exito');
                        return $this->redirect(['pagocapital']);
                    }else{
                        Yii::$app->session->setFlash('error','Error en la actualizacion del capital');
                        return $this->render('create',['model'=>$model]);
                    }
                
                
                break;
            default :
                break;
            }
            
        }
        return $this->render('create',['model'=>$model]);
    }
    /**
     * Displays a single Certificados model.
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
     * Updates an existing Certificados model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
      public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        switch ($model->tipo_certificado){
            case 'PRINCIPAL':
                if(!$model->suscrito){
                    $model = Certificados::findOne(['documento_registrado_id'=>$model->documento_registrado_id,'suscrito'=>true]);

                }
                $model->scenario='principal';
            break;
            
            case 'PAGO_CAPITAL':
                $model->scenario='pago';
                break;
            default :
                break;
         }

        if ($model->load(Yii::$app->request->post())) {
            switch ($model->tipo_certificado){
                case 'PRINCIPAL':
                    $paga_acta = Certificados::findOne(['documento_registrado_id'=>$model->documento_registrado_id,'suscrito'=>false]);
                    $paga_acta->numero_asociacion= $model->numero_asociacion_pagada;
       
                    $paga_acta->numero_aportacion= $model->numero_aportacion_pagada;
                    
                    $paga_acta->numero_rotativo= $model->numero_rotativo_pagada;
                  
                    $paga_acta->numero_inversion= $model->numero_inversion_pagada;
                    $paga_acta->capital=$model->capital_pagado;
                    $paga_acta->certificacion_aporte_id=$model->certificacion_aporte_id;
             
                    $transaction = \Yii::$app->db->beginTransaction();
             
                    try {
                        if ($paga_acta->save(false)) {
                            if ($model->save()) {
                                $transaction->commit();
                                return $this->redirect(['index']);
                            }else{
                                $transaction->rollBack();
                                //Yii::$app->session->setFlash('error','Erroren la carga del capital sucrito');
                                return $this->render('create',['model'=>$model]);
                            }
                            
                        }else{
                            $transaction->rollBack();
                            //Yii::$app->session->setFlash('error','Erroren la carga del capital pagado');
                            return $this->render('create',['model'=>$model]);
                        }
                      
                    
                    } catch (Exception $e) {
                         $transaction->rollBack();
                    }
                break;
                case 'PAGO_CAPITAL':
                    if($model->save()){
                        return $this->redirect(['pagocapital']);
                    }else{
                        return $this->render('update',['model'=>$model]);
                    }
                
                break;
                default :
                    break;
            }
        }else{
            if($model->tipo_certificado=="PRINCIPAL"){
                $paga_acta = Certificados::findOne(['documento_registrado_id'=>$model->documento_registrado_id,'suscrito'=>false]);
                $model->numero_asociacion_pagada=$paga_acta->numero_asociacion;
                $model->numero_aportacion_pagada=$paga_acta->numero_aportacion;
                $model->numero_rotativo_pagada=$paga_acta->numero_rotativo;
                $model->numero_inversion_pagada=$paga_acta->numero_inversion;
                $model->capital_pagado=$paga_acta->capital;
            }
            return $this->render('update',['model'=>$model]);
        }
    }

    /**
     * Deletes an existing Certificados model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
         public function actionDelete($id)
            
    {
        $model = $this->findModel($id);
        $opcion=$model->tipo_certificado;
        $transaction = \Yii::$app->db->beginTransaction();
        try {
            if($opcion=="PRINCIPAL"){
                $model2 = Certificados::findOne(['documento_registrado_id'=>$model->documento_registrado_id,'suscrito'=>!$model->suscrito]);
                if(!$model2 ->delete()){
                    $transaction->rollBack();
                    Yii::$app->session->setFlash('error','Error al eliminar el capital');
                    return $this->redirect(['index']);
                }
            }
             $origen_capital= OrigenesCapitales::findAll(['documento_registrado_id'=>$model->documento_registrado_id,'tipo_origen'=>$model->tipo_certificado]);
            if(isset($origen_capital)){
                foreach ($origen_capital as $origen) {
                    if(!$origen->delete()){
                        $transaction->rollBack();
                        Yii::$app->session->setFlash('error','Error al eliminar el origen de capital asociado');
                        
                        switch ($opcion){
                            case 'PRINCIPAL':
                   
                                return $this->redirect(['index']);
                            break;
                            case 'PAGO_CAPITAL':
                                $model->delete();
                                return $this->redirect(['pagocapital']);
                            break;
                            default :
                            break;
                        }
                    }
                    
                }
            }
            if(!$model->delete()){
                $transaction->rollBack();
                Yii::$app->session->setFlash('error','Error al eliminar el capital');
                
            }else{
                $transaction->commit();
            }
            switch ($opcion){
                case 'PRINCIPAL':
                   
                    return $this->redirect(['index']);
                    break;
                case 'PAGO_CAPITAL':
                    $model->delete();
                    return $this->redirect(['pagocapital']);
                    break;
                default :
                    break;
                }
            
        } catch (Exception $e) {
            $transaction->rollBack();
        }
  
    }
    /**
     * Finds the Certificados model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Certificados the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Certificados::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
