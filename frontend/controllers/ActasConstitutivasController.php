<?php

namespace frontend\controllers;

use Yii;
use common\models\p\ActasConstitutivas;
use common\models\p\Contratistas;
use common\models\p\CierresEjercicios;
use common\models\p\ObjetosSociales;
use common\models\p\DuracionesEmpresas;
use common\models\p\ActividadesEconomicas;
use common\models\a\ActivosDocumentosRegistrados;
use common\models\p\Acciones;
use common\models\p\SysCaev;;
use common\models\p\SysNaturalesJuridicas;
use common\models\p\Certificados;
use common\models\p\Suplementarios;
use common\models\p\DenominacionesComerciales;
use backend\models\ActasConstitutivasSearch;
use common\components\BaseController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;
/**
 * ActasConstitutivasController implements the CRUD actions for ActasConstitutivas model.
 */
class ActasConstitutivasController extends BaseController
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
     * Lists all ActasConstitutivas models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ActasConstitutivasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ActasConstitutivas model.
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
     * Creates a new ActasConstitutivas model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ActasConstitutivas();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
    public function actionCrearcapitalsuscrito()
    {
       $usuario= \common\models\p\User::findOne(Yii::$app->user->identity->id);
         $denominacion_comercial= DenominacionesComerciales::findOne(['contratista_id'=>$usuario->contratista_id]);
      
         if($denominacion_comercial->tipo_denominacion!="COOPERATIVA"){
             $accion_acta = new Acciones();
           
             $accion_acta->scenario = 'principal';
              return $this->redirect(['acciones/index']);
         }
         if($denominacion_comercial->tipo_denominacion=="COOPERATIVA" && $denominacion_comercial->cooperativa_capital=='LIMITADO'){
             $certificado_acta = new Certificados();
             $msg=null;
             $certificado_acta->scenario = 'principal';
              return $this->redirect(['certificados/index']);
         }
         if($denominacion_comercial->tipo_denominacion=="COOPERATIVA" && $denominacion_comercial->cooperativa_capital=='SUPLEMENTARIO'){
             $suplementario_acta = new Suplementarios();
             $msg=null;
             $suplementario_acta->scenario = 'principal';
              return $this->redirect(['suplementarios/index']);;
         }

    }
     public function actionResumenacta()
    {
 
         $contratista = Contratistas::findOne(['id'=>Yii::$app->user->identity->contratista_id]);
         $natural_juridica = SysNaturalesJuridicas::findOne(['id'=>$contratista->natural_juridica_id]);
         $registro = ActivosDocumentosRegistrados::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id, 'tipo_documento_id'=>1]);
         $duracion_empresa = DuracionesEmpresas::findOne(['documento_registrado_id'=>$registro->id]);
         $cierre_ejercicio= CierresEjercicios::findOne(['documento_registrado_id'=>$registro->id]);
         $objeto_social= ObjetosSociales::findOne(['documento_registrado_id'=>$registro->id]);
         $actividad_economica= ActividadesEconomicas::findOne(['documento_registrado_id'=>$registro->id]);
         $accion_suscrita= Acciones::findOne(['documento_registrado_id'=>$registro->id, 'tipo_accion'=>'PRINCIPAL', 'suscrito'=>true]);
         $accion_pagada= Acciones::findOne(['documento_registrado_id'=>$registro->id, 'tipo_accion'=>'PRINCIPAL', 'suscrito'=>false]);
         return $this->render('resumen', [
               'natural_juridica'=>$natural_juridica,
                'duracion_empresa'=>$duracion_empresa,
                'cierre_ejercicio'=>$cierre_ejercicio,
                'objeto_social'=>$objeto_social,
                'actividad_economica'=>$actividad_economica,
                'accion_suscrita'=>$accion_suscrita,
                'accion_pagada'=>$accion_pagada,
            ]);
    }
    /**
     * Updates an existing ActasConstitutivas model.
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
     * Deletes an existing ActasConstitutivas model.
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
     * Finds the ActasConstitutivas model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ActasConstitutivas the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ActasConstitutivas::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
