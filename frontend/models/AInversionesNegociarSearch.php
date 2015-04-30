<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\c\AInversionesNegociar;

/**
 * AInversionesNegociarSearch represents the model behind the search form about `common\models\c\AInversionesNegociar`.
 */
class AInversionesNegociarSearch extends AInversionesNegociar
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'banco_id', 'plazo', 'tipo_moneda_id', 'contratista_id', 'creado_por', 'total_id'], 'integer'],
            [['fecha_inversion', 'fecha_finalizacion', 'sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el', 'anho'], 'safe'],
            [['tasa', 'costo_adquisicion', 'valorizacion', 'saldo_al_cierre', 'intereses_act_eco', 'monto_moneda_extra', 'tipo_cambio_cierre'], 'number'],
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
        $query = AInversionesNegociar::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'banco_id' => $this->banco_id,
            'fecha_inversion' => $this->fecha_inversion,
            'fecha_finalizacion' => $this->fecha_finalizacion,
            'tasa' => $this->tasa,
            'plazo' => $this->plazo,
            'costo_adquisicion' => $this->costo_adquisicion,
            'valorizacion' => $this->valorizacion,
            'saldo_al_cierre' => $this->saldo_al_cierre,
            'intereses_act_eco' => $this->intereses_act_eco,
            'tipo_moneda_id' => $this->tipo_moneda_id,
            'monto_moneda_extra' => $this->monto_moneda_extra,
            'tipo_cambio_cierre' => $this->tipo_cambio_cierre,
            'sys_status' => $this->sys_status,
            'sys_creado_el' => $this->sys_creado_el,
            'sys_actualizado_el' => $this->sys_actualizado_el,
            'sys_finalizado_el' => $this->sys_finalizado_el,
            'contratista_id' => $this->contratista_id,
            'creado_por' => $this->creado_por,
            'total_id' => $this->total_id,
        ]);

        $query->andFilterWhere(['like', 'anho', $this->anho]);

        return $dataProvider;
    }
}
