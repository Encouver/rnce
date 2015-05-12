<?php

namespace frontend\controllers;

use Yii;
use common\models\p\ComisariosAuditores;
use app\models\ComisariosAuditoresSearch;
use common\components\BaseController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ComisariosAuditoresController implements the CRUD actions for ComisariosAuditores model.
 */
class ComisariosAuditoresController extends BaseController
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
     * Lists all ComisariosAuditores models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ComisariosAuditoresSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ComisariosAuditores model.
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
     * Creates a new ComisariosAuditores model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ComisariosAuditores();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
     public function actionCrearcomisario()
    {
        $comisario = new ComisariosAuditores();
         $searchModel = new ComisariosAuditoresSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
       
    
        return $this->render('_comisarios', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'comisario' => $comisario,
        ]);
      
        
    }
    
    
    public function actionComisario(){
        
        
        
         $comisario = new ComisariosAuditores();
        $usuario= \common\models\p\User::findOne(Yii::$app->user->identity->id);
        if ( $comisario->load(Yii::$app->request->post())) {
            
             $transaction = \Yii::$app->db->beginTransaction();
           try {
                
            if($comisario->declaracion_jurada==false){
               return "Para continuar debe aceptar la declaracion jurada";
            }
            
            $comisario->contratista_id = $usuario->contratista_id;
            $comisario->comisario=true;
            $comisario->auditor=false;
           $comisario->responsable_contabilidad=false;
           $comisario->informe_conversion=false;
          
               if ( $comisario->save()) {
           

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
     * Updates an existing ComisariosAuditores model.
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
     * Deletes an existing ComisariosAuditores model.
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
     * Finds the ComisariosAuditores model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ComisariosAuditores the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ComisariosAuditores::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
