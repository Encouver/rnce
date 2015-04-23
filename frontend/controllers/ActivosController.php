<?php

namespace frontend\controllers;

use common\models\a\Bienes;

use kartik\widgets\DatePicker;

class ActivosController extends \common\components\BaseController
{

    public function actionListasTiposBien($id)
    {
        $countTiposBien = \common\models\SysTiposBienes::find()
                ->where(['sys_clasificacion_bien_id' => $id])
                ->count();
 
        $tiposBien = \common\models\SysTiposBienes::find()
                ->where(['sys_clasificacion_bien_id' => $id])
                ->orderBy('id DESC')
                ->all();
 
        if($countTiposBien>0){
            foreach($tiposBien as $tipo){
                echo "<option value='".$tipo->id."'>".$tipo->nombre."</option>";
            }
        }
        else{
            echo "<option>-</option>";
        }
 
    }

    public function actionOrigen($id)
    {
        $model = new Bienes();
$form = \kartik\form\ActiveForm::begin();
        switch ($id) {
            case 0:
                # code...
         // usage without model
                echo '<label>Check Issue Date</label>';
                echo DatePicker::widget([
                    'model'=>$model,
                    'attribute'=> 'origen',
                    'name' => 'check_issue_date', 
                    'value' => date('d-M-Y', strtotime('+2 days')),
                    'options' => ['placeholder' => 'Select issue date ...'],
                    'pluginOptions' => [
                        'format' => 'dd-M-yyyy',
                        'todayHighlight' => true
                    ]
                ]);
                break;
            case 1:
                # code...
                break;
            
            case 2:
                # code...
                break;
            case 3:
                # code...
         // usage without model
                echo '<label>Check Issue Date</label>';
                echo DatePicker::widget([
                    'model'=>$model,
                    'attribute'=> 'origen',
                    'name' => 'check_issue_date', 
                    'value' => date('d-M-Y', strtotime('+2 days')),
                    'options' => ['placeholder' => 'Select issue date ...'],
                    'pluginOptions' => [
                        'format' => 'dd-M-yyyy',
                        'todayHighlight' => true
                    ]
                ]);
                break;
            case 4:
                # code...
                break;

            default:
                # code...
                break;
        }
 
    }

    public function actionAsociarFactura()
    {
        return $this->render('asociar-factura');
    }

    public function actionCargarDocumento()
    {
        return $this->render('cargar-documento');
    }

    public function actionDatosAvaluo()
    {
        return $this->render('datos-avaluo');
    }

    public function actionDeterioro()
    {
        return $this->render('deterioro');
    }

    public function actionIndex()
    {
        $model = new Bienes();

        return $this->render('index',['model'=>$model]);
    }

    public function actionModelosDeam()
    {
        return $this->render('modelos-deam');
    }

    public function actionRegistrarBien()
    {
        return $this->render('registrar-bien');
    }

}
