<?php

namespace frontend\controllers;

use Yii;
use common\models\p\SuplementariosDisminuidos;
use app\models\SuplementariosDisminuidosSearch;
use common\components\BaseController;
use common\models\p\Suplementarios;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SuplementariosDisminuidosController implements the CRUD actions for SuplementariosDisminuidos model.
 */
class SuplementariosDisminuidosController extends BaseController
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
     * Lists all SuplementariosDisminuidos models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SuplementariosDisminuidosSearch();
         $documento=$searchModel->Modificacionactual();
        if(isset($documento)){
            $searchModel->documento_registrado_id= $documento->documento_registrado_id;
          
        }
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'documento'=>$documento,
        ]);
    }

    /**
     * Displays a single SuplementariosDisminuidos model.
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
     * Creates a new SuplementariosDisminuidos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id)
    {
        $model = new SuplementariosDisminuidos();
  
        if($id=='valor'){
            $model->scenario=$id;
        }else{
            if($id=='cantidad'){
                 $model->scenario=$id;
            }else{
                Yii::$app->session->setFlash('error','Parametro incorrecto');
               return $this->redirect(['index']);
               
            }
        }
        if(!$model->Validardenominacion()){
            Yii::$app->session->setFlash('error','Denominacion comercial invalida');
          return $this->redirect(['index']);
        }
        if($model->existeregistro()){
            
            Yii::$app->session->setFlash('error','Usuario posee ua disminucion de capital en curso o no ha creado una modificacion');
            return $this->redirect(['index']);
        }
       

        if ($model->load(Yii::$app->request->post())) {
            $transaction = \Yii::$app->db->beginTransaction();
        try {
            if($model->save()){
            
            $suplementario = Suplementarios::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id,'suscrito'=>true,'actual'=>true]);
            $suplementario_actual=Suplementarios::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id,'suscrito'=>true,'actual'=>false,'tipo_suplementario'=>'ACTUAL']);
            if(isset( $suplementario_actual)){
                $suplementario = $suplementario_actual;
            }                  
            if($suplementario->tipo_suplementario=='ACTUAL'){
                 if(!$suplementario->delete()){
                    $transaction->rollBack();
                    // Yii::$app->session->setFlash('error','');
                    return $this->render('create',['model'=>$model]);
                }
            }
            $suplementario= new Suplementarios();
            $suplementario->numero=$model->numero;
            $suplementario->valor=$model->valor;
            $suplementario->tipo_suplementario='ACTUAL';
            $suplementario->suscrito=true;
            $suplementario->capital=$model->capital_social;
            $suplementario->documento_registrado_id=$model->documento_registrado_id;
            //$certificado->contratista_id=Yii::$app->user->identity->contratista_id;
            if ($suplementario->save()) {
                $transaction->commit();
                return $this->redirect(['index']);
            }else{
                $transaction->rollBack();
                // Yii::$app->session->setFlash('error','');
                return $this->render('create',['model'=>$model]);
            }
            
            }else{
                $transaction->rollBack();
                return $this->render('create',['model'=>$model]);
            }
            
                
        } catch (Exception $e) {
             $transaction->rollBack();
        }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing SuplementariosDisminuidos model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
                $transaction = \Yii::$app->db->beginTransaction();
        try {
            if($model->save()){
            
            $suplementario = Suplementarios::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id,'suscrito'=>true,'actual'=>true]);
            $suplementario_actual=Suplementarios::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id,'suscrito'=>true,'actual'=>false,'tipo_suplementario'=>'ACTUAL']);
            if(isset( $suplementario_actual)){
                $suplementario = $suplementario_actual;
            }                  
            if($suplementario->tipo_suplementario=='ACTUAL'){
                 if(!$suplementario->delete()){
                    $transaction->rollBack();
                    // Yii::$app->session->setFlash('error','');
                    return $this->render('create',['model'=>$model]);
                }
            }
            $suplementario= new Suplementarios();
            $suplementario->numero=$model->numero;
            $suplementario->valor=$model->valor;
            $suplementario->tipo_suplementario='ACTUAL';
            $suplementario->suscrito=true;
            $suplementario->capital=$model->capital_social;
            $suplementario->documento_registrado_id=$model->documento_registrado_id;
            //$certificado->contratista_id=Yii::$app->user->identity->contratista_id;
            if ($suplementario->save()) {
                $transaction->commit();
                return $this->redirect(['index']);
            }else{
                $transaction->rollBack();
                // Yii::$app->session->setFlash('error','');
                return $this->render('create',['model'=>$model]);
            }
            
            }else{
                $transaction->rollBack();
                return $this->render('create',['model'=>$model]);
            }
            
                
        } catch (Exception $e) {
             $transaction->rollBack();
        }
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing SuplementariosDisminuidos model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model=$this->findModel($id);
   
        $transaction = \Yii::$app->db->beginTransaction();
        try {
       
        $suplementario=Suplementarios::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id,'suscrito'=>true,'actual'=>false,'tipo_suplementario'=>'ACTUAL']);
        if(isset( $suplementario)){
                if(!$suplementario->delete()){
                     $transaction->rollBack();
                    return $this->redirect(['index']);
                }
        }
        if($model->delete()){
           $transaction->commit();
        }else{
              $transaction->rollBack();
        }
        return $this->redirect(['index']);    
        } catch (Exception $ex) {
                $transaction->rollBack();
        }
        
    }

    /**
     * Finds the SuplementariosDisminuidos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SuplementariosDisminuidos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SuplementariosDisminuidos::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
