<?php

namespace frontend\controllers;

use Yii;
use common\models\p\Suplementarios;
use common\models\a\ActivosDocumentosRegistrados;
use app\models\SuplementariosSearch;
use common\components\BaseController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SuplementariosController implements the CRUD actions for Suplementarios model.
 */
class SuplementariosController extends BaseController
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
     * Lists all Suplementarios models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SuplementariosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $model= new Suplementarios();
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model'=>$model,
        ]);
    }

    /**
     * Displays a single Suplementarios model.
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
     * Creates a new Suplementarios model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
     public function actionCreate()
    {
        $model = new Suplementarios();
         $model->scenario='principal';
        if(!$model->validardenominacion()){
            Yii::$app->session->setFlash('error','Su denominacion comercial no le permite crear acciones');
            return $this->redirect(['index']);
         }
          if($model->existeregistro()){
            Yii::$app->session->setFlash('error','Usuario posee acciones cargadas o no ha creado un documento registrado');
            return $this->redirect(['index']);
                }
        
        if ( $model->load(Yii::$app->request->post())) {
            
            
   
              $model->suscrito=true;
              $model->tipo_suplementario="PRINCIPAL";
                $model->contratista_id = Yii::$app->user->identity->contratista_id;
                       $paga_acta = new Suplementarios();
                        $paga_acta->numero= $model->numero_pagada;
                        $paga_acta->capital=$model->capital_pagado;
             
                        $paga_acta->contratista_id = $model->contratista_id;
                        $paga_acta->documento_registrado_id= $model->documento_registrado_id;
                        $paga_acta->suscrito=false;
                        $paga_acta->tipo_suplementario=$model->tipo_suplementario;
                         $paga_acta->certificacion_aporte_id=$model->certificacion_aporte_id;
                
                        $transaction = \Yii::$app->db->beginTransaction();
             
                        try {
                            if ($paga_acta->save(false)) {
                                if ($model->save()) {
                               
                                $transaction->commit();
                                 return $this->redirect(['index']);

                          
                          
                               
                            }else{
                                $transaction->rollBack();
                                Yii::$app->session->setFlash('error','Erroren la carga del capital sucrito');
                             return $this->render('create',['model'=>$model]);
                                            }
                            
                        }else{
                            
                            $transaction->rollBack();
            
                            Yii::$app->session->setFlash('error','Erroren la carga del capital pagado');
                             return $this->render('create',['model'=>$model]);
                        }
                      
                    
                    } catch (Exception $e) {
                         $transaction->rollBack();
                    }
                
                
            
        }
        return $this->render('create',['model'=>$model]);
    }
   
    

    /**
     * Updates an existing Suplementarios model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if(!$model->suscrito){
        $model = Suplementarios::findOne(['documento_registrado_id'=>$model->documento_registrado_id,'suscrito'=>true]);

        }
         $model->scenario='principal';
         $pagada_acta = Suplementarios::findOne(['documento_registrado_id'=>$model->documento_registrado_id,'suscrito'=>false]);

        if ($model->load(Yii::$app->request->post())) {
                     $pagada_acta = Suplementarios::findOne(['documento_registrado_id'=>$model->documento_registrado_id,'suscrito'=>false]);
            $pagada_acta->numero= $model->numero_pagada;
                        $pagada_acta->capital=$model->capital_pagado;
                         $pagada_acta->certificacion_aporte_id=$model->certificacion_aporte_id;
           $transaction = \Yii::$app->db->beginTransaction();
             
                        try {
                            if ($pagada_acta->save(false)) {
                                if ($model->save()) {
                               
                                $transaction->commit();
                                 return $this->redirect(['index']);

                          
                          
                               
                            }else{
                                $transaction->rollBack();
                                Yii::$app->session->setFlash('error','Erroren la carga del capital sucrito');
                             return $this->render('create',['model'=>$model]);
                                            }
                            
                        }else{
                            
                            $transaction->rollBack();
                            Yii::$app->session->setFlash('error','Erroren la carga del capital pagado');
                             return $this->render('create',['model'=>$model]);
                        }
                      
                    
                    } catch (Exception $e) {
                         $transaction->rollBack();
                    }
            
            
        } else {
              
                $model->capital_pagado=$pagada_acta->capital;
                $model->numero_pagada=$pagada_acta->numero;
                
           return $this->render('update',['model'=>$model]);
        }
    }

    /**
     * Deletes an existing Suplementarios model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
       $model = $this->findModel($id);
        $model2 = Suplementarios::findOne(['documento_registrado_id'=>$model->documento_registrado_id,'suscrito'=>!$model->suscrito]);

        $model->delete();
       $model2 ->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Suplementarios model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Suplementarios the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Suplementarios::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
