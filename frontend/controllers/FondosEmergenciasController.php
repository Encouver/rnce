<?php

namespace frontend\controllers;

use Yii;
use common\models\p\FondosEmergencias;
use app\models\FondosEmergenciasSearch;
use common\models\p\OrigenesCapitales;
use common\components\BaseController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * FondosEmergenciasController implements the CRUD actions for FondosEmergencias model.
 */
class FondosEmergenciasController extends BaseController
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
     * Lists all FondosEmergencias models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FondosEmergenciasSearch();
          $documento=$searchModel->Modificacionactual();
        if(isset($documento)){
            $searchModel->documento_registrado_id= $documento->documento_registrado_id;
          
        }
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->sort = false;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'documento'=>$documento,
        ]);
    }

    /**
     * Displays a single FondosEmergencias model.
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
     * Creates a new FondosEmergencias model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new FondosEmergencias();
         if($model->existeregistro()){
            
            Yii::$app->session->setFlash('error','Usuario posee un fondo de emergencia en curso o no ha creado una modificacion');
            return $this->redirect(['index']);
        }
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing FondosEmergencias model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $transaction = \Yii::$app->db->beginTransaction();
                    try {
                        $modelaux= $this->findModel($model->id);
                         if(is_null($model->monto_asociados)){
                                        $model->monto_asociados=0;
                         }
                          if(is_null($modelaux->monto_asociados)){
                                        $modelaux->monto_asociados=0;
                         }
                        if($modelaux->monto_asociados > $model->monto_asociados){
                            $origen_capital= OrigenesCapitales::find()->where(['documento_registrado_id'=>$model->documento_registrado_id,'tipo_origen'=>'FONDO_EMERGENCIA'])->orderBy('monto')->all();
                                if(isset($origen_capital)){
                                    foreach ($origen_capital as $origen) {
                                        if($origen->sumarmonto(false)>$model->monto_asociados){
                                            if(!$origen->delete()){
                                                $transaction->rollBack();
                                                Yii::$app->session->setFlash('error','Error al eliminar el origen de capital');
                                                return $this->redirect(['index']);
                                            }   
                                        }
                                    }
                                }
                        
                        }
                        if(is_null($model->monto_asociados)){
                                        $model->monto_asociados=null;
                         }
                        
                        if($model->save()){
                             $transaction->commit();
                             Yii::$app->session->setFlash('success','Actualizacion realizada con exito');
                            return $this->redirect(['index']);
                        }else{
                            $transaction->rollBack();
                        return $this->render('update',['model'=>$model]);
                        }
                        
                    } catch (Exception $e) {
                         $transaction->rollBack();
                    }
             return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing FondosEmergencias model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
      public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $transaction = \Yii::$app->db->beginTransaction();
        try {
             $origen_capital= OrigenesCapitales::findAll(['documento_registrado_id'=>$model->documento_registrado_id,'tipo_origen'=>'FONDO_EMERGENCIA']);
            if(isset($origen_capital)){
                foreach ($origen_capital as $origen) {
                    if(!$origen->delete()){
                        $transaction->rollBack();
                        Yii::$app->session->setFlash('error','Error al eliminar Activos aportados');
                        return $this->redirect(['index']);
                         
                        
                    }
                    
                }
            }
            if(!$model->delete()){
                $transaction->rollBack();
                Yii::$app->session->setFlash('error','Error al eliminar el fondo de emergencia');
                
            }else{
                $transaction->commit();
                 return $this->redirect(['index']);
            }
            
        } catch (Exception $e) {
            $transaction->rollBack();
        }
    }

    /**
     * Finds the FondosEmergencias model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return FondosEmergencias the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = FondosEmergencias::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
