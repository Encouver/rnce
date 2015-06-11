<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\p\LimitacionesCapitales;

/**
 * LimitacionesCapitalesSearch represents the model behind the search form about `common\models\p\LimitacionesCapitales`.
 */
class LimitacionesCapitalesSearch extends LimitacionesCapitales
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'certificacion_aporte_id', 'creado_por', 'actualizado_por', 'contratista_id', 'documento_registrado_id', 'total_accion', 'total_accion_comun'], 'integer'],
            [['afecta', 'supuesto', 'reintegro', 'sys_status', 'actual'], 'boolean'],
            [['fecha_cierre', 'fecha_limitacion', 'sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el', 'fecha_informe'], 'safe'],
            [['capital_social', 'total_patrimonio', 'porcentaje_descapitalizacion', 'monto_perdida', 'capital_social_actualizado', 'capital_legal', 'saldo_perdida', 'valor_accion', 'valor_accion_comun', 'valor_accion_actual', 'valor_accion_comun_actual', 'capital_legal_actual', 'total_capital','capital_legal_actualizado'], 'number'],
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
        $query = LimitacionesCapitales::find();

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
            'afecta' => $this->afecta,
            'fecha_cierre' => $this->fecha_cierre,
            'capital_social' => $this->capital_social,
            'total_patrimonio' => $this->total_patrimonio,
            'porcentaje_descapitalizacion' => $this->porcentaje_descapitalizacion,
            'supuesto' => $this->supuesto,
            'monto_perdida' => $this->monto_perdida,
            'fecha_limitacion' => $this->fecha_limitacion,
            'capital_social_actualizado' => $this->capital_social_actualizado,
            'certificacion_aporte_id' => $this->certificacion_aporte_id,
            'reintegro' => $this->reintegro,
            'capital_legal' => $this->capital_legal,
            'saldo_perdida' => $this->saldo_perdida,
            'creado_por' => $this->creado_por,
            'actualizado_por' => $this->actualizado_por,
            'sys_status' => $this->sys_status,
            'sys_creado_el' => $this->sys_creado_el,
            'sys_actualizado_el' => $this->sys_actualizado_el,
            'sys_finalizado_el' => $this->sys_finalizado_el,
            'fecha_informe' => $this->fecha_informe,
            'contratista_id' => $this->contratista_id,
            'documento_registrado_id' => $this->documento_registrado_id,
            'actual' => $this->actual,
            'valor_accion' => $this->valor_accion,
            'valor_accion_comun' => $this->valor_accion_comun,
            'total_accion' => $this->total_accion,
            'total_accion_comun' => $this->total_accion_comun,
            'valor_accion_actual' => $this->valor_accion_actual,
            'valor_accion_comun_actual' => $this->valor_accion_comun_actual,
            'capital_legal_actual' => $this->capital_legal_actual,
            'total_capital' => $this->total_capital,
            'capital_legal_actualizado'=>$this->capital_legal_actualizado,
        ]);

        return $dataProvider;
    }
}
