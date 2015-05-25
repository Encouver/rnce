<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\c\CuentasD1IslrPagadoAnticipo;

/**
 * CuentasD1IslrPagadoAnticipoSearch represents the model behind the search form about `common\models\c\CuentasD1IslrPagadoAnticipo`.
 */
class CuentasD1IslrPagadoAnticipoSearch extends CuentasD1IslrPagadoAnticipo
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'islr_pagado_id', 'contratista_id', 'creado_por', 'actualizado_por'], 'integer'],
            [['nro_documento', 'anho', 'sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['saldo_ph', 'importe_pagado_ejer_econo', 'importe_aplicado_ejer_econo', 'saldo_cierre', 'monto'], 'number'],
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
        $query = CuentasD1IslrPagadoAnticipo::find();

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
            'islr_pagado_id' => $this->islr_pagado_id,
            'saldo_ph' => $this->saldo_ph,
            'importe_pagado_ejer_econo' => $this->importe_pagado_ejer_econo,
            'importe_aplicado_ejer_econo' => $this->importe_aplicado_ejer_econo,
            'saldo_cierre' => $this->saldo_cierre,
            'monto' => $this->monto,
            'contratista_id' => $this->contratista_id,
            'creado_por' => $this->creado_por,
            'actualizado_por' => $this->actualizado_por,
            'sys_status' => $this->sys_status,
            'sys_creado_el' => $this->sys_creado_el,
            'sys_actualizado_el' => $this->sys_actualizado_el,
            'sys_finalizado_el' => $this->sys_finalizado_el,
        ]);

        $query->andFilterWhere(['like', 'nro_documento', $this->nro_documento])
            ->andFilterWhere(['like', 'anho', $this->anho]);

        return $dataProvider;
    }
}
