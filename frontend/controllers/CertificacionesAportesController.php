<?php

namespace frontend\controllers;

use Yii;
use common\models\p\CertificacionesAportes;
use common\models\a\ActivosDocumentosRegistrados;
use app\models\CertificacionesAportesSearch;
use common\components\BaseController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CertificacionesAportesController implements the CRUD actions for CertificacionesAportes model.
 */
class CertificacionesAportesController extends BaseController
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
     * Lists all CertificacionesAportes models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CertificacionesAportesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CertificacionesAportes model.
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
     * Creates a new CertificacionesAportes model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $certificacion_aporte = new CertificacionesAportes();

        if ($certificacion_aporte->load(Yii::$app->request->post())) {
            $usuario= \common\models\p\User::findOne(Yii::$app->user->identity->id);
                    $registro = ActivosDocumentosRegistrados::findOne(['contratista_id'=>$usuario->contratista_id, 'tipo_documento_id'=>1]);
                    $certificacion_aporte->contratista_id=$usuario->contratista_id;
                    $certificacion_aporte->documento_registrado_id=$registro->id;
                    if($certificacion_aporte->save()){
                        return $this->redirect(['view', 'id' => $certificacion_aporte->id]);
                    }else{
                       
             
                        return $this->render('create', [
                            'certificacion_aporte' => $certificacion_aporte,
                            ]);
                    }
        } else {
            return $this->render('create', [
                'certificacion_aporte' => $certificacion_aporte,
            ]);
        }
    }

    /**
     * Updates an existing CertificacionesAportes model.
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
     * Deletes an existing CertificacionesAportes model.
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
     * Finds the CertificacionesAportes model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CertificacionesAportes the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CertificacionesAportes::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
