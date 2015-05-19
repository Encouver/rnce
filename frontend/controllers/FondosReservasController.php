<?php

namespace frontend\controllers;

use Yii;
use common\models\p\FondosReservas;
use common\models\a\ActivosDocumentosRegistrados;
use app\models\FondosReservasSearch;
use common\components\BaseController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * FondosReservasController implements the CRUD actions for FondosReservas model.
 */
class FondosReservasController extends BaseController
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
     * Lists all FondosReservas models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FondosReservasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single FondosReservas model.
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
     * Creates a new FondosReservas model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $fondo_reserva = new FondosReservas();

        if ($fondo_reserva->load(Yii::$app->request->post())) {
            
            $usuario= \common\models\p\User::findOne(Yii::$app->user->identity->id);
                    $registro = ActivosDocumentosRegistrados::findOne(['contratista_id'=>$usuario->contratista_id, 'tipo_documento_id'=>1]);
                    $fondo_reserva->contratista_id=$usuario->contratista_id;
                    $fondo_reserva->documento_registrado_id=$registro->id;
                    if($fondo_reserva->save()){
                         return $this->redirect(['view', 'id' => $fondo_reserva->id]);
                    }else{
                       return $this->render('create', [
                        'fondo_reserva' => $fondo_reserva,
                        ]); 
                    }
           
        } else {
            return $this->render('create', [
                'fondo_reserva' => $fondo_reserva,
            ]);
        }
    }

    /**
     * Updates an existing FondosReservas model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $fondo_reserva = $this->findModel($id);

        if ($fondo_reserva->load(Yii::$app->request->post()) && $fondo_reserva->save()) {
            $usuario= \common\models\p\User::findOne(Yii::$app->user->identity->id);
                    $registro = ActivosDocumentosRegistrados::findOne(['contratista_id'=>$usuario->contratista_id, 'tipo_documento_id'=>1]);
                    $fondo_reserva->contratista_id=$usuario->contratista_id;
                    $fondo_reserva->documento_registrado_id=$registro->id;
                    if($fondo_reserva->save()){
                         return $this->redirect(['view', 'id' => $fondo_reserva->id]);
                    }else{
                       return $this->render('update', [
                'fondo_reserva' => $fondo_reserva,
            ]);
                    }
        } else {
            return $this->render('update', [
                'fondo_reserva' => $fondo_reserva,
            ]);
        }
    }

    /**
     * Deletes an existing FondosReservas model.
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
     * Finds the FondosReservas model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return FondosReservas the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = FondosReservas::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
