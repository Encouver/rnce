<?php

namespace frontend\controllers;

use Yii;
use common\models\p\Contratistas;
use common\models\p\SysNaturalesJuridicas;
use common\models\p\PersonasNaturales;
use common\models\p\PersonasJuridicas;
use common\models\p\Domicilios;
use common\models\p\Direcciones;
use common\models\p\Sucursales;
use common\models\p\ContratistasContactos;
use common\models\p\BancosContratistas;
use common\models\p\RelacionesSucursales;
use common\models\p\ActividadesEconomicas;
use common\models\p\DenominacionesComerciales;
use common\models\p\ObjetosEmpresas;
use common\models\p\User;
use common\models\p\ObjetosAutorizaciones;
use common\models\p\RelacionesObjetos;
use app\models\ContratistasSearch;
use common\models\p\Model;
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
     * Lists all Contratistas models.
     * @return mixed
     */
    public function actionIndex()
    {
      
        $searchModel = new ContratistasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionNaturaljuridicalist($search = null, $id = null) {
        
       
    $out = ['more' => false];
    if (!is_null($search)) {
        $query = new \yii\db\Query;
        $query->select('id, rif AS text')
            ->from('sys_naturales_juridicas')
            ->where("rif LIKE "."'%" . $search ."%'")
            ->limit(20);
        $command = $query->createCommand();
        $data = $command->queryAll();
        $out['results'] = array_values($data);
    }
    elseif ($id > 0) {
        $out['results'] = ['id' => $id, 'text' => SysNaturalesJuridicas::find($id)->rif];
    }
    else {
        $out['results'] = ['id' => 0, 'text' => 'No matching records found'];
    }
  
    echo \yii\helpers\Json::encode($out);
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
      public function actionDatosbasicos()
    {
        return $this->render('datos_basicos');
    }

    /**
     * Creates a new Contratistas model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */


    public function actionCreate()
    {
       

    }

     public function actionAcordeon()
    {
         $model = new Contratistas();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('acordeon');
        }
    }



     public function actionObtenertipopersona($id)
   {
     $contratista = new Contratistas();
     $natural_juridica = new SysNaturalesJuridicas();
        if ($id=='0'){
             $persona_natural = new PersonasNaturales();


             return $this->renderAjax('personas_naturales',
                     array('persona_natural' => $persona_natural,
                         'natural_juridica'=> $natural_juridica,

                         ));
         }
         if($id=='1'){
            return $this->renderAjax('personas_juridicas',
                     array('contratista' => $contratista,
                         'natural_juridica'=> $natural_juridica,

                         ));

         }




   }
   
    public function actionDatosnatural()
   {

        $contratista = new Contratistas();
        $natural_juridica = new SysNaturalesJuridicas();
        $persona_natural = new PersonasNaturales();
       if ($natural_juridica->load(Yii::$app->request->post()) && $persona_natural->load(Yii::$app->request->post())) {


           $transaction = \Yii::$app->db->beginTransaction();
           try {
                $flag =false;
                $natural_juridica->juridica=false;
                $natural_juridica->denominacion = $persona_natural->primer_nombre.' '.$persona_natural->primer_apellido;

                if ($natural_juridica->save()) {

                   $persona_natural->rif = $natural_juridica->rif;
                   $persona_natural->sys_pais_id = 1;
                   $persona_natural->nacionalidad = "NACIONAL";
                   $persona_natural->creado_por = 1;
                   if ($persona_natural->save()) {

                       $contratista->estatus_contratista_id = 1;
                       $contratista ->natural_juridica_id = $natural_juridica->id;

                       if($contratista->save()){

                           if ($usuario= \common\models\p\User::findOne(Yii::$app->user->identity->id)) {

                           $usuario->contratista_id = $contratista->id;
                           if ($usuario->save()) {

                               $transaction->commit();
                               $flag = true;
                               return "Datos guardados con mucho exito";
                               //return $this->redirect(['view', 'id' => $model->id]);
                           } else {
                               $transaction->rollBack();

                           }
                            }
                       else return "guardado con exito";
                       }

                   }else{
                       return "Persona natural no guardada";
                   }
               }else{

                   return "Natural juridica no guardada";
               }

               if(!$flag)
               {
                   $transaction->rollBack();
               }
           } catch (Exception $e) {
               $transaction->rollBack();
           }
       }else{

           return "Datos incompleto";
       }



   }

    public function actionDatosjuridica()
   {

        $contratista = new Contratistas();
        $natural_juridica = new SysNaturalesJuridicas();
        $persona_juridica = new PersonasJuridicas();
       if ($natural_juridica->load(Yii::$app->request->post()) && $contratista->load(Yii::$app->request->post())) {


           $transaction = \Yii::$app->db->beginTransaction();
           try {
                $flag =false;
                $natural_juridica->juridica=true;


                if ($natural_juridica->save()) {

                $persona_juridica->rif = $natural_juridica->rif;
                $persona_juridica->razon_social = $natural_juridica->denominacion;

                   $persona_juridica->tipo_nacionalidad = "NACIONAL";
                 $persona_juridica->creado_por = 1;
                   if ($persona_juridica->save()) {

                       $contratista->estatus_contratista_id = 1;
                       $contratista ->natural_juridica_id = $natural_juridica->id;

                       if($contratista->save()){

                           if ($usuario= \common\models\p\User::findOne(Yii::$app->user->identity->id)) {

                           $usuario->contratista_id = $contratista->id;
                           if ($usuario->save()) {

                               $transaction->commit();
                               $flag = true;
                               return "Datos guardados con mucho exito";
                               //return $this->redirect(['view', 'id' => $model->id]);
                           } else {
                               $transaction->rollBack();

                           }
                            }
                       else return "guardado con exito";
                       }

                   }else{
                       return "Persona juridica no guardada";
                   }
               }else{

                   return "Natural juridica no guardada";
               }

               if(!$flag)
               {
                   $transaction->rollBack();
               }
           } catch (Exception $e) {
               $transaction->rollBack();
           }
       }else{

           return "Datos incompleto";
       }



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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
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
