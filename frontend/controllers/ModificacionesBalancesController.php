<?php

namespace frontend\controllers;

use Yii;
use common\models\p\ModificacionesBalances;
use app\models\ModificacionesBalancesSearch;
use common\components\BaseController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ModificacionesBalancesController implements the CRUD actions for ModificacionesBalances model.
 */
class ModificacionesBalancesController extends BaseController
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
     * Lists all ModificacionesBalances models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ModificacionesBalancesSearch();
         $documento=$searchModel->Modificacionactual();
        if(isset($documento)){
            $searchModel->documento_registrado_id= $documento->documento_registrado_id;
          
        }
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->sort = false;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'documento'=>$documento,
        ]);
    }

    /**
     * Displays a single ModificacionesBalances model.
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
     * Creates a new ModificacionesBalances model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ModificacionesBalances();
         if($model->existeregistro()){
            
            Yii::$app->session->setFlash('error','Usuario posee una Discusión y Aprobación o Modificación de Balances en curso o no ha creado una modificacion');
            return $this->redirect(['index']);
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ModificacionesBalances model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
             return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing ModificacionesBalances model.
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
     * Finds the ModificacionesBalances model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ModificacionesBalances the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ModificacionesBalances::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
