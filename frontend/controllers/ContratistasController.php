<?php

namespace frontend\controllers;

use Exception;
use Yii;
use common\models\p\Contratistas;
use common\models\p\SysNaturalesJuridicas;
use common\models\p\PersonasNaturales;
use common\models\p\PersonasJuridicas;
use common\models\p\User;
use app\models\UserSearch;
use app\models\ContratistasSearch;
use common\components\BaseController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ContratistasController implements the CRUD actions for Contratistas model.
 */
class ContratistasController extends BaseController
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
     * Lists all Contratistas models.
     * @return mixed
     */
    public function actionIndex()
    {
      
        $searchModel = new ContratistasSearch();
        var_dump(Yii::$app->user->identity->contratista_id);
        //die;
        $searchModel->id = Yii::$app->user->identity->contratista_id == null?0:Yii::$app->user->identity->contratista_id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->sort = false;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    
    /**
     * Displays a single Contratistas model.
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
     * Creates a new Contratistas model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */


    public function actionCreate()
    {
       
        $model = new Contratistas();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

   
    public function actionCreardatonatural()
   {
       if(Yii::$app->user->identity->contratista_id!=null){
           Yii::$app->session->setFlash('error', 'Ya tiene datos registrados como contratista.');
           return $this->redirect(['index']);
       }
     
        $persona_natural = new PersonasNaturales(['scenario'=>'acta']);
     
       if ($persona_natural->load(Yii::$app->request->post()) && $persona_natural->validate()) {

           $contratista = new Contratistas();
           $natural_juridica = new SysNaturalesJuridicas();
           $transaction = \Yii::$app->db->beginTransaction();
           try {
                $flag =false;
                $natural_juridica->juridica=false;
                $natural_juridica->denominacion = $persona_natural->primer_nombre.' '.$persona_natural->primer_apellido;
                $natural_juridica->rif = $persona_natural->rif;
                if ($natural_juridica->save()) {

                   $persona_natural->sys_pais_id = 1;
                   $persona_natural->nacionalidad = "NACIONAL";
                   if ($persona_natural->save()) {

                       $contratista->estatus_contratista_id = 1;
                       $contratista ->natural_juridica_id = $natural_juridica->id;

                       if($contratista->save()){

                           if ($usuario= \common\models\p\User::findOne(Yii::$app->user->identity->id)) {
                               $usuario->contratista_id = $contratista->id;

                               if ($usuario->save(false)) {
                                   $transaction->commit();
                                   $flag = true;
                                   return $this->redirect(['index']);
                               } else {
                                   Yii::$app->session->setFlash('error', 'Usuario no actualizado');
                                   //throw new \yii\base\Exception( "Usuario no actualizado" );
                                   throw new Exception("Error Processing Request", 1);
                               }
                            }
                       }

                   }else{
                       Yii::$app->session->setFlash('error', 'Error al cargar la persona natural');
                       //throw new \yii\base\Exception( "Error al cargar la persona natural" );
                       throw new Exception("Error Processing Request", 1);
                   }
               }else{
                    Yii::$app->session->setFlash('error', 'Error al cargar natural juridica');
                    //throw new \yii\base\Exception( "Error al cargar natural juridica" );
                    throw new Exception("Error Processing Request", 1);
               }

               if(!$flag)
               {
                   $transaction->rollBack();
               }
           } catch (Exception $e) {
               $transaction->rollBack();
           }
       }

       return $this->render('crearnatural',
                 array('persona_natural' => $persona_natural));

   }

    public function actionCreardatojuridica()
    {

        if(Yii::$app->user->identity->contratista_id!=null){
            Yii::$app->session->setFlash('error', 'Ya tiene datos registrados como contratista.');
            return $this->redirect(['index']);
        }

        $persona_juridica = new PersonasJuridicas();
        $persona_juridica->scenario="conbasico";
        if ($persona_juridica->load(Yii::$app->request->post()) && $persona_juridica->validate()) {

            $contratista = new Contratistas();
            $natural_juridica = new SysNaturalesJuridicas();
            $transaction = \Yii::$app->db->beginTransaction();
            try {
                $flag =false;
                $natural_juridica->juridica=true;
                $natural_juridica->rif=$persona_juridica->rif;
                $natural_juridica->denominacion=$persona_juridica->razon_social;

                if ($natural_juridica->save()) {

                    $persona_juridica->sys_pais_id=1;
                    $persona_juridica->tipo_nacionalidad = "NACIONAL";
                    //$persona_juridica->creado_por = Yii::$app->user->identity->id;
                    if ($persona_juridica->save()) {

                        $contratista->estatus_contratista_id = 1;
                        $contratista ->natural_juridica_id = $natural_juridica->id;

                        if($contratista->save()){
                            if ($usuario= \common\models\p\User::findOne(Yii::$app->user->identity->id)) {

                                $usuario->contratista_id = $contratista->id;


                                if ($usuario->save(false)) {
                                    $transaction->commit();
                                    $flag = true;
                                    return $this->redirect(['index']);
                                } else {
                                    Yii::$app->session->setFlash('error', 'Usuario no acualizado');
                                    //throw new \yii\base\Exception("Usuario no acualizado");
                                    throw new Exception("Error Processing Request", 1);
                                }
                            }
                        }

                    }else{
                        Yii::$app->session->setFlash('error', 'Ha ocurrido un error al cargar la persona juridica');
                        //throw new \yii\base\Exception( "Ha ocurrido un error al cargar la persona juridica" );
                        throw new Exception("Error Processing Request", 1);
                    }
                }else{
                    Yii::$app->session->setFlash('error', 'Ha ocurrido un error al cargar Natural Juridica');
                    //throw new \yii\base\Exception( "Ha ocurrido un error al cargar Natural Juridica" );
                    throw new Exception("Error Processing Request", 1);
                }

                if(!$flag)
                {
                    $transaction->rollBack();
                }
            } catch (Exception $e) {
                $transaction->rollBack();
            }
        }

        return $this->render('crearjuridica',
            array('persona_juridica' => $persona_juridica ));

    }

    /**
     * Updates an existing Contratistas model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $modelPersona = null;

        if($model->naturalJuridica->esNatural()){
            $modelPersona = $model->naturalJuridica->personaNatural;
        }elseif($model->naturalJuridica->esJuridica()){
            $modelPersona = $model->naturalJuridica->personaJuridica;
        }

        if($modelPersona) {

            $modelPersona->scenario = $model->naturalJuridica->esNatural()?'acta':"conbasico";
            if ($modelPersona->load(Yii::$app->request->post()) && $modelPersona->validate()) {

                $natural_juridica = $model->naturalJuridica;
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    $flag = false;

                    $natural_juridica->rif = $modelPersona->rif;
                    $natural_juridica->denominacion = $model->naturalJuridica->esNatural()?$modelPersona->primer_nombre.' '.$modelPersona->primer_apellido:$modelPersona->razon_social;
                    if ($natural_juridica->save()) {

                        if ($modelPersona->save()) {

                            if ($model->save()) {
                                if ($usuario = \common\models\p\User::findOne(Yii::$app->user->identity->id)) {

                                    $transaction->commit();
                                    $flag = true;
                                    return $this->redirect(['index']);
                                }
                            }
                        }else{
                            Yii::$app->session->setFlash('error', 'Ha ocurrido un error al cargar Natural Juridica');
                            //throw new \yii\base\Exception( "Ha ocurrido un error al cargar Natural Juridica" );
                            throw new Exception("Error Processing Request", 1);
                        }
                    } else {
                        Yii::$app->session->setFlash('error', 'Ha ocurrido un error al actualizar la Persona '.$model->naturalJuridica->esNatural()?'Natural':'Juridica'.'');
                        //throw new \yii\base\Exception( "Ha ocurrido un error al cargar la persona juridica" );
                        throw new Exception("Error Processing Request", 1);
                    }

                    if (!$flag) {
                        $transaction->rollBack();
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }


        }


        return $this->render('update', [
            'model' => $modelPersona,
        ]);

        /* if ($model->load(Yii::$app->request->post()) && $model->save()) {
             return $this->redirect(['view', 'id' => $model->id]);
         } else {
             return $this->render('update', [
                 'model' => $modelPersona,
             ]);
         }*/
    }

    /**
     * Deletes an existing Contratistas model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
    public function actionPrimerdato()
    {
       

        return $this->render('datos_basicos');
    }
    

    /**
     * Finds the Contratistas model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Contratistas the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Contratistas::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
