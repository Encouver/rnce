<?php

namespace frontend\controllers;

use Yii;
use common\models\p\Domicilios;
use app\models\DomiciliosSearch;
use common\models\p\Direcciones;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DomiciliosController implements the CRUD actions for Domicilios model.
 */
class DomiciliosController extends Controller
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
     * Lists all Domicilios models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DomiciliosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Domicilios model.
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
     * Creates a new Domicilios model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Domicilios();
        $model2 = new Direcciones();

        if ($model2->load(Yii::$app->request->post())) {
            $model2->save();
            $model->fiscal=false;
            $model->direccion_id=$model2->id;
            $model->contratista_id=2;
            $model->save();
            
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'model2' => $model2,
            ]);
        }
    }
    
     public function actionDireccionprincipal()
   {


        $domicilio = new Domicilios();
        $direccion = new Direcciones();
        if ($direccion->load(Yii::$app->request->post())) {
           $transaction = \Yii::$app->db->beginTransaction();
           try {
                $flag =false;
               if ($direccion->save()) {
                 $domicilio->fiscal=false;
           $domicilio->direccion_id=$direccion->id;
           $usuario= \common\models\p\User::findOne(Yii::$app->user->identity->id);
            $domicilio->contratista_id=  $usuario->contratista_id;
                   if ($domicilio->save()) {


                               $transaction->commit();
                               return "Dtos guardados con exito";
                               $flag = true;


                   }else{
                       return "Domicilio no guardado";
                   }
               }else{

                   return "Direccion principal no guardada";
               }

               if(!$flag)
               {
                   $transaction->rollBack();
               }
           } catch (Exception $e) {
               $transaction->rollBack();
           }
       }else{
           return "Datos incompletos";
       }



   }
   
    public function actionCrearprincipal()
    {
        $direccion = new Direcciones();

        return $this->render('_direcciones_principales',['direccion' => $direccion]);
            
    }


    /**
     * Updates an existing Domicilios model.
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
     * Deletes an existing Domicilios model.
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
     * Finds the Domicilios model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Domicilios the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Domicilios::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
