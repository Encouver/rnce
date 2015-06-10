<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\c\CuentasEInversiones;

/**
 * CuentasEInversionesSearch represents the model behind the search form about `common\models\c\CuentasEInversiones`.
 */
class CuentasEInversionesSearch extends CuentasEInversiones
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'empresa_relacionada_id', 'disponibilidad_id', 'tipo_instrumento_id', 'numero_acc_bon', 'e_inversion_info_adicional_id', 'contratista_id', 'creado_por', 'actualizado_por'], 'integer'],
            [['corriente', 'sys_status'], 'boolean'],
            [['nombre_instrumento', 'anho', 'sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
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
        $query = CuentasEInversiones::find();

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
            'empresa_relacionada_id' => $this->empresa_relacionada_id,
            'corriente' => $this->corriente,
            'disponibilidad_id' => $this->disponibilidad_id,
            'tipo_instrumento_id' => $this->tipo_instrumento_id,
            'numero_acc_bon' => $this->numero_acc_bon,
            'e_inversion_info_adicional_id' => $this->e_inversion_info_adicional_id,
            'contratista_id' => $this->contratista_id,
            'creado_por' => $this->creado_por,
            'actualizado_por' => $this->actualizado_por,
            'sys_status' => $this->sys_status,
            'sys_creado_el' => $this->sys_creado_el,
            'sys_actualizado_el' => $this->sys_actualizado_el,
            'sys_finalizado_el' => $this->sys_finalizado_el,
        ]);

        $query->andFilterWhere(['like', 'nombre_instrumento', $this->nombre_instrumento])
            ->andFilterWhere(['like', 'anho', $this->anho]);

        return $dataProvider;
    }
}
