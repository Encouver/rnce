<?php

namespace frontend\controllers;

use Yii;
use common\models\p\OrigenesCapitales;
use common\models\p\CertificacionesAportes;
use common\models\a\ActivosDocumentosRegistrados;
use app\models\OrigenesCapitalesSearch;
use common\components\BaseController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;

/**
 * OrigenesCapitalesController implements the CRUD actions for OrigenesCapitales model.
 */
class OrigenesCapitalesController extends BaseController
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
     * Lists all OrigenesCapitales models.
     * @return mixed
     */
    public function actionIndex()
    {
       $searchModel = new OrigenesCapitalesSearch();
         $searchModel->efectivo = true;
        $dataProvider_efectivo = $searchModel->search(Yii::$app->request->queryParams);
        $searchModel->efectivo = false;
        $searchModel->banco = true;
        $dataProvider_banco = $searchModel->search(Yii::$app->request->queryParams);
        $searchModel->efectivo = false;
        $searchModel->banco = false;
        $searchModel->bien = true;
        $dataProvider_bien = $searchModel->search(Yii::$app->request->queryParams);



        return $this->render('index', [
            'dataProvider_efectivo' => $dataProvider_efectivo,
            'dataProvider_banco' => $dataProvider_banco,
            'dataProvider_bien' => $dataProvider_bien,
            'searchModel'=>$searchModel,
        ]);
    }
    public function actionOrigen()
    {
       $searchModel = new OrigenesCapitalesSearch();
       $documento=$searchModel->Modificacionactual();
       if(isset($documento)){
            $searchModel->documento_registrado_id= $documento->documento_registrado_id;
          
        }
        
        $searchModel->efectivo = true;
        $dataProvider_efectivo = $searchModel->search(Yii::$app->request->queryParams);
        $searchModel->efectivo = false;
        $searchModel->banco = true;
        $dataProvider_banco = $searchModel->search(Yii::$app->request->queryParams);
        $searchModel->efectivo = false;
        $searchModel->banco = false;
        $searchModel->bien = true;
        $dataProvider_bien = $searchModel->search(Yii::$app->request->queryParams);
        $searchModel->efectivo = false;
        $searchModel->banco = false;
        $searchModel->bien = false;
        $searchModel->cuenta_pagar = true;
       $dataProvider_cuentapagar = $searchModel->search(Yii::$app->request->queryParams);
       $searchModel->efectivo = false;
        $searchModel->banco = false;
        $searchModel->bien = false;
        $searchModel->cuenta_pagar = false;
        $searchModel->decreto = true;
        $dataProvider_decreto = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('origen', [
            'dataProvider_efectivo' => $dataProvider_efectivo,
            'dataProvider_banco' => $dataProvider_banco,
            'dataProvider_bien' => $dataProvider_bien,
            'dataProvider_cuentapagar'=> $dataProvider_cuentapagar,
            'dataProvider_decreto'=> $dataProvider_decreto,
            'searchModel'=>$searchModel,
            'documento'=>$documento
        ]);
    }


    /**
     * Displays a single OrigenesCapitales model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
    public function actionSubcat() {
            $out = [];
            if (isset($_POST['depdrop_parents'])) {
                    
                $parents = $_POST['depdrop_parents'];
                if ($parents != null) {
                    $categoria = $parents[0];
                    switch ($categoria){
                        case "PAGO_CAPITAL":
                            $out= [
                                    ['id' => 'ACCIONISTAS', 'name' => 'ACCIONISTAS'],
                                ];
                            break;
                        case "AUMENTO_CAPITAL":
                            $out= [
                                    ['id' => 'ACCIONISTAS', 'name' => 'ACCIONISTAS'],
                                    ['id' => 'PROVEEDORES', 'name' => 'PROVEEDORES'],
                                    ['id' => 'EMPLEADOS', 'name' => 'EMPLEADOS'],
                                    ['id' => 'EMPRESAS RELACIONADAS', 'name' => 'EMPRESAS RELACIONADAS'],
                                
                                ];
                            break;
                        case "FONDO_EMERGENCIA":
                            $out= [
                                    ['id' => 'ASOCIADOS', 'name' => 'ASOCIADOS'],
                                    
                                ];
                            break;
                     
                        default:
                        break;
                      

                    }
                    
                  

            // the getSubCatList function will query the database based on the
            // cat_id and return an array like below:
            // [
            // ['id'=>'<sub-cat-id-1>', 'name'=>'<sub-cat-name1>'],
            // ['id'=>'<sub-cat_id_2>', 'name'=>'<sub-cat-name2>']
            // ]

                    return Json::encode(['output'=>$out, 'selected'=>'']);
                   
                }
            }
        return Json::encode(['output'=>'', 'selected'=>'']);
    }


    /**
     * Creates a new OrigenesCapitales model.
     * @param integer $identificador
     * @return mixed
     */
    public function actionCreate($identificador=null)
    {
    
        $model = new OrigenesCapitales();
        if (!is_null($identificador)){
            switch ($identificador){
            case "efectivo":
                $model->scenario=$identificador;
                $model->efectivo=true;
                break;
            case "banco":
                $model->scenario=$identificador;
                $model->banco=true;
                break;
            case "bien":
                $model->scenario=$identificador;
                $model->bien=true;
                break;
            case "cuentapagar":
                $model->scenario=$identificador;
                $model->cuenta_pagar=true;
                break;
            case "decreto":
                $model->scenario=$identificador;
                $model->decreto=true;
                break;
            default :
                break;
            }  
        }
        
        if($model->existeregistro()){
            Yii::$app->session->setFlash('error','Debe crear un documento registrado');
            return $this->redirect(['index']);
          }
          
           if($model->principal && !$model->validarcapital()){
            Yii::$app->session->setFlash('error','No existe capital suscrito');
            return $this->redirect(['index']);
         }
        if ($model->load(Yii::$app->request->post())&& $model->save()) {
           
                        if($model->principal){
                        return $this->redirect(['index']);
                  
                        }else{
                            return $this->redirect(['origen']);
                        }
                     
            }else{
                    //return print_r($model);
                        return $this->render('create', [
                            'model' => $model,
                            ]);
            }
    }
    
    
    
   

    /**
     * Updates an existing OrigenesCapitales model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
       
           if($model->efectivo){
               $model->scenario='efectivo';
           }else{
               
               if($model->banco){
               $model->scenario='banco';
                }else{
                    if($model->bien){
                        $model->scenario='bien';
                    }else{
               
                        if($model->cuenta_pagar){
                        $model->scenario='cuentapagar';
                        }else{
                            $model->scenario='decreto';
                        }
                    }
                    
                }
           }
        

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing OrigenesCapitales model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
       /* $model = $this->findModel($id);
        $model->delete();*/
       $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the OrigenesCapitales model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return OrigenesCapitales the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = OrigenesCapitales::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
