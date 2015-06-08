<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\c\CuentasI2DeclaracionIslr;

/**
 * CuentasI2DeclaracionIslrSearch represents the model behind the search form about `common\models\c\CuentasI2DeclaracionIslr`.
 */
class CuentasI2DeclaracionIslrSearch extends CuentasI2DeclaracionIslr
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'tipo_declaracion_id', 'numero_planilla', 'creado_por', 'actualizado_por', 'contratista_id'], 'integer'],
            [['num_certificado_elec', 'fecha', 'sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el', 'anho'], 'safe'],
            [['total_ingresos', 'total_egresos', 'impuesto_determinado', 'impuesto_pagado'], 'number'],
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
        $query = CuentasI2DeclaracionIslr::find();

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
            'tipo_declaracion_id' => $this->tipo_declaracion_id,
            'numero_planilla' => $this->numero_planilla,
            'fecha' => $this->fecha,
            'total_ingresos' => $this->total_ingresos,
            'total_egresos' => $this->total_egresos,
            'impuesto_determinado' => $this->impuesto_determinado,
            'impuesto_pagado' => $this->impuesto_pagado,
            'creado_por' => $this->creado_por,
            'actualizado_por' => $this->actualizado_por,
            'sys_status' => $this->sys_status,
            'sys_creado_el' => $this->sys_creado_el,
            'sys_actualizado_el' => $this->sys_actualizado_el,
            'sys_finalizado_el' => $this->sys_finalizado_el,
            'contratista_id' => $this->contratista_id,
        ]);

        $query->andFilterWhere(['like', 'num_certificado_elec', $this->num_certificado_elec])
            ->andFilterWhere(['like', 'anho', $this->anho]);

        return $dataProvider;
    }
}
