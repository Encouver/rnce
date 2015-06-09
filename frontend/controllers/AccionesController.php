<?php

namespace frontend\controllers;

use Yii;
use common\models\p\Acciones;
use common\models\a\ActivosDocumentosRegistrados;
use common\models\p\ActasConstitutivas;
use common\models\p\Certificados;
use common\models\p\OrigenesCapitales;
use common\models\p\Suplementarios;
use app\models\AccionesSearch;
use common\components\BaseController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


/**
 * AccionesController implements the CRUD actions for Acciones model.
 */
class AccionesController extends BaseController
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
     * Lists all Acciones models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AccionesSearch();
        $searchModel->tipo_accion="PRINCIPAL";
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $model= new Acciones();
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model'=>$model,
        ]);
    }
    public function actionPagocapital()
    {
        $searchModel = new AccionesSearch();
        $searchModel->tipo_accion="PAGO_CAPITAL";
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

    /**
     * Displays a single Acciones model.
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
     * Creates a new Acciones model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id='principal')
    {
        $model = new Acciones();
        switch ($id){
            case 'principal':
                $model->scenario='principal';
                $model->tipo_accion='PRINCIPAL';
                break;
            case 'pago':
                $model->scenario='pago';
                $model->tipo_accion='PAGO_CAPITAL';
                
                break;
            default :
                break;
        }
        
        if($model->scenario=='principal'){
            if(!$model->validardenominacion()){
                Yii::$app->session->setFlash('error','Su denominacion comercial no le permite crear acciones');
                return $this->redirect(['index']);
            }
        }
      
        if($model->existeregistro()){
            
            Yii::$app->session->setFlash('error','Usuario posee acciones cargadas o no ha creado un documento registrado');
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
            
            switch ($model->tipo_accion){
                case 'PRINCIPAL':
                    $model->suscrito=true;
                    //$model->tipo_accion="PRINCIPAL";
                    $model->actual=true;
                    $model->contratista_id = Yii::$app->user->identity->contratista_id;
                    $paga_acta = new Acciones();
                    $paga_acta->numero_comun= $model->numero_comun_pagada;
                    //$paga_acta->valor_comun= $model->valor_comun;
                    $paga_acta->capital=$model->capital_pagado;
                    $paga_acta->contratista_id=$model->contratista_id;
                    $paga_acta->documento_registrado_id= $model->documento_registrado_id;
                    $paga_acta->suscrito=false;
                    $paga_acta->actual=true;
                    $paga_acta->tipo_accion=$model->tipo_accion;
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
                            //Yii::$app->session->setFlash('error','Erroren la carga del capital pagado');
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
     * Updates an existing Acciones model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        switch ($model->tipo_accion){
            case 'PRINCIPAL':
                if(!$model->suscrito){
                    $model = Acciones::findOne(['documento_registrado_id'=>$model->documento_registrado_id,'suscrito'=>true]);

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
            switch ($model->tipo_accion){
                case 'PRINCIPAL':
                    $pagada_acta = Acciones::findOne(['documento_registrado_id'=>$model->documento_registrado_id,'suscrito'=>false]);
                    $pagada_acta->capital=$model->capital_pagado;
                    $pagada_acta->numero_comun=$model->numero_comun_pagada;
                    $pagada_acta->certificacion_aporte_id=$model->certificacion_aporte_id;
                    $transaction = \Yii::$app->db->beginTransaction();
                    try {
                        if ($pagada_acta->save(false)) {
                            if ($model->save()) {
                                $transaction->commit();
                                return $this->redirect(['index']);
                            }else{
                                $transaction->rollBack();
                                Yii::$app->session->setFlash('error','Error en la carga del capital sucrito');
                                return $this->render('update',['model'=>$model]);
                            }
                            
                        }else{
                            $transaction->rollBack();
                            Yii::$app->session->setFlash('error','Error en la carga del capital pagado');
                             return $this->render('update',['model'=>$model]);
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
            if($model->tipo_accion=="PRINCIPAL"){
                $pagada_acta = Acciones::findOne(['documento_registrado_id'=>$model->documento_registrado_id,'suscrito'=>false]);
                $model->capital_pagado=$pagada_acta->capital;
                $model->numero_comun_pagada=$pagada_acta->numero_comun;
            }
            return $this->render('update',['model'=>$model]);
        }
    }

    /**
     * Deletes an existing Acciones model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
            
    {
        $model = $this->findModel($id);
        $opcion=$model->tipo_accion;
        $transaction = \Yii::$app->db->beginTransaction();
        try {
            if($opcion=="PRINCIPAL"){
                $model2 = Acciones::findOne(['documento_registrado_id'=>$model->documento_registrado_id,'suscrito'=>!$model->suscrito]);
                if(!$model2 ->delete()){
                    $transaction->rollBack();
                    Yii::$app->session->setFlash('error','Error al eliminar el capital');
                    return $this->redirect(['index']);
                }
            }
             $origen_capital= OrigenesCapitales::findAll(['documento_registrado_id'=>$model->documento_registrado_id,'tipo_origen'=>$model->tipo_accion]);
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
     * Finds the Acciones model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Acciones the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Acciones::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
