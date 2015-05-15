<?php

namespace frontend\controllers;

use Yii;
use common\models\p\RelacionesContratos;
use common\models\p\ContratosFacturas;
use common\models\p\ContratosValuaciones;
use app\models\RelacionesContratosSearch;
use common\models\p\SysNaturalesJuridicas;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\p\Model;

/**
 * RelacionesContratosController implements the CRUD actions for RelacionesContratos model.
 */
class RelacionesContratosController extends Controller
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
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
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
        $model2  = new SysNaturalesJuridicas();

        if ($model->load(Yii::$app->request->post()) && $model2->load(Yii::$app->request->post())) {
            
             $model2->juridica=true;
            $model2->sys_status=true;
            
            $model2->save();
            
            
            $model->contratista_id = 2;
            $model->natural_juridica_id = $model2->id;
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'model2'=>$model2,
            ]);
        }
    }
    
      public function actionCrearrelacioncontrato()
    {
        $relacion_contrato = new RelacionesContratos();
       
            return $this->render('_relaciones_contratos', [
                'relacion_contrato' => $relacion_contrato]);
        
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
                   
                   
                   if (! ($flag = $relacion_contrato->save(false))) {

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

                             if (! ($flag = $valuaciones->save(false))) {

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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
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
