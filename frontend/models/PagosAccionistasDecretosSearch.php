<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\p\PagosAccionistasDecretos;

/**
 * PagosAccionistasDecretosSearch represents the model behind the search form about `common\models\p\PagosAccionistasDecretos`.
 */
class PagosAccionistasDecretosSearch extends PagosAccionistasDecretos
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'decreto_div_excedente_id', 'creado_por', 'actualizado_por', 'contratista_id', 'natural_juridica_id','documento_registrado_id'], 'integer'],
            [['monto_cancelado'], 'number'],
            [['fecha', 'sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el', 'tipo_pago', 'numero'], 'safe'],
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
        $query = PagosAccionistasDecretos::find();

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
            'decreto_div_excedente_id' => $this->decreto_div_excedente_id,
            'monto_cancelado' => $this->monto_cancelado,
            'fecha' => $this->fecha,
            'creado_por' => $this->creado_por,
            'actualizado_por' => $this->actualizado_por,
            'sys_status' => $this->sys_status,
            'sys_creado_el' => $this->sys_creado_el,
            'sys_actualizado_el' => $this->sys_actualizado_el,
            'sys_finalizado_el' => $this->sys_finalizado_el,
            'contratista_id' => Yii::$app->user->identity->contratista_id,
            'natural_juridica_id' => $this->natural_juridica_id,
            'documento_registrado_id' => $this->natural_juridica_id,
        ]);

        $query->andFilterWhere(['like', 'tipo_pago', $this->tipo_pago])
            ->andFilterWhere(['like', 'numero', $this->numero]);

        return $dataProvider;
    }
}
