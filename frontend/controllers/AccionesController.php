<?php

namespace frontend\controllers;

use Yii;
use common\models\p\Acciones;
use common\models\a\ActivosDocumentosRegistrados;
use app\models\AccionesSearch;
use common\components\BaseController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\widgets\ActiveForm;
use yii\web\Response;


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
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
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
    public function actionCreate()
    {
        $model = new Acciones();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
    public function actionAccionsuscritaacta()
    {
        $suscrita_acta = new Acciones();
         $suscrita_acta->scenario='principal';
         $msg=null;

       
        if ( $suscrita_acta->load(Yii::$app->request->post()) && Yii::$app->request->isAjax) {
            
            Yii::$app->response->format= Response::FORMAT_JSON;
            return ActiveForm::validate($suscrita_acta);
            
             /*$transaction = \Yii::$app->db->beginTransaction();
             
           try {
               $usuario= \common\models\p\User::findOne(Yii::$app->user->identity->id);
                $registro = DocumentosRegistrados::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id, 'sys_tipo_registro_id'=>1]);
            
          $acciones= Acciones::findOne(['contratista_id'=>$usuario->contratista_id ,'documento_registrado_id'=>$registro->id ]);
          
            if(isset($acciones)){
                   
                      return "Usario ya posee accones suscritas y pagadas asociadas";
                                   
                               
                   }
          
            
            if($suscrita_acta->numero_comun< $suscrita_acta->numero_comun_pagada){
                return "Numero de acciones pagadas incorrecto";
                
            }
             if($suscrita_acta->valor_comun< $suscrita_acta->valor_comun_pagada){
                return "Valor de acciones pagadas incorrecto";
                
            }
            $suscrita_acta->suscrito=true;
            
           $paga_acta = new Acciones();
           $paga_acta->numero_comun= $suscrita_acta->numero_comun_pagada;
           $paga_acta->valor_comun=$suscrita_acta->valor_comun;
             
            $paga_acta->contratista_id = $usuario->contratista_id;
            $paga_acta->documento_registrado_id= $registro->id;
            $paga_acta->suscrito=false;
            $paga_acta->tipo_accion="PRINCIPAL";
            
            $suscrita_acta->contratista_id = $usuario->contratista_id;
             $suscrita_acta->documento_registrado_id= $registro->id;
             $suscrita_acta->tipo_accion="PRINCIPAL";
             if (! ($flag =  $paga_acta->save(false))) {
           
                    $transaction->rollBack();
                       return "Error en la carga de las acciones suscritas";
                               
                   }
            
               if ($suscrita_acta->save()) {
           

                               $transaction->commit();
                               return "Datos guardados con exito";
                               


                   }else{
                        $transaction->rollBack();
                        
                       return "Acciones suscritas no guardas con exito";
                   }
             
             
           } catch (Exception $e) {
               $transaction->rollBack();
           }*/
        }
        if ( $suscrita_acta->load(Yii::$app->request->post())) {
            
            
          
              $usuario= \common\models\p\User::findOne(Yii::$app->user->identity->id);
              $registro = ActivosDocumentosRegistrados::findOne(['contratista_id'=>$usuario->contratista_id, 'tipo_documento_id'=>1]);
   
              $suscrita_acta->suscrito=true;
              $suscrita_acta->tipo_accion="PRINCIPAL";
              $suscrita_acta->contratista_id = $usuario->contratista_id;
              $suscrita_acta->documento_registrado_id = $registro->id;
     
            if($suscrita_acta->validate()){
                
                $acciones= Acciones::findOne(['contratista_id'=>$suscrita_acta->contratista_id ,'documento_registrado_id'=>$suscrita_acta->documento_registrado_id]);
          
                if(isset($acciones)){
                   
                     $msg = "Usuario ya posee accones suscritas y pagadas asociadas";
                                   
                               
                   }else{
                 
                        $paga_acta = new Acciones();
                        $paga_acta->numero_comun= $suscrita_acta->numero_comun_pagada;
                        $paga_acta->valor_comun=$suscrita_acta->valor_comun_pagada;
             
                        $paga_acta->contratista_id = $suscrita_acta->contratista_id;
                        $paga_acta->documento_registrado_id= $suscrita_acta->documento_registrado_id;
                        $paga_acta->suscrito=false;
                        $paga_acta->tipo_accion=$suscrita_acta->tipo_accion;
                
                        $transaction = \Yii::$app->db->beginTransaction();
             
                        try {
                            if (! ($flag =  $paga_acta->save(false))) {
           
                            $transaction->rollBack();
                            $msg= "Error en la carga de las acciones suscritas";
                               
                        }
                        if ($suscrita_acta->save()) {
           
                                $msg="Datos guardados correctamente";
                                $suscrita_acta->numero_comun=null;
                                $suscrita_acta->valor_comun=null;
                                $suscrita_acta->numero_comun_pagada=null;
                                $suscrita_acta->valor_comun_pagada=null;
                               
                                $transaction->commit();

                        }else{
                            $transaction->rollBack();
                        
                        $msg= "Acciones suscritas no guardas con exito";
                        }
                    
                    } catch (Exception $e) {
                         $transaction->rollBack();
                    }
                
                }
            }else{
               $suscrita_acta->getErrors();
                $msg= "Error en la cargade datos";
            }
        }
        return $this->render("acciones_actas",['accion_acta'=>$suscrita_acta,'msg'=>$msg]);
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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
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
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
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
