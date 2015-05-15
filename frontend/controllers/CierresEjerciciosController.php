<?php

namespace frontend\controllers;

use Yii;
use common\models\p\CierresEjercicios;
use common\models\a\DocumentosRegistrados;
use app\models\CierresEjerciciosSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CierresEjerciciosController implements the CRUD actions for CierresEjercicios model.
 */
class CierresEjerciciosController extends Controller
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
     * Lists all CierresEjercicios models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CierresEjerciciosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CierresEjercicios model.
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
     * Creates a new CierresEjercicios model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CierresEjercicios();

        if ($model->load(Yii::$app->request->post())) {
            
            $model->contratista_id=2;
            $model->documento_registrado_id=1;
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
     public function actionCrearcierreacta()
    {
        $cierre_ejercicio = new CierresEjercicios();
            
          
            return $this->render('cierres_actas', [
                'cierre_ejercicio' => $cierre_ejercicio,
            ]);
        
    }
     public function actionCierreacta(){
        
        $cierre_acta = new CierresEjercicios();
      
        $usuario= \common\models\p\User::findOne(Yii::$app->user->identity->id);
       
        if ( $cierre_acta->load(Yii::$app->request->post())) {
            
             $transaction = \Yii::$app->db->beginTransaction();
             
           try {
                $registro = DocumentosRegistrados::findOne(['contratista_id'=>$usuario->contratista_id, 'sys_tipo_registro_id'=>1]);
                
            if($cierre_acta->fecha_cierre==null){
                 $transaction->rollBack();
                return "Debe ingresar fecha de cierre"; 
            }
           
            $cierre_acta->contratista_id = $usuario->contratista_id;
            $cierre_acta->documento_registrado_id= $registro->id;
            
               if ($cierre_acta->save()) {
           

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
     * Updates an existing CierresEjercicios model.
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
     * Deletes an existing CierresEjercicios model.
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
     * Finds the CierresEjercicios model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CierresEjercicios the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CierresEjercicios::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
