<?php

namespace frontend\controllers;

use Yii;
use common\models\p\Sucursales;
use app\models\SucursalesSearch;
use common\models\p\Direcciones;
use common\components\BaseController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\p\Model;

/**
 * SucursalesController implements the CRUD actions for Sucursales model.
 */
class SucursalesController extends BaseController
{
    public function behaviors()
    {
        return array_merge(parent::behaviors(),[
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ]);
    }

    /**
     * Lists all Sucursales models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SucursalesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Sucursales model.
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
     * Creates a new Sucursales model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Sucursales();
        $direccion = new Direcciones();

        if ($model->load(Yii::$app->request->post()) && $direccion->load(Yii::$app->request->post())) {
            $transaction = \Yii::$app->db->beginTransaction();
           try {
                $flag =false;
           if ($direccion->save()) {
               $model->contratista_id=Yii::$app->user->identity->contratista_id;
               $model->direccion_id=$direccion->id;
               if($model->save()){
                    $transaction->commit();
                   return $this->redirect(['index']);
               }else{
                   $transaction->rollBack();
                   Yii::$app->session->setFlash('error','Error en la carga de la sucursal');
                   return $this->render('create', [
                        'model'=>$model,
                        'direccion' => $direccion,
                        ]);
               }
               
           }else{
               $transaction->rollBack();
                 Yii::$app->session->setFlash('error','Error en la carga de la direccion');
                   return $this->render('create', [
                        'model'=>$model,
                        'direccion' => $direccion,
                        ]);
           }
           
           
           }catch (Exception $e) {
               $transaction->rollBack();
           }
        } else {
            return $this->render('create', [
                'model' => $model,
                'direccion'=>$direccion
            ]);
        }
    }
    
   
    /**
     * Updates an existing Sucursales model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $direccion = Direcciones::findOne($model->direccion_id);
        if ($model->load(Yii::$app->request->post()) && $direccion->load(Yii::$app->request->post())) {
            $transaction = \Yii::$app->db->beginTransaction();
           try {
                $flag =false;
           if ($direccion->save()) {
               $model->contratista_id=Yii::$app->user->identity->contratista_id;
               $model->direccion_id=$direccion->id;
               if($model->save()){
                    $transaction->commit();
                   return $this->redirect(['index']);
               }else{
                   $transaction->rollBack();
                   Yii::$app->session->setFlash('error','Error en la carga de la sucursal');
                   return $this->render('update', [
                        'model'=>$model,
                        'direccion' => $direccion,
                        ]);
               }
               
           }else{
               $transaction->rollBack();
                 Yii::$app->session->setFlash('error','Error en la carga de la direccion');
                   return $this->render('update', [
                        'model'=>$model,
                        'direccion' => $direccion,
                        ]);
           }
           
           
           }catch (Exception $e) {
               $transaction->rollBack();
           }
   
        } else {
            return $this->render('update', [
                'model' => $model,
                'direccion'=>$direccion
            ]);
        }
    }
    

    /**
     * Deletes an existing Sucursales model.
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
     * Finds the Sucursales model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Sucursales the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Sucursales::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
