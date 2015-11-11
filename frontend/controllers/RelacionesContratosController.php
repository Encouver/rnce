<?php

namespace frontend\controllers;

use common\components\BaseController;
use Yii;
use common\models\p\RelacionesContratos;
use common\models\p\ContratosFacturas;
use app\models\ContratosFacturasSearch;
use app\models\ContratosValuacionesSearch;
use common\models\p\ContratosValuaciones;
use app\models\RelacionesContratosSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\Query;
use common\models\p\PersonasJuridicas;

/**
 * RelacionesContratosController implements the CRUD actions for RelacionesContratos model.
 */
class RelacionesContratosController extends BaseController
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
     * Lists all RelacionesContratos models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RelacionesContratosSearch();
        $searchModel->contratista_id = Yii::$app->user->identity->contratista_id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->sort = false;

        $searchModelFactura = new ContratosFacturasSearch();
        //$searchModelFactura->contratista_id = Yii::$app->user->identity->contratista_id;
        $dataProviderFactura = $searchModelFactura->search(Yii::$app->request->queryParams);
        $dataProviderFactura->sort = false;

        $modelcFactura= new ContratosFacturas();
        $searchModelValuacion = new ContratosValuacionesSearch();
       // $searchModelValuacion->contratista_id = Yii::$app->user->identity->contratista_id != null?Yii::$app->user->identity->contratista_id:0;
        $dataProviderValuacion = $searchModelValuacion->search(Yii::$app->request->queryParams);
        $dataProviderValuacion->sort = false;

        $modelcValuacion= new ContratosValuaciones();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'searchModelFactura' => $searchModelFactura,
            'dataProviderFactura' => $dataProviderFactura,
            'modelcFactura'=>$modelcFactura,
            'searchModelValuacion' => $searchModelValuacion,
            'dataProviderValuacion' => $dataProviderValuacion,
            'modelcValuacion'=>$modelcValuacion,
        ]);
    }
    public function actionRelacionesContratosLista($q = null,$id = null,$ver) {
       
         $buscar="nombre_proyecto ILIKE "."'%" . $q ."%' and contratista_id=".Yii::$app->user->identity->contratista_id." and tipo_contrato='OBRAS'";
         if($ver=="factura"){
             $buscar="nombre_proyecto ILIKE "."'%" . $q ."%' and contratista_id=".Yii::$app->user->identity->contratista_id." and (tipo_contrato='BIENES' or tipo_contrato='SERVICIOS')";
         }
       
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = ['results' => ['id' => '', 'text' => '']];
        if (!is_null($q)) {
            $query = new Query;
            $query->select('id, nombre_proyecto AS text')
                ->from('relaciones_contratos')
                ->where($buscar)
                ->limit(20);
            $command = $query->createCommand();
            $data = $command->queryAll();
            $out['results'] = array_values($data);
        }
        elseif ($id > 0) {
            $out['results'] = ['id' => $id, 'text' => RelacionesContratos::find($id)->nombre_proyecto];
        }
        return $out;
    }
    /**
     * Displays a single RelacionesContratos model.
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
     * Creates a new RelacionesContratos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new RelacionesContratos();
        $modelJuridica= new PersonasJuridicas();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
             
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
                'modelJuridica'=>$modelJuridica,
            ]);
        }
    }
    
      public function actionCrearrelacioncontrato()
    {
        $relacion_contrato = new RelacionesContratos();
       $modelJuridica= new PersonasJuridicas();
            return $this->render('_relaciones_contratos', [
                'relacion_contrato' => $relacion_contrato,
                'modelJuridica'=>$modelJuridica,
                    ]);
        
    }
      public function actionTiposector($id)
              
   {
          
          if($id=="OBRAS"){
              
           return $this->renderAjax('_contratos_valuaciones',['contrato_valuacion' => (empty($contrato_valuacion)) ? [new ContratosValuaciones] : $contrato_valuacion]);

          }else{ 
              
         return $this->renderAjax('_contratos_facturas',['contrato_factura' => (empty($contrato_factura)) ? [new ContratosFacturas] : $contrato_factura]);
              
          }


   }
     public function actionRelacioncontrato()
              
   {
           $usuario= \common\models\p\User::findOne(Yii::$app->user->identity->id);
           $relacion_contrato= new RelacionesContratos();
           
           if($relacion_contrato->load(Yii::$app->request->post())){
               $relacion_contrato->contratista_id= $usuario->contratista_id;
            
               
               $transaction = \Yii::$app->db->beginTransaction();
               try{
                   if($relacion_contrato->tipo_sector==''){
                       $relacion_contrato->tipo_sector=null;
                   }
                   
                   if (! ($relacion_contrato->save())) {

                                $transaction->rollBack();
                                return "error en la carga de de datos de los contratos";
                                
                            }
                    if ($relacion_contrato->tipo_contrato=="OBRAS"){
                        $contrato_valuacion = [new ContratosValuaciones];
                        $contrato_valuacion = Model::createMultiple(ContratosValuaciones::classname());
                        Model::loadMultiple($contrato_valuacion, Yii::$app->request->post());
                         foreach ($contrato_valuacion as $carga_valuacion) {
                             
                             $valuaciones= new ContratosValuaciones();

                              $valuaciones->orden_valuacion = $carga_valuacion->orden_valuacion;
                              $valuaciones->monto = $carga_valuacion->monto;
                              $valuaciones->relacion_contrato_id= $relacion_contrato->id;

                             if (! ($valuaciones->save())) {

                                $transaction->rollBack();
                                return "error en la carga de las valuaciones";
                                break;
                            }

                             
                         }
                    }else{
                         $contrato_factura = [new ContratosFacturas];
                        $contrato_factura = Model::createMultiple(ContratosFacturas::classname());
                        Model::loadMultiple($contrato_factura, Yii::$app->request->post());
                        
                          foreach ($contrato_factura as $carga_factura) {
                             $facturas= new ContratosFacturas();

                              $facturas->orden_factura = $carga_factura->orden_factura;
                              $facturas->monto = $carga_factura->monto;
                              $facturas->relacion_contrato_id= $relacion_contrato->id;

                             if (! ($flag = $facturas->save(false))) {

                                $transaction->rollBack();
                                return "error en la carga de las facturas";
                                break;
                            }

                             
                         }
                    }
                    
                    $transaction->commit();
                    return "Datos guardados con exito";
                    
            }  catch (Exception $e) {
               $transaction->rollBack();
           }
        }      
   }
    /**
     * Updates an existing RelacionesContratos model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
         $modelJuridica= new PersonasJuridicas();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
                'modelJuridica'=>$modelJuridica,
            ]);
        }
    }

    /**
     * Deletes an existing RelacionesContratos model.
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
     * Finds the RelacionesContratos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return RelacionesContratos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = RelacionesContratos::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
