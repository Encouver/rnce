<?php

namespace frontend\controllers;

use Yii;
use common\models\p\ModificacionesActas;
use common\models\p\AccionistasOtros;
use common\models\p\ComisariosAuditores;
use common\models\p\ActasConstitutivas;
use common\models\a\ActivosDocumentosRegistrados;
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
       
        $documento= ActivosDocumentosRegistrados::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id,'tipo_documento_id'=>2,'proceso_finalizado'=>false]);
        if(isset($documento)){
            $model= ModificacionesActas::findOne(['documento_registrado_id'=>$documento->id]);
        }else{
              $model= ModificacionesActas::findOne(['documento_registrado_id'=>-100]);
        }
        
        return $this->render('index', [
            'model'=>$model,
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
            Yii::$app->session->setFlash('error','Ya existe un registro');
            return $this->redirect(['index']);
                }
        if(isset($_POST['objeto'])){
            
            $transaction = \Yii::$app->db->beginTransaction();
            try {
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
                                $model->pago_capital=true;
                            break;
        
                            case "junta_directiva":
                                
                                $junta_actual=  AccionistasOtros::findAll(['contratista_id'=>Yii::$app->user->identity->contratista_id,'junta_directiva'=>true,'actual'=>true]);
                                foreach ($junta_actual as $junta) {
                                    if(!$junta->rep_legal){
                                      $junta_directiva = new AccionistasOtros();
                                      $junta_directiva->scenario='junta';
                                      $junta_directiva->natural_juridica_id= $junta->natural_juridica_id;
                                      $junta_directiva->junta_directiva=$junta->junta_directiva;
                                      $junta_directiva->tipo_cargo=  $junta->tipo_cargo;
                                      $junta_directiva->tipo_obligacion=  $junta->tipo_obligacion;
                                      $junta_directiva->documento_registrado_id= $model->documento_registrado_id;
                                      if(! $junta_directiva->save()){
                                        $transaction->rollback();
                                        Yii::$app->session->setFlash('error','Error en la asignacion de la junta directiva');
                                        return $this->redirect(['index']);
                                    
                                        }
                                    }
                                }
                               
                                $model->junta_directiva=true;
                            break;
                            case "fondo_emergencia":
                                $model->fondo_emergencia=true;
                            break;
                            case "limitacion_capital":
                   
                                if($model->limitacion_capital_afectado ||$model->reintegro_perdida){
                                    Yii::$app->session->setFlash('error','Error solo puede elegir una limitacion de capital  o un reintegro de perdida');
                                    return $this->render('create', [
                                        'model'=>$model,
                                    ]);
                                }else{
                                    $model->limitacion_capital=true;
                                }
       
                            break;
                            case "limitacion_capital_afectado":
                    
                                if($model->limitacion_capital ||$model->reintegro_perdida){
                                    Yii::$app->session->setFlash('error','Error solo puede elegir una limitacion de capital o un reintegro de perdida');
                                    return $this->render('create', [
                                        'model'=>$model,
                                    ]);
                                }else{
                                    $model->limitacion_capital_afectado=true;
                                }
       
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
                   
                     
                                if($model->limitacion_capital || $model->limitacion_capital_afectado){
                                    Yii::$app->session->setFlash('error','Error solo puede elegir una limitacion de capital o un reintegro de perdida');
                                    return $this->render('create', [
                                    'model'=>$model,
                                    ]);
                                }else{
                                    $model->reintegro_perdida=true;
                                }
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
                                
                                $rep_legal=  AccionistasOtros::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id,'rep_legal'=>true,'actual'=>true]);
                                $representante = new AccionistasOtros();
                                $representante->scenario='representante';
                                $representante->natural_juridica_id= $rep_legal->natural_juridica_id;
                                $representante->rep_legal= $rep_legal->rep_legal;
                                $representante->repr_legal_vigencia= $rep_legal->repr_legal_vigencia;
                                $representante->tipo_obligacion= $rep_legal->tipo_obligacion;
                                $representante->documento_registrado_id= $model->documento_registrado_id;
                                if(!$representante->save()){
                                    $transaction->rollback();
                                    Yii::$app->session->setFlash('error','Error en la asignacion del representante legal');
                                   // return print_r($representante->getErrors());
                                    return $this->redirect(['index']);
                                    
                                }else{
                                     $model->representante_legal=true;
                                }
                               

                            break;
                            case "objeto_social":
                                $model->objeto_social=true;
                            break;
                            case "domicilio_fiscal":
                                $model->domicilio_fiscal=true;
                                $model->domicilio_principal=true;
                            break;
                            case "denominacion_comercial":
                                $model->denominacion_comercial=true;
                            break;
                            case "comisario":
                                $comisario_auditor= ComisariosAuditores::findAll(['contratista_id'=>Yii::$app->user->identity->contratista_id,'comisario'=>true,'actual'=>true]);
                                foreach ($comisario_auditor as $comisario_actual) {
                                   
                                      $comisario = new ComisariosAuditores();
                                      $comisario->comisario=true;
                                      $comisario->actual=false;
                                      $comisario->natural_juridica_id=$comisario_actual->natural_juridica_id;
                                      $comisario->tipo_profesion=$comisario_actual->tipo_profesion;
                                      $comisario->colegiatura=$comisario_actual->colegiatura;
                                      $comisario->fecha_carta=$comisario_actual->fecha_carta;
                                      $comisario->fecha_vencimiento=$comisario_actual->fecha_vencimiento;
                                      $comisario->declaracion_jurada=true;
                                      $comisario->documento_registrado_id= $model->documento_registrado_id;
                                      if(!$comisario->save()){
                                        $transaction->rollback();
                                        Yii::$app->session->setFlash('error','Error en la asignacion del comisario');
                                        return $this->redirect(['index']);
                                    
                                        }
                                    
                                }
                                $model->comisario=true;
                                
                               
                            break;

                            default:
                            break;
                        }
                    }
                    
                    if($model->save()){
                        $transaction->commit();
                        Yii::$app->session->setFlash('success','Modificacion acta guardada con exito');
                        return $this->redirect(['index']);
                    }
                
                }else{
                    $transaction->rollBack();
                    Yii::$app->session->setFlash('error','El maximo de modificaciones debe ser 3');
                    return $this->render('create', [
                    'model'=>$model,
                    ]);
                }
       } catch (Exception $e) {
                         $transaction->rollBack();
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
