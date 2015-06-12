<?php

namespace frontend\controllers;

use Yii;
use common\models\p\DecretosDivExcedentes;
use app\models\DecretosDivExcedentesSearch;
use app\models\PagosAccionistasDecretosSearch;
use common\models\p\PagosAccionistasDecretos;
use common\components\BaseController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DecretosDivExcedentesController implements the CRUD actions for DecretosDivExcedentes model.
 */
class DecretosDivExcedentesController extends BaseController
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
     * Lists all DecretosDivExcedentes models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DecretosDivExcedentesSearch();
         $documento=$searchModel->Modificacionactual();
         $searchModelPago = new PagosAccionistasDecretosSearch();
       
        if(isset($documento)){
            $searchModel->documento_registrado_id= $documento->documento_registrado_id;
            $searchModelPago->documento_registrado_id= $documento->documento_registrado_id;
          
        }
         $dataProviderPago = $searchModelPago->search(Yii::$app->request->queryParams);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'searchModelPago' => $searchModelPago,
            'dataProviderPago' => $dataProviderPago,
            'documento'=>$documento,
        ]);
    }

    /**
     * Displays a single DecretosDivExcedentes model.
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
     * Creates a new DecretosDivExcedentes model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new DecretosDivExcedentes();
        if($model->existeregistro()){
            
            Yii::$app->session->setFlash('error','Usuario posee un decreto dividiendos en curso o no ha creado una modificacion');
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
     * Updates an existing DecretosDivExcedentes model.
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
     * Deletes an existing DecretosDivExcedentes model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $transaction = \Yii::$app->db->beginTransaction();
        try {
             $pago_decreto= PagosAccionistasDecretos::findAll(['decreto_div_excedente_id'=>$id]);
            if(isset($pago_decreto)){
                foreach ($pago_decreto as $pago) {
                    if(!$pago->delete()){
                        $transaction->rollBack();
                        Yii::$app->session->setFlash('error','Error al eliminar el pago de accionistas');
                        return $this->redirect(['index']);
                         
                        
                    }
                    
                }
            }
            if(!$model->delete()){
                $transaction->rollBack();
                Yii::$app->session->setFlash('error','Error al eliminar el decreto');
                
            }else{
                $transaction->commit();
                 return $this->redirect(['index']);
            }
            
        } catch (Exception $e) {
            $transaction->rollBack();
        }
    }

    /**
     * Finds the DecretosDivExcedentes model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return DecretosDivExcedentes the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DecretosDivExcedentes::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
