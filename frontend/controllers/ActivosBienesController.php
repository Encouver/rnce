<?php

namespace frontend\controllers;

use common\models\a\ActivosActivosBiologicos;
use common\models\a\ActivosActivosIntangibles;
use common\models\a\ActivosConstruccionesInmuebles;
use common\models\a\ActivosDatosImportaciones;
use common\models\a\ActivosDeterioros;
use common\models\a\ActivosDocumentosRegistrados;
use common\models\a\ActivosFabricacionesMuebles;
use common\models\a\ActivosFacturas;
use common\models\a\ActivosInmuebles;
use common\models\a\ActivosMuebles;
use common\models\a\ConstruccionesInmuebles;
use common\models\a\DatosImportaciones;
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

        $modelDatosImportacion = null;

        $modelBienTipo = new ActivosInmuebles();
        $model->sys_tipo_bien_id = 1;

        $modelFactura = null;

        $modelDocumento = null;

        $modelDeterioro = new ActivosDeterioros();

        //$model->contratista_id = Yii::$app->user->identity->contratista_id;
        //$model->principio_contable = 1;

        if ($model->load(Yii::$app->request->post())) {

            $modelDatosImportacion = new ActivosDatosImportaciones();

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

            $modelFactura = new ActivosFacturas();

            $modelDocumento = new ActivosDocumentosRegistrados(['scenario'=>'bien']);

            $modelDeterioro = new ActivosDeterioros();

            $flag = true;
            $transaction = \Yii::$app->db->beginTransaction();
            try {
                $model->contratista_id = Yii::$app->user->identity->contratista_id;
                 if($flag = $model->save())
                {
                    // Factura.
                    if($model->factura && $modelFactura->load(Yii::$app->request->post())) {
                        $modelFactura->bien_id = $model->id;
                        $flag = $flag and $modelFactura->save();
                    }

                    // Documento Registrado
                    if($model->documento && $modelDocumento->load(Yii::$app->request->post())) {
                        $modelDocumento->bien_id = $model->id;
                        $flag = $flag and $modelDocumento->save();
                    }

                    // En caso de Adquisición Datos de Importación.
                    if($model->origen_id ==2 && !$model->nacional && $modelDatosImportacion->load(Yii::$app->request->post())) {
                        $modelDatosImportacion->bien_id = $model->id;
                        $flag = $flag and $modelDatosImportacion->save();
                    }

                    // Tipo de Bien
                    if ($modelBienTipo->load(Yii::$app->request->post())) {

                        $modelBienTipo->bien_id = $model->id;
                        $flag = $flag && $modelBienTipo->save();
                    }

                    // Deterioro
                    if ($modelBienTipo->load(Yii::$app->request->post())) {

                        $modelBienTipo->bien_id = $model->id;
                        $flag = $flag && $modelBienTipo->save();
                    }
                }

                if($flag)
                {
                    $transaction->commit();
                    //return $this->redirect(['view', 'id' => $model->id]);
                    return $this->redirect(['index', 'id' => $model->id]);
                }
                $transaction->rollBack();
            } catch (Exception $e) {
                $transaction->rollBack();
            }
            //return $this->redirect(['view', 'id' => $model->id]);
        } //else {

            return $this->render('create', [
                'model' => $model,'modelBienTipo'=> $modelBienTipo, 'modelDatosImportacion'=>$modelDatosImportacion, 'modelFactura'=>$modelFactura,'modelDocumento'=>$modelDocumento,
                'modelDeterioro'=>$modelDeterioro,
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

        $modelBienTipo = $model->getBienTipo();

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
        }

  /*      if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {*/
            return $this->render('update', [
                'model' => $model,'modelBienTipo'=> $modelBienTipo
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
