<?php

namespace frontend\controllers;

use Yii;
use common\models\p\ModificacionesActas;
use app\models\ModificacionesActasSearch;
use common\components\BaseController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ModificacionesActasController implements the CRUD actions for ModificacionesActas model.
 */
class ModificacionesActasController extends BaseController
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
     * Lists all ModificacionesActas models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ModificacionesActasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ModificacionesActas model.
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
     * Creates a new ModificacionesActas model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ModificacionesActas();
         if($model->existeregistro()){
            Yii::$app->session->setFlash('error','No existe una modificacion activa');
            return $this->redirect(['index']);
                }
        if(isset($_POST['objeto'])){
             $valores=$_POST['objeto'];
            $cantidad= count($valores);
            if($cantidad<=3){
                  for ($i = 0; $i < $cantidad; $i++) {

          switch ($valores[$i]) {
                case "aumento_capital":
                    $model->aumento_capital=true;
                    break;
                case "aporte_capitalizar":
                     $model->aporte_capitalizar=true;
                    break;
                case "pago_capital":
                    $model->pago_capitaL=true;
                    break;
        
                case "junta_directiva":
                    $model->junta_directiva=true;
                    break;
                case "fondo_emergencia":
                   $model->fondo_emergencia=true;
                    break;
                case "limitacion_capital":
                    $model->limitacion_capita=true;
                    break;
                case "disminucion_capital":
                     $model->disminucion_capital=true;

                    break;
                case "coreccion_monetaria":
                    $model->coreccion_monetaria=true;

                    break;
                case "razon_social":
                    $model->razon_social=true;
                    break;
                case "modificacion_balance":
                   $model->modificacion_balance=true;
                    break;
                case "decreto_div_excedente":
                    $model->decreto_div_excedente=true;
                    break;
                case "fusion_empresarial":
                    $model->fusion_empresarial=true;
                    break;
                case "venta_accion":
                   $model->venta_accion=true;

                    break;
                case "reintegro_perdida":
                     $model->reintegro_perdida=true;
                    break;
                case "limitacion_capital_afectado":
                    $model->limitacion_capital_afectado=true;
                    break;
                case "cierre_ejercicio":
                    $model->cierre_ejercicio=true;
                    break;
                case "duracion_empresa":
                    $model->duracion_empresa=true;
                    break;
                case "representante_legal":
                    $model->representante_legal=true;

                    break;
                case "objeto_social":
                    $model->objeto_social=true;
                    break;
                case "domicilio_fiscal":
                    $model->domicilio_fiscal=true;
                    break;
                case "denominacion_comercial":
                     $model->denominacion_comercial=true;
                    break;

                default:
                    break;
                    }
                }
                $model->save();
                 Yii::$app->session->setFlash('success','Modificacion acta guardada con exito');
                  return $this->redirect(['index']);
                
            }else{
                Yii::$app->session->setFlash('error','El maximo de modificaciones debe ser 3');
                return $this->render('create', [
                    'model'=>$model,
            ]);
            }
            
             

           
            }else{
                 return $this->render('create', [
                     'model'=>$model,
            ]);
            }
    }

    /**
     * Updates an existing ModificacionesActas model.
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
     * Deletes an existing ModificacionesActas model.
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
     * Finds the ModificacionesActas model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ModificacionesActas the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ModificacionesActas::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
