<?php

namespace frontend\controllers;

use Yii;
use common\models\p\Acciones;
use common\models\a\DocumentosRegistrados;
use app\models\AccionesSearch;
use common\components\BaseController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AccionesController implements the CRUD actions for Acciones model.
 */
class AccionesController extends BaseController
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
     * Lists all Acciones models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AccionesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Acciones model.
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
     * Creates a new Acciones model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Acciones();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
    public function actionAccionsuscritaacta()
    {
        $suscrita_acta = new Acciones();

       
        if ( $suscrita_acta->load(Yii::$app->request->post())) {
            
             $transaction = \Yii::$app->db->beginTransaction();
             
           try {
                $registro = DocumentosRegistrados::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id, 'sys_tipo_registro_id'=>1]);
                
            if($suscrita_acta->numero_comun==null || $suscrita_acta->valor_comun==null){
                 $transaction->rollBack();
                return "Debe ingresar ambos datos"; 
            }
           
            $suscrita_acta->contratista_id = $usuario->contratista_id;
            $suscrita_acta->documento_registrado_id= $registro->id;
            
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
     * Updates an existing Acciones model.
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
     * Deletes an existing Acciones model.
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
     * Finds the Acciones model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Acciones the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Acciones::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
