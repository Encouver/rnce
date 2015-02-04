<?php

namespace frontend\controllers;

use Yii;
use app\models\EmpresasRelacionadas;
use app\models\EmpresasRelacionadasSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EmpresasRelacionadasController implements the CRUD actions for EmpresasRelacionadas model.
 */
class EmpresasRelacionadasController extends Controller
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
     * Lists all EmpresasRelacionadas models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EmpresasRelacionadasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single EmpresasRelacionadas model.
     * @param integer $empresa_id
     * @param integer $contratista_id
     * @return mixed
     */
    public function actionView($empresa_id, $contratista_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($empresa_id, $contratista_id),
        ]);
    }

    /**
     * Creates a new EmpresasRelacionadas model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new EmpresasRelacionadas();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'empresa_id' => $model->empresa_id, 'contratista_id' => $model->contratista_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing EmpresasRelacionadas model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $empresa_id
     * @param integer $contratista_id
     * @return mixed
     */
    public function actionUpdate($empresa_id, $contratista_id)
    {
        $model = $this->findModel($empresa_id, $contratista_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'empresa_id' => $model->empresa_id, 'contratista_id' => $model->contratista_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing EmpresasRelacionadas model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $empresa_id
     * @param integer $contratista_id
     * @return mixed
     */
    public function actionDelete($empresa_id, $contratista_id)
    {
        $this->findModel($empresa_id, $contratista_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the EmpresasRelacionadas model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $empresa_id
     * @param integer $contratista_id
     * @return EmpresasRelacionadas the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($empresa_id, $contratista_id)
    {
        if (($model = EmpresasRelacionadas::findOne(['empresa_id' => $empresa_id, 'contratista_id' => $contratista_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
