<?php

namespace frontend\controllers;

use Yii;
use common\models\p\Suplementarios;
use common\models\a\ActivosDocumentosRegistrados;
use app\models\SuplementariosSearch;
use common\components\BaseController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SuplementariosController implements the CRUD actions for Suplementarios model.
 */
class SuplementariosController extends BaseController
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
     * Lists all Suplementarios models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SuplementariosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Suplementarios model.
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
     * Creates a new Suplementarios model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Suplementarios();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }    public function actionSuplementariosuscritaacta()
    {
        $suscrita_acta = new Suplementarios();
         $suscrita_acta->scenario='principal';
         $msg=null;

        if ( $suscrita_acta->load(Yii::$app->request->post())) {
            
            
          
              $usuario= \common\models\p\User::findOne(Yii::$app->user->identity->id);
              $registro = ActivosDocumentosRegistrados::findOne(['contratista_id'=>$usuario->contratista_id, 'tipo_documento_id'=>1]);
   
              $suscrita_acta->suscrito=true;
              $suscrita_acta->tipo_suplementario="PRINCIPAL";
              $suscrita_acta->contratista_id = $usuario->contratista_id;
              $suscrita_acta->documento_registrado_id = $registro->id;
     
            if($suscrita_acta->validate()){
                
                $suplementarios= Suplementarios::findOne(['contratista_id'=>$suscrita_acta->contratista_id ,'documento_registrado_id'=>$suscrita_acta->documento_registrado_id]);
          
                if(isset($suplementarios)){
                   
                     $msg = "Usuario ya posee certificados suplementarios suscritas y pagadas asociadas";
                                   
                              
                   }else{
                 
                        $paga_acta = new Suplementarios();
                        $paga_acta->numero= $suscrita_acta->numero_pagada;
                        $paga_acta->capital=$suscrita_acta->capital_pagado;
             
                        $paga_acta->contratista_id = $suscrita_acta->contratista_id;
                        $paga_acta->documento_registrado_id= $suscrita_acta->documento_registrado_id;
                        $paga_acta->suscrito=false;
                        $paga_acta->tipo_suplementario=$suscrita_acta->tipo_suplementario;
                
                        $transaction = \Yii::$app->db->beginTransaction();
             
                        try {
                            if (! ($flag =  $paga_acta->save(false))) {
           
                            $transaction->rollBack();
                            $msg= "Error en la carga de certificados ciosomplementarios pagadas";
                               
                        }
                        if ($suscrita_acta->save()) {
           
                                $msg="Datos guardados correctamentee";
                                $suscrita_acta=new Suplementarios();
                                $suscrita_acta->scenario='principal';
                               
                                $transaction->commit();

                        }else{
                            $transaction->rollBack();
                        
                        $msg= "Certificados suplementarios suscritas no guardas con exito";
                        }
                    
                    } catch (Exception $e) {
                         $transaction->rollBack();
                    }
                
                }
            }
        }
        return $this->render("suplementarios_actas",['suplementario_acta'=>$suscrita_acta,'msg'=>$msg]);
    }
    
    

    /**
     * Updates an existing Suplementarios model.
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
     * Deletes an existing Suplementarios model.
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
     * Finds the Suplementarios model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Suplementarios the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Suplementarios::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
