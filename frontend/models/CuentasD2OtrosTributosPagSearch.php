<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\c\CuentasD2OtrosTributosPag;

/**
 * CuentasD2OtrosTributosPagSearch represents the model behind the search form about `common\models\c\CuentasD2OtrosTributosPag`.
 */
class CuentasD2OtrosTributosPagSearch extends CuentasD2OtrosTributosPag
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'otros_tributos_id', 'contratista_id', 'creado_por', 'actualizado_por'], 'integer'],
            [['saldo_pah', 'credito_fiscal', 'monto', 'debito_fiscal', 'debito_fiscal_no', 'importe_pagado', 'saldo_cierre'], 'number'],
            [['anho', 'sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['sys_status'], 'boolean'],
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
        $query = CuentasD2OtrosTributosPag::find();

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
            'otros_tributos_id' => $this->otros_tributos_id,
            'saldo_pah' => $this->saldo_pah,
            'credito_fiscal' => $this->credito_fiscal,
            'monto' => $this->monto,
            'debito_fiscal' => $this->debito_fiscal,
            'debito_fiscal_no' => $this->debito_fiscal_no,
            'importe_pagado' => $this->importe_pagado,
            'saldo_cierre' => $this->saldo_cierre,
            'contratista_id' => $this->contratista_id,
            'creado_por' => $this->creado_por,
            'actualizado_por' => $this->actualizado_por,
            'sys_status' => $this->sys_status,
            'sys_creado_el' => $this->sys_creado_el,
            'sys_actualizado_el' => $this->sys_actualizado_el,
            'sys_finalizado_el' => $this->sys_finalizado_el,
        ]);

        $query->andFilterWhere(['like', 'anho', $this->anho]);

        return $dataProvider;
    }
}
