<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\c\AEfectivosBancos;

/**
 * AEfectivosBancosSearch represents the model behind the search form about `common\models\c\AEfectivosBancos`.
 */
class AEfectivosBancosSearch extends AEfectivosBancos
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'banco_contratista_id', 'tipo_moneda_id', 'creado_por', 'contratista_id', 'total_id'], 'integer'],
            [['saldo_segun_b', 'nd_no_cont', 'depo_transito', 'nc_no_cont', 'cheques_transito', 'saldo_al_cierre', 'intereses_act_eco', 'monto_moneda_extra', 'tipo_cambio_cierre'], 'number'],
            [['sys_status'], 'boolean'],
            [['sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el', 'anho'], 'safe'],
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
        $query = AEfectivosBancos::find();

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
            'banco_contratista_id' => $this->banco_contratista_id,
            'saldo_segun_b' => $this->saldo_segun_b,
            'nd_no_cont' => $this->nd_no_cont,
            'depo_transito' => $this->depo_transito,
            'nc_no_cont' => $this->nc_no_cont,
            'cheques_transito' => $this->cheques_transito,
            'saldo_al_cierre' => $this->saldo_al_cierre,
            'intereses_act_eco' => $this->intereses_act_eco,
            'tipo_moneda_id' => $this->tipo_moneda_id,
            'monto_moneda_extra' => $this->monto_moneda_extra,
            'tipo_cambio_cierre' => $this->tipo_cambio_cierre,
            'creado_por' => $this->creado_por,
            'sys_status' => $this->sys_status,
            'sys_creado_el' => $this->sys_creado_el,
            'sys_actualizado_el' => $this->sys_actualizado_el,
            'sys_finalizado_el' => $this->sys_finalizado_el,
            'contratista_id' => $this->contratista_id,
            'total_id' => $this->total_id,
        ]);

        $query->andFilterWhere(['like', 'anho', $this->anho]);

        return $dataProvider;
    }
}
