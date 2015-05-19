<?php

namespace frontend\controllers;

use Yii;
use common\models\c\CuentasHhPasivoLaboral;
use app\models\CuentasHhPasivoLaboralSearch;
use common\components\BaseController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CuentasHhPasivoLaboralController implements the CRUD actions for CuentasHhPasivoLaboral model.
 */
class CuentasHhPasivoLaboralController extends BaseController
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
     * Lists all CuentasHhPasivoLaboral models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CuentasHhPasivoLaboralSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionPasivolaboral()
    {
        $searchModel = new CuentasHhPasivoLaboralSearch();
        
        $searchModel->corriente = true;
        $dataProvider_c = $searchModel->search(Yii::$app->request->queryParams);
        $searchModel->corriente = false;
        $dataProvider_nc = $searchModel->search(Yii::$app->request->queryParams);


        return $this->render('pasivo_laboral', [
            'model' => $searchModel,
            'dataProvider_c' => $dataProvider_c,
            'dataProvider_nc' => $dataProvider_nc,
        ]);
    }

    /**
     * Displays a single CuentasHhPasivoLaboral model.
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
     * Creates a new CuentasHhPasivoLaboral model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CuentasHhPasivoLaboral();
        //Yii::app::end();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->saldo_al_cierre = $model->saldo_p_anterior + $model->importe_gasto_ejer_eco +  $model->importe_pago_ejer_eco;
            $model->save();
            return $this->redirect(['cuentas-hh-pasivo-laboral/pasivolaboral']);
        } else {
            return $this->render('create', [
                'model' => $model, 
            ]);
        }
    }

    /**
     * Updates an existing CuentasHhPasivoLaboral model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->saldo_al_cierre = $model->saldo_p_anterior + $model->importe_gasto_ejer_eco +  $model->importe_pago_ejer_eco;
            $model->save();
            return $this->redirect(['cuentas-hh-pasivo-laboral/pasivolaboral']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing CuentasHhPasivoLaboral model.
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
     * Finds the CuentasHhPasivoLaboral model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CuentasHhPasivoLaboral the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CuentasHhPasivoLaboral::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
