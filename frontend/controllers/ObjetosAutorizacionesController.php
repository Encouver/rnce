<?php

namespace frontend\controllers;

use Yii;
use common\models\p\ObjetosAutorizaciones;
use common\models\p\PersonasJuridicas;
use app\models\ObjetosAutorizacionesSearch;
use common\components\BaseController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ObjetosAutorizacionesController implements the CRUD actions for ObjetosAutorizaciones model.
 */
class ObjetosAutorizacionesController extends BaseController
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
     * Lists all ObjetosAutorizaciones models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ObjetosAutorizacionesSearch();
        $searchModel->contratista_id = Yii::$app->user->identity->contratista_id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->sort = false;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ObjetosAutorizaciones model.
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
     * Creates a new ObjetosAutorizaciones model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ObjetosAutorizaciones();
        $modelJuridica = new PersonasJuridicas();

        if ($model->load(Yii::$app->request->post())) {
            $model->contratista_id= Yii::$app->user->identity->contratista_id;
            if($model->save()){
                return $this->redirect(['objetos-empresas/index']);
            }else{
                $modelJuridica = new PersonasJuridicas();

                Yii::$app->session->setFlash('error','error en la carga del objeto autorizado');
                 return $this->render('create', [
                'model' => $model,
                'modelJuridica'=>$modelJuridica,
            ]);
            }
            
        } else {
            return $this->render('create', [
                'model' => $model,
                'modelJuridica'=>$modelJuridica,
            ]);
        }
    }

    /**
     * Updates an existing ObjetosAutorizaciones model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $modelJuridica = new PersonasJuridicas();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['objetos-empresas/index']);
        } else {
            return $this->render('update', [
                'model' => $model,
                'modelJuridica'=>$modelJuridica,
            ]);
        }
    }

    /**
     * Deletes an existing ObjetosAutorizaciones model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['objetos-empresas/index']);
    }

    /**
     * Finds the ObjetosAutorizaciones model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ObjetosAutorizaciones the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ObjetosAutorizaciones::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
