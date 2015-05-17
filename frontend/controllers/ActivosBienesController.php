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
use yii\db\Exception;
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

        $modelBienTipo = new ActivosInmuebles();

        //$model->contratista_id = Yii::$app->user->identity->contratista_id;
        //$model->principio_contable = 1;

        if ($model->load(Yii::$app->request->post())) {
            switch($model->sysTipoBien->sys_clasificacion_bien_id){
                case 1:
                    $modelBienTipo = new ActivosInmuebles();
                    break;
                case 2:
                    $modelBienTipo = new ActivosMuebles();
                    break;
                case 3:
                    if($model->sys_tipo_bien_id == 8)
                        $modelBienTipo = new ActivosConstruccionesInmuebles();
                    if($model->sys_tipo_bien_id == 9)
                        $modelBienTipo = new ActivosFabricacionesMuebles();
                    break;
                case 4:
                    $modelBienTipo = new ActivosActivosBiologicos();
                    break;
                case 5:
                    $modelBienTipo = new ActivosActivosIntangibles();
                    break;
                default:
                    break;
            }
            if ($modelBienTipo->load(Yii::$app->request->post()) && $model->validate() ) {

                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if($model->save()){

                        $modelBienTipo->bien_id = $model->id;
                        if($modelBienTipo->save()) {
                            $transaction->commit();
                            return $this->redirect(['view', 'id' => $model->id]);
                        }else
                            $transaction->rollBack();

                    }

                } catch (Exception $e) {
                    $transaction->rollBack();
                }


            }
            //return $this->redirect(['view', 'id' => $model->id]);
        } //else {

            return $this->render('create', [
                'model' => $model,'modelBienTipo'=> $modelBienTipo
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

        $modelActualBienTipo = $model->getBienTipo();

        if ($model->load(Yii::$app->request->post())) {
            switch($model->sysTipoBien->sys_clasificacion_bien_id){
                case 1:
                    $modelNuevoBienTipo = new ActivosInmuebles();
                    break;
                case 2:
                    $modelNuevoBienTipo = new ActivosMuebles();
                    break;
                case 3:
                    if($model->sys_tipo_bien_id == 8)
                        $modelNuevoBienTipo = new ActivosConstruccionesInmuebles();
                    if($model->sys_tipo_bien_id == 9)
                        $modelNuevoBienTipo = new ActivosFabricacionesMuebles();
                    break;
                case 4:
                    $modelNuevoBienTipo = new ActivosActivosBiologicos();
                    break;
                case 5:
                    $modelNuevoBienTipo = new ActivosActivosIntangibles();
                    break;
                default:
                    break;
            }
            if ($modelNuevoBienTipo->load(Yii::$app->request->post()) && $model->validate() ) {

                $transaction = \Yii::$app->db->beginTransaction();
                try {

                    if($model->save() && $modelActualBienTipo->delete()){

                        $modelNuevoBienTipo->bien_id = $model->id;
                        if($modelNuevoBienTipo->save()) {
                            $modelActualBienTipo = $modelNuevoBienTipo;
                                $transaction->commit();
                                return $this->redirect(['view', 'id' => $model->id]);

                        }else
                            $transaction->rollBack();

                    }

                } catch (Exception $e) {
                    $transaction->rollBack();
                }


            }
            //return $this->redirect(['view', 'id' => $model->id]);
        }

  /*      if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {*/
            return $this->render('update', [
                'model' => $model,'modelBienTipo'=> $modelActualBienTipo
            ]);
    //    }
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
