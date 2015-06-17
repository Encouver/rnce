<?php

namespace frontend\controllers;

use Yii;
use common\models\p\CertificadosDisminuidos;
use app\models\CertificadosDisminuidosSearch;
use common\models\p\Certificados;
use common\components\BaseController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CertificadosDisminuidosController implements the CRUD actions for CertificadosDisminuidos model.
 */
class CertificadosDisminuidosController extends BaseController
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
     * Lists all CertificadosDisminuidos models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CertificadosDisminuidosSearch();
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
     * Displays a single CertificadosDisminuidos model.
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
     * Creates a new CertificadosDisminuidos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id)
    {
        $model = new CertificadosDisminuidos();
         
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
            
            $certificado = Certificados::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id,'suscrito'=>true,'actual'=>true]);
            $certificado_actual=Certificados::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id,'suscrito'=>true,'actual'=>false,'tipo_certificado'=>'ACTUAL']);
            if(isset($certificado_actual)){
                $certificado =$certificado_actual;
            }                  
            if($certificado->tipo_certificado=='ACTUAL'){
                 if(!$certificado->delete()){
                    $transaction->rollBack();
                    // Yii::$app->session->setFlash('error','');
                    return $this->render('create',['model'=>$model]);
                }
            }
            $certificado= new Certificados();
            $certificado->numero_asociacion=$model->numero_asociacion;
            $certificado->numero_aportacion=$model->numero_aportacion;
            $certificado->numero_rotativo=$model->numero_rotativo;
            $certificado->numero_inversion=$model->numero_inversion;
            $certificado->valor_asociacion=$model->valor_asociacion;
            $certificado->valor_aportacion=$model->valor_aportacion;
            $certificado->valor_rotativo=$model->valor_rotativo;
            $certificado->valor_inversion=$model->valor_inversion;
            $certificado->tipo_certificado='ACTUAL';
            $certificado->suscrito=true;
            $certificado->capital=$model->capital_social;
            $certificado->documento_registrado_id=$model->documento_registrado_id;
            //$certificado->contratista_id=Yii::$app->user->identity->contratista_id;
            if ($certificado->save()) {
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
     * Updates an existing CertificadosDisminuidos model.
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
            
            $certificado = Certificados::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id,'suscrito'=>true,'actual'=>true]);
            $certificado_actual=Certificados::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id,'suscrito'=>true,'actual'=>false,'tipo_certificado'=>'ACTUAL']);
            if(isset($certificado_actual)){
                $certificado =$certificado_actual;
            }                  
            if($certificado->tipo_certificado=='ACTUAL'){
                 if(!$certificado->delete()){
                    $transaction->rollBack();
                    // Yii::$app->session->setFlash('error','');
                    return $this->render('create',['model'=>$model]);
                }
            }
            $certificado= new Certificados();
            $certificado->numero_asociacion=$model->numero_asociacion;
            $certificado->numero_aportacion=$model->numero_aportacion;
            $certificado->numero_rotativo=$model->numero_rotativo;
            $certificado->numero_inversion=$model->numero_inversion;
            $certificado->valor_asociacion=$model->valor_asociacion;
            $certificado->valor_aportacion=$model->valor_aportacion;
            $certificado->valor_rotativo=$model->valor_rotativo;
            $certificado->valor_inversion=$model->valor_inversion;
            $certificado->tipo_certificado='ACTUAL';
            $certificado->suscrito=true;
            $certificado->capital=$model->capital_social;
            $certificado->documento_registrado_id=$model->documento_registrado_id;
            //$certificado->contratista_id=Yii::$app->user->identity->contratista_id;
            if ($certificado->save()) {
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
     * Deletes an existing CertificadosDisminuidos model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
         $model=$this->findModel($id);
   
        $transaction = \Yii::$app->db->beginTransaction();
        try {
        $certificado=Certificados::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id,'suscrito'=>true,'actual'=>false,'tipo_certificado'=>'ACTUAL']);
        if(isset($certificado)){
               if(!$certificado->delete()){
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
     * Finds the CertificadosDisminuidos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CertificadosDisminuidos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CertificadosDisminuidos::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
