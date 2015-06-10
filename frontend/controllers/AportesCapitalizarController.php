<?php

namespace frontend\controllers;

use Yii;
use common\models\p\AportesCapitalizar;
use app\models\AportesCapitalizarSearch;
use common\models\p\OrigenesCapitales;
use common\components\BaseController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AportesCapitalizarController implements the CRUD actions for AportesCapitalizar model.
 */
class AportesCapitalizarController extends BaseController
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
     * Lists all AportesCapitalizar models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AportesCapitalizarSearch();
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
     * Displays a single AportesCapitalizar model.
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
     * Creates a new AportesCapitalizar model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AportesCapitalizar();
        if($model->existeregistro()){
            
            Yii::$app->session->setFlash('error','Usuario posee un aporte por capitalizar en curso o no ha creado una modificacion');
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
     * Updates an existing AportesCapitalizar model.
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
                        $modelaux= $this->findModel($model->id);
                        if($modelaux->capital>$model->capital){
                            $origen_capital= OrigenesCapitales::find()->where(['documento_registrado_id'=>$model->documento_registrado_id,'tipo_origen'=>'APORTE_CAPITALIZAR'])->orderBy('monto')->all();
                                if(isset($origen_capital)){
                                    foreach ($origen_capital as $origen) {
                                        if($origen->sumarmonto(false)>$model->capital){
                                            if(!$origen->delete()){
                                                $transaction->rollBack();
                                                Yii::$app->session->setFlash('error','Error al eliminar el origen de capital');
                                                return $this->redirect(['pagocapital']);
                                            }   
                                        }
                                    }
                                }
                        
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
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing AportesCapitalizar model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $transaction = \Yii::$app->db->beginTransaction();
        try {
             $origen_capital= OrigenesCapitales::findAll(['documento_registrado_id'=>$model->documento_registrado_id,'tipo_origen'=>'APORTE_CAPITALIZAR']);
            if(isset($origen_capital)){
                foreach ($origen_capital as $origen) {
                    if(!$origen->delete()){
                        $transaction->rollBack();
                        Yii::$app->session->setFlash('error','Error al eliminar el origen de capital asociado');
                        return $this->redirect(['index']);
                         
                        
                    }
                    
                }
            }
            if(!$model->delete()){
                $transaction->rollBack();
                Yii::$app->session->setFlash('error','Error al eliminar el aporte');
                
            }else{
                $transaction->commit();
                 return $this->redirect(['index']);
            }
            
        } catch (Exception $e) {
            $transaction->rollBack();
        }
    }

    /**
     * Finds the AportesCapitalizar model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AportesCapitalizar the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AportesCapitalizar::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
