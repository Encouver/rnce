<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\p\ActasConstitutivas;

/**
 * ActasConstitutivasSearch represents the model behind the search form about `common\models\p\ActasConstitutivas`.
 */
class ActasConstitutivasSearch extends ActasConstitutivas
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'contratista_id', 'documento_registrado_id', 'denominacion_comercial_id', 'duracion_empresa_id', 'objeto_social_id', 'razon_social_id', 'domicilio_id', 'accionista_otro', 'comisario_auditor_id', 'cierre_ejercicio_id'], 'integer'],
            [['fecha_modificacion', 'sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['sys_status', 'capital_principal', 'pago_capital', 'aporte_capitalizar', 'aumento_capital', 'coreccion_monetaria', 'disminucion_capital', 'limitacion_capital', 'limitacion_capital_afectado', 'fondo_emergencia', 'reintegro_perdida', 'venta_accion', 'fusion_empresarial', 'decreto_div_excedente', 'modificacion_balance'], 'boolean'],
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
        $query = ActasConstitutivas::find();

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
            'contratista_id' => $this->contratista_id,
            'documento_registrado_id' => $this->documento_registrado_id,
            'denominacion_comercial_id' => $this->denominacion_comercial_id,
            'duracion_empresa_id' => $this->duracion_empresa_id,
            'objeto_social_id' => $this->objeto_social_id,
            'razon_social_id' => $this->razon_social_id,
            'domicilio_id' => $this->domicilio_id,
            'accionista_otro' => $this->accionista_otro,
            'comisario_auditor_id' => $this->comisario_auditor_id,
            'cierre_ejercicio_id' => $this->cierre_ejercicio_id,
            'fecha_modificacion' => $this->fecha_modificacion,
            'sys_status' => $this->sys_status,
            'sys_creado_el' => $this->sys_creado_el,
            'sys_actualizado_el' => $this->sys_actualizado_el,
            'sys_finalizado_el' => $this->sys_finalizado_el,
            'capital_principal' => $this->capital_principal,
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
        ]);

        return $dataProvider;
    }
}
