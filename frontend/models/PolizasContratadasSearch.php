<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\p\PolizasContratadas;

/**
 * PolizasContratadasSearch represents the model behind the search form about `common\models\p\PolizasContratadas`.
 */
class PolizasContratadasSearch extends PolizasContratadas
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'contratista_id', 'duracion', 'creado_por', 'actualizado_por', 'natural_juridica_id', 'bien_id'], 'integer'],
            [['numero_contrato', 'fecha_suscripcion', 'fecha_inicio', 'fecha_finalizacion', 'tipo_poliza', 'sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['monto_asegurado', 'monto_contrato'], 'number'],
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
        $query = PolizasContratadas::find();

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
            'fecha_suscripcion' => $this->fecha_suscripcion,
            'fecha_inicio' => $this->fecha_inicio,
            'fecha_finalizacion' => $this->fecha_finalizacion,
            'duracion' => $this->duracion,
            'monto_asegurado' => $this->monto_asegurado,
            'monto_contrato' => $this->monto_contrato,
            'creado_por' => $this->creado_por,
            'actualizado_por' => $this->actualizado_por,
            'sys_status' => $this->sys_status,
            'sys_creado_el' => $this->sys_creado_el,
            'sys_actualizado_el' => $this->sys_actualizado_el,
            'sys_finalizado_el' => $this->sys_finalizado_el,
            'natural_juridica_id' => $this->natural_juridica_id,
            'bien_id' => $this->bien_id,
        ]);

        $query->andFilterWhere(['like', 'numero_contrato', $this->numero_contrato])
            ->andFilterWhere(['like', 'tipo_poliza', $this->tipo_poliza]);

        return $dataProvider;
    }
}
