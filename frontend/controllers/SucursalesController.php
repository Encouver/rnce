<?php

namespace frontend\controllers;

use Yii;
use common\models\p\Sucursales;
use app\models\SucursalesSearch;
use common\models\p\PersonasNaturales;
use common\models\p\Direcciones;
use common\models\p\SysNaturalesJuridicas;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SucursalesController implements the CRUD actions for Sucursales model.
 */
class SucursalesController extends Controller
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
        $model2 = new Direcciones();
        $model3  = new PersonasNaturales();
        $model4  = new SysNaturalesJuridicas();

        if ($model2->load(Yii::$app->request->post()) && $model3->load(Yii::$app->request->post())) {
             $model2->save();
             
             
            $model4->rif= $model3->rif;
            $model4->juridica= false;
            $model4->denominacion=$model3->primer_nombre.' '.$model3->primer_apellido;
            $model4->sys_status=true;
            $model4->save();
            
            $model3->sys_pais_id = 1;
            $model3->nacionalidad = "NACIONAL";
            $model3->creado_por = 1;
             $model3->save();
             
             $model->persona_natural_id =$model3->id;
             $model->direccion_id =$model2->id;
             $model->contratista_id =2;
             $model->save();
            
            
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'model2' => $model2,
                'model3' => $model3,
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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
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
