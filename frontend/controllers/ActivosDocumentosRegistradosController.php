<?php

namespace frontend\controllers;

use Yii;
use common\models\a\ActivosDocumentosRegistrados;
use app\models\ActivosDocumentosRegistrados as ActivosDocumentosRegistradosSearch;
use common\components\BaseController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ActivosDocumentosRegistradosController implements the CRUD actions for ActivosDocumentosRegistrados model.
 */
class ActivosDocumentosRegistradosController extends BaseController
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
     * Lists all ActivosDocumentosRegistrados models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ActivosDocumentosRegistradosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ActivosDocumentosRegistrados model.
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
     * Creates a new ActivosDocumentosRegistrados model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ActivosDocumentosRegistrados();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
    public function actionCrearacta()
    {
        $registro_acta = new DocumentosRegistrados();
            
          
            return $this->render('registros_actas', [
                'registro_acta' => $registro_acta,
            ]);
        
    }
     public function actionRegistroacta(){
        
       $registro_acta = new ActivosDocumentosRegistrados();
      
        $usuario= \common\models\p\User::findOne(Yii::$app->user->identity->id);
        if ( $registro_acta->load(Yii::$app->request->post())) {
            
             $transaction = \Yii::$app->db->beginTransaction();
             
           try {
               
            if($registro_acta->fecha_asamblea==null){
                 $transaction->rollBack();
                return "Debe ingresar fecha asamblea"; 
            }
           
            $registro_acta->contratista_id = $usuario->contratista_id;
            $registro_acta->sys_tipo_registro_id=1;
            $registro_acta->tipo_documento_id=1;
         
               if ( $registro_acta->save()) {
           

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
     * Updates an existing ActivosDocumentosRegistrados model.
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
     * Deletes an existing ActivosDocumentosRegistrados model.
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
     * Finds the ActivosDocumentosRegistrados model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ActivosDocumentosRegistrados the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ActivosDocumentosRegistrados::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
