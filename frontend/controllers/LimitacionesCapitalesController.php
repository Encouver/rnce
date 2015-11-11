<?php

namespace frontend\controllers;

use Yii;
use common\models\p\LimitacionesCapitales;
use common\models\p\Acciones;
use app\models\LimitacionesCapitalesSearch;
use common\components\BaseController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * LimitacionesCapitalesController implements the CRUD actions for LimitacionesCapitales model.
 */
class LimitacionesCapitalesController extends BaseController
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
     * Lists all LimitacionesCapitales models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new LimitacionesCapitalesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->sort = false;

        $documento=$searchModel->Modificacionactual();
        if(isset($documento)){
            $searchModel->documento_registrado_id= $documento->documento_registrado_id;
          if($documento->limitacion_capital){
               $searchModel->afecta= false;
               $searchModel->reintegro= false;
          }else{
              if($documento->limitacion_capital_afectado){
               $searchModel->afecta= true;
               $searchModel->reintegro= false;
                }else{
                    $searchModel->afecta= false;
               $searchModel->reintegro= true;
                }
              
          }
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single LimitacionesCapitales model.
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
     * Creates a new LimitacionesCapitales model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new LimitacionesCapitales();
         if($model->existeregistro()){
            
            Yii::$app->session->setFlash('error','Usuario posee una limitacion en curso o no ha creado una modificacion');
            return $this->redirect(['index']);
        }

        if ($model->load(Yii::$app->request->post())) {
            if($model->afecta){
                $transaction = \Yii::$app->db->beginTransaction();
                    try {
                        
                            if ($model->save()) {
                                $accion = Acciones::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id,'suscrito'=>true,'actual'=>true]);
                                $accion_actual=Acciones::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id,'suscrito'=>true,'actual'=>false,'tipo_accion'=>'ACTUAL']);
                                if(isset($accion_actual)){
                                    $accion =$accion_actual;
                                }                   
                                if($accion->tipo_accion=='ACTUAL'){
                                    if(!$accion->delete()){
                                        $transaction->rollBack();
                                        // Yii::$app->session->setFlash('error','');
                                        return $this->render('create',['model'=>$model]);
                                    }
                                }
                                $accion= new Acciones();
                                $accion->numero_preferencial=$model->total_accion;
                                $accion->numero_comun=$model->total_accion_comun;
                                $accion->valor_preferencial=$model->valor_accion;
                                $accion->valor_comun=$model->valor_accion_comun;
                                 $accion->tipo_accion='ACTUAL';
                                $accion->suscrito=true;
                                $accion->capital=$model->total_capital;
                                $accion->documento_registrado_id=$model->documento_registrado_id;
                                 $accion->contratista_id=Yii::$app->user->identity->contratista_id;
                                if ($accion->save(false)) {
                                    $transaction->commit();
                                    return $this->redirect(['index']);
                                }else{
                                    $transaction->rollBack();
                                      return print_r($accion->getErrors());
                                    // Yii::$app->session->setFlash('error','');
                                    return $this->render('create',['model'=>$model]);
                                }
                            }else{
                                $transaction->rollBack();
                                 return print_r($model->getErrors());
                                //Yii::$app->session->setFlash('error','Erroren la carga del capital pagado');
                                return $this->render('create',['model'=>$model]);
                            }
                       
                        
                    } catch (Exception $e) {
                         $transaction->rollBack();
                    }
            }else{
                $model->save();
            }
            
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing LimitacionesCapitales model.
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
     * Deletes an existing LimitacionesCapitales model.
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
     * Finds the LimitacionesCapitales model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return LimitacionesCapitales the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = LimitacionesCapitales::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
