<?php

namespace frontend\controllers;

use Yii;
use common\models\p\BancosContratistas;
use app\models\BancosContratistasSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BancosContratistasController implements the CRUD actions for BancosContratistas model.
 */
class BancosContratistasController extends Controller
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
     * Lists all BancosContratistas models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BancosContratistasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single BancosContratistas model.
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
     * Creates a new BancosContratistas model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new BancosContratistas();

        if ($model->load(Yii::$app->request->post())) {
            
            $model->contratista_id=2;
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
    
    
       public function actionCrearbanco()
    {
           
            return $this->render('_bancos_contratistas',['banco_contratista' => (empty($banco_contratista)) ? [new BancosContratistas] : $banco_contratista]);
    }
    
    
     public function actionBancocontratista()
   {
          $usuario= \common\models\p\User::findOne(Yii::$app->user->identity->id);
        $banco_contratista = [new BancosContratistas];

           $banco_contratista = Model::createMultiple(BancosContratistas::classname());
            Model::loadMultiple($banco_contratista, Yii::$app->request->post());


           $transaction = \Yii::$app->db->beginTransaction();
           try {



                foreach ($banco_contratista as $carga_banco) {
                            $carga_banco->contratista_id = $usuario->contratista_id;
                            $carga_banco->save();

                            if (! ($flag = $carga_banco->save(false))) {

                                $transaction->rollBack();
                                return "error en la carga de de datos";
                                break;
                            }
                        }


                        $transaction->commit();
                        return "Datos guardados con exito";

           } catch (Exception $e) {
               $transaction->rollBack();
           }



   }


    /**
     * Updates an existing BancosContratistas model.
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
     * Deletes an existing BancosContratistas model.
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
     * Finds the BancosContratistas model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BancosContratistas the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BancosContratistas::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
