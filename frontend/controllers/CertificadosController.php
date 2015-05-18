<?php

namespace frontend\controllers;

use Yii;
use common\models\p\Certificados;
use common\models\a\ActivosDocumentosRegistrados;
use app\models\CertificadosSearch;
use common\components\BaseController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CertificadosController implements the CRUD actions for Certificados model.
 */
class CertificadosController extends BaseController
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
     * Lists all Certificados models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CertificadosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Certificados model.
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
     * Creates a new Certificados model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Certificados();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
     public function actionCertificadosuscritaacta()
    {
        $suscrita_acta = new Certificados();
         $suscrita_acta->scenario='principal';
         $msg=null;

        if ( $suscrita_acta->load(Yii::$app->request->post())) {
            
            
          
              $usuario= \common\models\p\User::findOne(Yii::$app->user->identity->id);
              $registro = ActivosDocumentosRegistrados::findOne(['contratista_id'=>$usuario->contratista_id, 'tipo_documento_id'=>1]);
   
              $suscrita_acta->suscrito=true;
              $suscrita_acta->tipo_certificado="PRINCIPAL";
              $suscrita_acta->contratista_id = $usuario->contratista_id;
              $suscrita_acta->documento_registrado_id = $registro->id;
     
            if($suscrita_acta->validate()){
                
                $certificados= Certificados::findOne(['contratista_id'=>$suscrita_acta->contratista_id ,'documento_registrado_id'=>$suscrita_acta->documento_registrado_id]);
          
                if(isset($certificados)){
                   
                     $msg = "Usuario ya posee certificados suscritas y pagadas asociadas";
                                   
                               
                   }else{
                 
                        $paga_acta = new Certificados();
                        $paga_acta->numero_asociacion= $suscrita_acta->numero_asociacion_pagada;
                        $paga_acta->valor_asociacion=$suscrita_acta->valor_asociacion_pagada;
                        $paga_acta->numero_aportacion= $suscrita_acta->numero_aportacion_pagada;
                        $paga_acta->valor_aportacion=$suscrita_acta->valor_aportacion_pagada;
                        $paga_acta->numero_rotativo= $suscrita_acta->numero_rotativo_pagada;
                        $paga_acta->valor_rotativo=$suscrita_acta->valor_rotativo_pagada;
                        $paga_acta->numero_inversion= $suscrita_acta->numero_inversion_pagada;
                        $paga_acta->valor_inversion=$suscrita_acta->valor_inversion_pagada;
             
                        $paga_acta->contratista_id = $suscrita_acta->contratista_id;
                        $paga_acta->documento_registrado_id= $suscrita_acta->documento_registrado_id;
                        $paga_acta->suscrito=false;
                        $paga_acta->tipo_certificado=$suscrita_acta->tipo_certificado;
                
                        $transaction = \Yii::$app->db->beginTransaction();
             
                        try {
                            if (! ($flag =  $paga_acta->save(false))) {
           
                            $transaction->rollBack();
                            $msg= "Error en la carga de certificados suscritas";
                               
                        }
                        if ($suscrita_acta->save()) {
           
                                $msg="Datos guardados correctamente";
                                $suscrita_acta=new Certificados();
                                $suscrita_acta->scenario='principal';
                               
                                $transaction->commit();

                        }else{
                            $transaction->rollBack();
                        
                        $msg= "Certificados suscritas no guardas con exito";
                        }
                    
                    } catch (Exception $e) {
                         $transaction->rollBack();
                    }
                
                }
            }
        }
        return $this->render("certificados_actas",['certificado_acta'=>$suscrita_acta,'msg'=>$msg]);
    }

    /**
     * Updates an existing Certificados model.
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
     * Deletes an existing Certificados model.
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
     * Finds the Certificados model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Certificados the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Certificados::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
