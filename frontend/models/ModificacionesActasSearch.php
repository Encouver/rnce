<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\p\ModificacionesActas;

/**
 * ModificacionesActasSearch represents the model behind the search form about `common\models\p\ModificacionesActas`.
 */
class ModificacionesActasSearch extends ModificacionesActas
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'contratista_id', 'documento_registrado_id', 'creado_por', 'actualizado_por'], 'integer'],
            [['pago_capital', 'aporte_capitalizar', 'aumento_capital', 'coreccion_monetaria', 'disminucion_capital', 'limitacion_capital', 'limitacion_capital_afectado', 'fondo_emergencia', 'reintegro_perdida', 'venta_accion', 'fusion_empresarial', 'decreto_div_excedente', 'modificacion_balance', 'razon_social', 'denominacion_comercial', 'domicilio_fiscal', 'domicilio_principal', 'objeto_social', 'representante_legal', 'junta_directiva', 'duracion_empresa', 'cierre_ejercicio', 'sys_status','comisario'], 'boolean'],
            [['sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = ModificacionesActas::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'contratista_id' => Yii::$app->user->identity->contratista_id,
            'documento_registrado_id' => $this->documento_registrado_id,
            'pago_capital' => $this->pago_capital,
            'aporte_capitalizar' => $this->aporte_capitalizar,
            'aumento_capital' => $this->aumento_capital,
            'coreccion_monetaria' => $this->coreccion_monetaria,
            'disminucion_capital' => $this->disminucion_capital,
            'limitacion_capital' => $this->limitacion_capital,
            'limitacion_capital_afectado' => $this->limitacion_capital_afectado,
            'fondo_emergencia' => $this->fondo_emergencia,
            'reintegro_perdida' => $this->reintegro_perdida,
            'venta_accion' => $this->venta_accion,
            'fusion_empresarial' => $this->fusion_empresarial,
            'decreto_div_excedente' => $this->decreto_div_excedente,
            'modificacion_balance' => $this->modificacion_balance,
            'razon_social' => $this->razon_social,
            'denominacion_comercial' => $this->denominacion_comercial,
            'domicilio_fiscal' => $this->domicilio_fiscal,
            'domicilio_principal' => $this->domicilio_principal,
            'objeto_social' => $this->objeto_social,
            'representante_legal' => $this->representante_legal,
            'junta_directiva' => $this->junta_directiva,
            'duracion_empresa' => $this->duracion_empresa,
            'cierre_ejercicio' => $this->cierre_ejercicio,
            'comisario' => $this->comisario,
            'creado_por' => $this->creado_por,
            'actualizado_por' => $this->actualizado_por,
            'sys_status' => $this->sys_status,
            'sys_creado_el' => $this->sys_creado_el,
            'sys_actualizado_el' => $this->sys_actualizado_el,
            'sys_finalizado_el' => $this->sys_finalizado_el,
           
        ]);

        return $dataProvider;
    }
}
