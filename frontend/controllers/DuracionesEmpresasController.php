<?php

namespace frontend\controllers;

use Yii;
use common\models\p\DuracionesEmpresas;
use common\models\a\DocumentosRegistrados;
use app\models\DuracionesEmpresasSearch;
use common\components\BaseController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DuracionesEmpresasController implements the CRUD actions for DuracionesEmpresas model.
 */
class DuracionesEmpresasController extends BaseController
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
     * Lists all DuracionesEmpresas models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DuracionesEmpresasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single DuracionesEmpresas model.
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
     * Creates a new DuracionesEmpresas model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new DuracionesEmpresas();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
     public function actionCrearduracionacta()
    {
        $duracion_empresa = new DuracionesEmpresas();
            
          
            return $this->render('duraciones_actas', [
                'duracion_empresa' => $duracion_empresa,
            ]);
        
    }
     public function actionDuracionacta(){
        
       $duracion_acta= new DuracionesEmpresas();
      
        $usuario= \common\models\p\User::findOne(Yii::$app->user->identity->id);
       
        if ( $duracion_acta->load(Yii::$app->request->post())) {
            
             $transaction = \Yii::$app->db->beginTransaction();
             
           try {
                $registro = DocumentosRegistrados::findOne(['contratista_id'=>$usuario->contratista_id, 'sys_tipo_registro_id'=>1]);
                
            if($duracion_acta->fecha_vencimiento==null){
                 $transaction->rollBack();
                return "Debe ingresar fecha vencimiento"; 
            }
           
            $duracion_acta->contratista_id = $usuario->contratista_id;
            $duracion_acta->documento_registrado_id= $registro->id;
            
               if ($duracion_acta->save()) {
           

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
     * Updates an existing DuracionesEmpresas model.
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
     * Deletes an existing DuracionesEmpresas model.
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
     * Finds the DuracionesEmpresas model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return DuracionesEmpresas the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DuracionesEmpresas::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
