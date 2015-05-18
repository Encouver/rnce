<?php

namespace frontend\controllers;

use Yii;
use common\models\c\CuentasCInventarios;

use common\models\c\CuentasCInventarios;
use common\models\c\CuentasCTiposInventarios;
use common\models\c\CuentasSysFormulasTecnicas;

use app\models\CuentasCInventariosSearch;
use common\components\BaseController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CuentasCInventariosController implements the CRUD actions for CuentasCInventarios model.
 */
class CuentasCInventariosController extends BaseController
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
     * Lists all CuentasCInventarios models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CuentasCInventariosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CuentasCInventarios model.
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
     * Creates a new CuentasCInventarios model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CuentasCInventarios();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing CuentasCInventarios model.
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
     * Deletes an existing CuentasCInventarios model.
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
     * Finds the CuentasCInventarios model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CuentasCInventarios the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CuentasCInventarios::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function getFormAttribs() 
    {
        return [
                // primary key column
            'id'=>[ // primary key attribute
                'type'=>TabularForm::INPUT_HIDDEN,
                'columnOptions'=>['hidden'=>true]
            ],
            'tipo_inventario_id'=>['type'=>Form::INPUT_DROPDOWN_LIST, 'items'=>ArrayHelper::map(CuentasSysFormulasTecnicas::find()->orderBy('nombre')->asArray()->all(), 'id', 'nombre'), 'label'=>'Banco'],
            'detalle_inventario'=>['type'=>Form::INPUT_TEXT,'label'=>'Detalle'],
            'tecnica_medicion_id'=>['type'=>Form::INPUT_TEXT,'label'=>'Tecnica de medición'],
            'formula_tecnica_id'=>['type'=>Form::INPUT_TEXT,'label'=>'Formula tecnica'],
            'inventario_inicial'=>['type'=>Form::INPUT_TEXT,'label'=>'Inventario inicial'],
            'compra_ejercicio'=>['type'=>Form::INPUT_TEXT,'label'=>'Compras'],
            'ventas_ejercicio'=>['type'=>Form::INPUT_TEXT,'label'=>'Ventas'],
            'inventario_final'=>['type'=>Form::INPUT_TEXT,'label'=>'Inventario final'],
            'valor_neto_realizacion'=>['type'=>Form::INPUT_TEXT,'label'=>'Valor neto'],
            'frecuencia_rotacion'=>['type'=>Form::INPUT_TEXT,'label'=>'Frecuencia de rotación'],
            'variacion_inflacion'=>['type'=>Form::INPUT_TEXT,'label'=>'Variacion por inflación'],
            'costo_ajustado'=>['type'=>Form::INPUT_TEXT,'label'=>'Costo ajustado'],
            'deterioro'=>['type'=>Form::INPUT_TEXT,'label'=>'Deterioro'],
            'reverso_deterioro'=>['type'=>Form::INPUT_TEXT,'label'=>'Reverso deterioro'],
            'valor_neto_ajus_cierre'=>['type'=>Form::INPUT_TEXT,'label'=>'Valor neto ajustado al cierre'],
        ];
    }
}
