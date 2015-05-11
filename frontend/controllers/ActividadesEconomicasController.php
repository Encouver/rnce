<?php

namespace frontend\controllers;

use Yii;
use common\models\p\ActividadesEconomicas;
use app\models\ActividadesEconomicasSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ActividadesEconomicasController implements the CRUD actions for ActividadesEconomicas model.
 */
class ActividadesEconomicasController extends Controller
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
     * Lists all ActividadesEconomicas models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ActividadesEconomicasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ActividadesEconomicas model.
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
     * Creates a new ActividadesEconomicas model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ActividadesEconomicas();

        if ($model->load(Yii::$app->request->post())) {
            $model->contratista_id=2;
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
    
     public function actionCrearactividad()
    {
        $actividad_economica = new ActividadesEconomicas();
        return $this->render('_actividades_economicas',['actividad_economica' => $actividad_economica]);
    }
    
     public function actionActividadeconomica()
   {


        $actividad_economica = new ActividadesEconomicas();

        if ($actividad_economica->load(Yii::$app->request->post())) {
           $transaction = \Yii::$app->db->beginTransaction();
           try {
                $flag =false;


           $usuario= \common\models\p\User::findOne(Yii::$app->user->identity->id);
            $actividad_economica->contratista_id=  $usuario->contratista_id;
                   if ( $actividad_economica->save()) {


                               $transaction->commit();
                               return "Datos guardados con exito";
                               $flag = true;


                   }else{
                       return "Actividades economicas no guardadas";
                   }


               if(!$flag)
               {
                   $transaction->rollBack();
               }
           } catch (Exception $e) {
               $transaction->rollBack();
           }
       }else{
           return "Datos incompletos";
       }



   }

    /**
     * Updates an existing ActividadesEconomicas model.
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
     * Deletes an existing ActividadesEconomicas model.
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
     * Finds the ActividadesEconomicas model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ActividadesEconomicas the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ActividadesEconomicas::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
