<?php

namespace frontend\controllers;

use app\models\ActivosMueblesSearch;
use common\models\a\ActivosActivosBiologicos;
use common\models\a\ActivosActivosIntangibles;
use common\models\a\ActivosConstruccionesInmuebles;
use common\models\a\ActivosDatosImportaciones;
use common\models\a\ActivosDepreciacionesAmortizaciones;
use common\models\a\ActivosDeterioros;
use common\models\a\ActivosDocumentosRegistrados;
use common\models\a\ActivosFabricacionesMuebles;
use common\models\a\ActivosFacturas;
use common\models\a\ActivosInmuebles;
use common\models\a\ActivosLicencias;
use common\models\a\ActivosMuebles;
use common\models\a\ActivosVehiculos;
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
     * Lists all ActivosBienes models.
     * @return mixed
     */
    public function actionMuebles()
    {
        $searchModel = new ActivosBienesSearch();
        $searchModelMuebles = new ActivosMueblesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('muebles', [
            'searchModel' => $searchModel,
            'searchModelMuebles' => $searchModelMuebles,
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

        $modelDatosImportacion = new ActivosDatosImportaciones();;

        $modelBienTipo = new ActivosInmuebles();
        $model->sys_tipo_bien_id = 1;

        $modelVehiculo = null;

        $modelLicencia = null;

        $modelFactura = new ActivosFacturas();

        $modelDocumento = new ActivosDocumentosRegistrados(['scenario'=>'bien-registro']);

        $modelDeterioro = new ActivosDeterioros();

        $modelDepreciacion = new ActivosDepreciacionesAmortizaciones();


        if ($model->load(Yii::$app->request->post())) {

            $modelDatosImportacion = new ActivosDatosImportaciones();

            switch($model->sysTipoBien->sys_clasificacion_bien_id){
                case 1:
                    $modelBienTipo = new ActivosInmuebles();
                    break;
                case 2:
                    $modelBienTipo = new ActivosMuebles();
                    if($model->sys_tipo_bien_id == 3)
                        $modelVehiculo = new ActivosVehiculos();
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
                    if($model->sys_tipo_bien_id == 15)
                        $modelLicencia = new ActivosLicencias();
                    break;
                default:
                    break;
            }

            $modelFactura = new ActivosFacturas();

            $modelDocumento = new ActivosDocumentosRegistrados(['scenario'=>'bien-registro']);

            $modelDeterioro = new ActivosDeterioros();

            $flag = true;
            $transaction = \Yii::$app->db->beginTransaction();
            try {
                //$model->contratista_id = Yii::$app->user->identity->contratista_id;

                $flag = $model->save();

                 if($flag)
                {
                    // Tipo de Bien
                    if ($modelBienTipo->load(Yii::$app->request->post()) ) {
                        $flag = $flag and $modelBienTipo->validate();
                        if($flag) {
                            $modelBienTipo->bien_id = $model->id;
                            $flag = $flag && $modelBienTipo->save();

                            if ($model->sys_tipo_bien_id == 3)
                                if ($modelVehiculo->load(Yii::$app->request->post()) and $flag) {
                                    $modelVehiculo->mueble_id = $modelBienTipo->id;
                                    $flag = $flag && $modelVehiculo->save();
                                }
                            if ($model->sys_tipo_bien_id == 15)
                                if ($modelLicencia->load(Yii::$app->request->post()) and $flag) {
                                    $modelLicencia->activo_intangible_id = $modelBienTipo->id;
                                    $flag = $flag && $modelLicencia->save();
                                }
                        }
                    }

                    // Depreciación
                    if ($modelDepreciacion->load(Yii::$app->request->post()) && $modelDepreciacion->validate()) {
                        if($flag) {
                            $modelDepreciacion->bien_id = $model->id;
                            $flag = $flag && $modelDepreciacion->save();
                        }
                    }

                    // Factura.
                    if($model->factura && $modelFactura->load(Yii::$app->request->post()) && $modelFactura->validate()) {
                        if($flag) {
                            $modelFactura->bien_id = $model->id;
                            $flag = $flag and $modelFactura->save();
                        }
                    }

                    // Documento Registrado
                    if($model->documento && $modelDocumento->load(Yii::$app->request->post()) && $modelDocumento->validate()) {
                        if($flag) {
                            $modelDocumento->bien_id = $model->id;
                            $flag = $flag and $modelDocumento->save();
                        }
                    }

                    // En caso de Adquisición Datos de Importación.
                    if($model->origen_id ==2 && !$model->nacional && $modelDatosImportacion->load(Yii::$app->request->post()) && $modelDatosImportacion->validate()) {
                        if($flag) {
                            $modelDatosImportacion->bien_id = $model->id;
                            $flag = $flag and $modelDatosImportacion->save();
                        }
                    }

                    // Deterioro
                    if ($modelDeterioro->load(Yii::$app->request->post()) && $modelDeterioro->validate()) {
                        if($flag) {
                            $modelDeterioro->bien_id = $model->id;
                            $flag = $flag && $modelDeterioro->save();
                        }
                    }
                }

                if($flag)
                {
                    $transaction->commit();
                    //return $this->redirect(['view', 'id' => $model->id]);
                    return $this->redirect(['index']);
                }
                $transaction->rollBack();
            } catch (Exception $e) {
                $transaction->rollBack();
            }
            //return $this->redirect(['view', 'id' => $model->id]);
        } //else {

            return $this->render('create', [
                'model' => $model,'modelBienTipo'=> $modelBienTipo, 'modelDatosImportacion'=>$modelDatosImportacion, 'modelFactura'=>$modelFactura,'modelDocumento'=>$modelDocumento,
                'modelDeterioro'=>$modelDeterioro, 'modelDepreciacion'=>$modelDepreciacion, 'modelVehiculo'=>$modelVehiculo, 'modelLicencia'=>$modelLicencia
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
     public function actionBienesLista($q = null, $id = null) {
    $buscar_bien= "bien.detalle ILIKE "."'%" . $q ."%' and bien.sys_tipo_bien_id=tipo.id";   
       
    \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
     $out = ['results' => ['id' => '', 'text' => '']];
    if (!is_null($q)) {
        $query = new \yii\db\Query;
        
        $query->select("bien.id, (tipo.nombre || ' - ' || bien.detalle) AS text")
            ->from('activos.bienes as bien, activos.sys_tipos_bienes as tipo')
            ->where($buscar_bien)
            ->limit(20);
        $command = $query->createCommand();
        $data = $command->queryAll();
        
        $out['results'] = array_values($data);
    }
    elseif ($id > 0) {
        $out['results'] = ['id' => $id, 'text' => ActivosBienes::find($id)->detalle];
    }
  
    return $out;
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
