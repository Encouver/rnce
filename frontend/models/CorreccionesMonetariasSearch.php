<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\p\CorreccionesMonetarias;

/**
 * CorreccionesMonetariasSearch represents the model behind the search form about `common\models\p\CorreccionesMonetarias`.
 */
class CorreccionesMonetariasSearch extends CorreccionesMonetarias
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'total_accion', 'creado_por', 'actualizado_por', 'contratista_id', 'documento_registrado_id', 'certificacion_aporte_id'], 'integer'],
            [['fecha_aumento', 'sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el', 'fecha_informe','actual'], 'safe'],
            [['valor_accion', 'variacion_valor', 'monto_capital_legal', 'valor_accion_comun', 'variacion_valor_comun', 'total_accion_comun'], 'number'],
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
        $query = CorreccionesMonetarias::find();

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
            'fecha_aumento' => $this->fecha_aumento,
            'valor_accion' => $this->valor_accion,
            'variacion_valor' => $this->variacion_valor,
            'total_accion' => $this->total_accion,
            'monto_capital_legal' => $this->monto_capital_legal,
            'creado_por' => $this->creado_por,
            'actualizado_por' => $this->actualizado_por,
            'sys_status' => $this->sys_status,
            'sys_creado_el' => $this->sys_creado_el,
            'sys_actualizado_el' => $this->sys_actualizado_el,
            'sys_finalizado_el' => $this->sys_finalizado_el,
            'contratista_id' => Yii::$app->user->identity->contratista_id,
            'documento_registrado_id' => $this->documento_registrado_id,
            'certificacion_aporte_id' => $this->certificacion_aporte_id,
            'fecha_informe' => $this->fecha_informe,
            'valor_accion_comun' => $this->valor_accion_comun,
            'variacion_valor_comun' => $this->variacion_valor_comun,
            'total_accion_comun' => $this->total_accion_comun,
            'actual' => $this->actual,
        ]);

        return $dataProvider;
    }
}
