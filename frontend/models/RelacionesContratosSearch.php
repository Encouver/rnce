<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\p\RelacionesContratos;

/**
 * RelacionesContratosSearch represents the model behind the search form about `common\models\p\RelacionesContratos`.
 */
class RelacionesContratosSearch extends RelacionesContratos
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'contratista_id', 'natural_juridica_id'], 'integer'],
            [['tipo_sector', 'tipo_contrato', 'nombre_proyecto', 'fecha_inicio', 'fecha_fin', 'evaluacion_ente', 'sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['monto_contrato', 'anticipo_recibido', 'porcentaje_ejecucion'], 'number'],
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
        $query = RelacionesContratos::find();

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
            'contratista_id' => $this->contratista_id,
            'fecha_inicio' => $this->fecha_inicio,
            'fecha_fin' => $this->fecha_fin,
            'monto_contrato' => $this->monto_contrato,
            'anticipo_recibido' => $this->anticipo_recibido,
            'porcentaje_ejecucion' => $this->porcentaje_ejecucion,
            'sys_status' => $this->sys_status,
            'sys_creado_el' => $this->sys_creado_el,
            'sys_actualizado_el' => $this->sys_actualizado_el,
            'sys_finalizado_el' => $this->sys_finalizado_el,
            'natural_juridica_id' => $this->natural_juridica_id,
        ]);

        $query->andFilterWhere(['like', 'tipo_sector', $this->tipo_sector])
            ->andFilterWhere(['like', 'tipo_contrato', $this->tipo_contrato])
            ->andFilterWhere(['like', 'nombre_proyecto', $this->nombre_proyecto])
            ->andFilterWhere(['like', 'evaluacion_ente', $this->evaluacion_ente]);

        return $dataProvider;
    }
}
