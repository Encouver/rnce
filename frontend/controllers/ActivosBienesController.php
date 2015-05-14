<?php

namespace frontend\controllers;

use common\models\a\ActivosActivosBiologicos;
use common\models\a\ActivosActivosIntangibles;
use common\models\a\ActivosConstruccionesInmuebles;
use common\models\a\ActivosFabricacionesMuebles;
use common\models\a\ActivosInmuebles;
use common\models\a\ActivosMuebles;
use common\models\a\ConstruccionesInmuebles;
use common\models\a\FabricacionesMuebles;
use common\models\a\Inmuebles;
use common\models\a\Muebles;
use Yii;
use common\models\a\ActivosBienes;
use app\models\ActivosBienesSearch;
use common\components\BaseController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ActivosBienesController implements the CRUD actions for ActivosBienes model.
 */
class ActivosBienesController extends BaseController
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
     * Lists all ActivosBienes models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ActivosBienesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ActivosBienes model.
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
     * Creates a new ActivosBienes model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ActivosBienes();

        $bienTipo = null;

        $model->contratista_id = Yii::$app->user->identity->contratista_id;
        $model->principio_contable = 1;

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            switch($model->sysTipoBien->sys_clasificacion_bien_id){
                case 1:
                    $bienTipo = new ActivosInmuebles();
                    break;
                case 2:
                    $bienTipo = new ActivosMuebles();
                    break;
                case 3:
                    if($model->sys_tipo_bien_id == 8)
                        $bienTipo = new ActivosConstruccionesInmuebles();
                    if($model->sys_tipo_bien_id == 9)
                        $bienTipo = new ActivosFabricacionesMuebles();
                    break;
                case 4:
                    $bienTipo = new ActivosActivosBiologicos();
                    break;
                case 5:
                    $bienTipo = new ActivosActivosIntangibles();
                    break;
                default:
                    break;
            }
            if ($bienTipo->load(Yii::$app->request->post()) && $model->validate()) {


            }
            //return $this->redirect(['view', 'id' => $model->id]);
        } //else {

            return $this->render('create', [
                'model' => $model,'bienTipo'=> $bienTipo
            ]);
       // }
    }

    /**
     * Updates an existing ActivosBienes model.
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
     * Deletes an existing ActivosBienes model.
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
     * Finds the ActivosBienes model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ActivosBienes the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ActivosBienes::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
