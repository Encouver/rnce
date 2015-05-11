<?php

namespace frontend\controllers;

use Yii;
use common\models\p\Sucursales;
use common\models\p\RelacionesSucursales;
use common\models\p\PersonasNaturales;
use common\models\p\SysNaturalesJuridicas;
use app\models\SucursalesSearch;
use common\components\BaseController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SucursalesController implements the CRUD actions for Sucursales model.
 */
class SucursalesController extends BaseController
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
     * Lists all Sucursales models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SucursalesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Sucursales model.
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
     * Creates a new Sucursales model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Sucursales();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
    
   public function actionRelacionsucursal()
   {

         $usuario= \common\models\p\User::findOne(Yii::$app->user->identity->id);
        $relacion_sucursal = [new RelacionesSucursales];
       $relacion_sucursal = Model::createMultiple(RelacionesSucursales::classname());
            Model::loadMultiple($relacion_sucursal, Yii::$app->request->post());

           $transaction = \Yii::$app->db->beginTransaction();
           try {
                foreach ($relacion_sucursal as $carga_sucursal) {
                             $direccion_sucursal = new Direcciones();
                             $natural_juridica = new SysNaturalesJuridicas();
                             $persona_sucursal = new PersonasNaturales();
                             $sucursal= new Sucursales();

                            $direccion_sucursal->sys_estado_id = $carga_sucursal->sys_estado_id;
                            $direccion_sucursal->sys_municipio_id = $carga_sucursal->sys_municipio_id;
                            $direccion_sucursal->sys_parroquia_id = $carga_sucursal->sys_parroquia_id;
                            $direccion_sucursal->zona = $carga_sucursal->zona;
                            $direccion_sucursal->calle = $carga_sucursal->calle;
                            $direccion_sucursal->casa = $carga_sucursal->casa;
                            $direccion_sucursal->nivel = $carga_sucursal->nivel;
                            $direccion_sucursal->numero = $carga_sucursal->numero;
                            $direccion_sucursal->referencia = $carga_sucursal->referencia;

                             if (! ($flag = $direccion_sucursal->save(false))) {

                                $transaction->rollBack();
                                return "error en la carga de de datos de direcciones";
                                break;
                            }


                              $natural_juridica->rif= $carga_sucursal->rif;
                              $natural_juridica->juridica= false;
                              $natural_juridica->denominacion=$carga_sucursal->primer_nombre.' '.$carga_sucursal->primer_apellido;
                              $natural_juridica->sys_status=true;

                            if (! ($flag = $natural_juridica->save(false))) {

                                $transaction->rollBack();
                                return "error en la carga de la persona natural";
                                break;
                            }

                            $persona_sucursal->rif= $carga_sucursal->rif;
                            $persona_sucursal->primer_nombre= $carga_sucursal->primer_nombre;
                            $persona_sucursal->segundo_nombre= $carga_sucursal->segundo_nombre;
                            $persona_sucursal->primer_apellido= $carga_sucursal->primer_apellido;
                            $persona_sucursal->segundo_apellido= $carga_sucursal->segundo_apellido;
                            $persona_sucursal->telefono_local= $carga_sucursal->telefono_local;
                            $persona_sucursal->telefono_celular= $carga_sucursal->telefono_celular;
                            $persona_sucursal->fax= $carga_sucursal->fax;
                            $persona_sucursal->correo= $carga_sucursal->correo;
                            $persona_sucursal->pagina_web= $carga_sucursal->pagina_web;
                            $persona_sucursal->facebook= $carga_sucursal->facebook;
                            $persona_sucursal->twitter= $carga_sucursal->twitter;
                            $persona_sucursal->instagram= $carga_sucursal->instagram;

                            $persona_sucursal->sys_pais_id = 1;
                            $persona_sucursal->nacionalidad = "NACIONAL";
                            $persona_sucursal->creado_por = 1;

                            if (! ($flag =  $persona_sucursal->save(false))) {

                                $transaction->rollBack();
                                return "error en la carga de la persona de contacto";
                            }

                            $sucursal->representante= $carga_sucursal->representante;
                            $sucursal->accionista= $carga_sucursal->accionista;
                            $sucursal->persona_natural_id= $persona_sucursal->id;
                            $sucursal->direccion_id= $direccion_sucursal->id;
                            $sucursal->contratista_id= $usuario->contratista_id;
                             if (! ($flag =   $sucursal->save(false))) {

                                $transaction->rollBack();
                                return "error en la carga de la sucursal";
                            }
                        }
                        Yii::$app->session->setFlash('success', 'Datos bancos guardados con exito');
                        $transaction->commit();
                        return "Datos guardados con exito";

           } catch (Exception $e) {
               $transaction->rollBack();
           }
       }

    /**
     * Updates an existing Sucursales model.
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
    
    
      public function actionCrearsucursal()
    {
       
            return $this->render('_sucursales',['relacion_sucursal' => (empty($relacion_sucursal)) ? [new RelacionesSucursales()] : $relacion_sucursal]);

       
    }

    /**
     * Deletes an existing Sucursales model.
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
     * Finds the Sucursales model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Sucursales the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Sucursales::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
