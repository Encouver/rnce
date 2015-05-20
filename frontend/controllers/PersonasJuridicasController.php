<?php

namespace frontend\controllers;

use Yii;
use common\models\p\PersonasJuridicas;
use app\models\PersonasJuridicasSearch;
use common\components\BaseController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PersonasJuridicasController implements the CRUD actions for PersonasJuridicas model.
 */
class PersonasJuridicasController extends BaseController
{
    public function behaviors()
    {
        return array_merge(parent::behaviors(),[
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ]);
    }

    /**
     * Lists all PersonasJuridicas models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PersonasJuridicasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PersonasJuridicas model.
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
     * Creates a new PersonasJuridicas model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PersonasJuridicas();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
public function actionCrearpersonajuridica()
    {
        $persona_juridica = new PersonasJuridicas();
        $natural_juridica= new \common\models\p\SysNaturalesJuridicas();
        

        if ($persona_juridica->load(Yii::$app->request->post())) {
           $transaction = \Yii::$app->db->beginTransaction();
           try {
              
                $natural_juridica->rif= $persona_juridica->numero_identificacion;
            $natural_juridica->juridica= true;
            $natural_juridica->denominacion=$persona_juridica->razon_social;
            $natural_juridica->sys_status=true;
            if (! ($flag = $natural_juridica->save())) {

                                        $transaction->rollBack();
                                    return "faltan datos de natural juridica";
                                            
                                    }
          
            if($persona_juridica->tipo_nacionalidad=="NACIONAL"){
                $persona_juridica->rif=$persona_juridica->numero_identificacion;
                $persona_juridica->numero_identificacion=null;
            }
            $persona_juridica->creado_por=1;
            $persona_juridica->sys_status=true;
           
               if ($persona_juridica->save()) {
           

                               $transaction->commit();
                               return "Datos guardados con exito";
                               


                   }else{
                        $transaction->rollBack();
                       return "Datos no guardados";
                   }
             
             
           } catch (Exception $e) {
               $transaction->rollBack();
           }
       }else{
           return "Datos incompletos";
       }


    }
    public function actionCrearpersonajuridicanacional()
    {
        $persona_juridica = new PersonasJuridicas();
        $natural_juridica= new \common\models\p\SysNaturalesJuridicas();
        

        if ($persona_juridica->load(Yii::$app->request->post())) {
           $transaction = \Yii::$app->db->beginTransaction();
           try {
              
                $natural_juridica->rif= $persona_juridica->rif;
            $natural_juridica->juridica= true;
            $natural_juridica->denominacion=$persona_juridica->razon_social;
            $natural_juridica->sys_status=true;
            if (! ($flag = $natural_juridica->save())) {

                                        $transaction->rollBack();
                                    return "faltan datos de natural juridica";
                                            
                                    }
             if($persona_juridica->tipo_nacionalidad==null){
                 $persona_juridica->tipo_nacionalidad="NACIONAL";
             }
            $persona_juridica->creado_por=1;
            $persona_juridica->sys_status=true;
           
               if ($persona_juridica->save()) {
           

                               $transaction->commit();
                               return "Datos guardados con exito";
                               


                   }else{
                        $transaction->rollBack();
                       return "Datos no guardados";
                   }
             
             
           } catch (Exception $e) {
               $transaction->rollBack();
           }
       }else{
           return "Datos incompletos";
       }


    }
    /**
     * Updates an existing PersonasJuridicas model.
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
     * Deletes an existing PersonasJuridicas model.
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
     * Finds the PersonasJuridicas model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PersonasJuridicas the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PersonasJuridicas::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
