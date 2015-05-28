<?php

namespace frontend\controllers;

use Yii;
use common\models\p\ObjetosSociales;
use common\models\a\ActivosDocumentosRegistrados;
use app\models\ObjetosSocialesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ObjetosSocialesController implements the CRUD actions for ObjetosSociales model.
 */
class ObjetosSocialesController extends Controller
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
     * Lists all ObjetosSociales models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ObjetosSocialesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $model = new ObjetosSociales();
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model'=> $model,
        ]);
    }

    /**
     * Displays a single ObjetosSociales model.
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
     * Creates a new ObjetosSociales model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ObjetosSociales();

        if($model->existeregistro()){
            Yii::$app->session->setFlash('error','Usuario posee objeto social ó debe crear un documento registrado');
            return $this->redirect(['index']);
                }
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
               Yii::$app->session->setFlash('success','Objeto Social guardado con exito');
                    return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
    public function actionCrearobjetoacta()
    {
        $objeto_social = new ObjetosSociales();

        
            return $this->render('objetos_actas', [
                'objeto_social' => $objeto_social,
            ]);
        
    }
     public function actionObjetoacta(){
        
      $objeto_acta = new ObjetosSociales();
      
        $usuario= \common\models\p\User::findOne(Yii::$app->user->identity->id);
       
        if ( $objeto_acta->load(Yii::$app->request->post())) {
            
             $transaction = \Yii::$app->db->beginTransaction();
             
           try {
                $registro = ActivosDocumentosRegistrados::findOne(['contratista_id'=>$usuario->contratista_id, 'tipo_documento_id'=>1]);
                
            if($objeto_acta->descripcion==null){
                 $transaction->rollBack();
                return "Debe ingresar objeto social"; 
            }
           
            $objeto_acta->contratista_id = $usuario->contratista_id;
            $objeto_acta->documento_registrado_id= $registro->id;
            $objeto_acta->tipo_objeto= "PRINCIPAL"; 
            
               if ($objeto_acta->save()) {
           

                               $transaction->commit();
                               return "Datos guardados con exito";
                               


                   }else{
                       
                        $transaction->rollBack();
                       return "Datos no guardados";
                   }
             
             
           } catch (Exception $e) {
               $transaction->rollBack();
           }
        }
        
        
    }

    /**
     * Updates an existing ObjetosSociales model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
             Yii::$app->session->setFlash('success','Objeto Social actualizado con exito');
                    return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing ObjetosSociales model.
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
     * Finds the ObjetosSociales model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ObjetosSociales the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ObjetosSociales::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
