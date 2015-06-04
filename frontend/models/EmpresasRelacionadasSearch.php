<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\p\EmpresasRelacionadas;

/**
 * EmpresasRelacionadasSearch represents the model behind the search form about `common\models\p\EmpresasRelacionadas`.
 */
class EmpresasRelacionadasSearch extends EmpresasRelacionadas
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'persona_juridica_id', 'persona_contacto_id', 'creado_por', 'actualizado_por', 'contratista_id', 'documento_registrado_id'], 'integer'],
            [['tipo_relacion','fecha_inicio', 'fecha_fin', 'sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
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
        $query = EmpresasRelacionadas::find();

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
            'fecha_inicio' => $this->fecha_inicio,
            'fecha_fin' => $this->fecha_fin,
            'persona_juridica_id' => $this->persona_juridica_id,
            'persona_contacto_id' => $this->persona_contacto_id,
            'creado_por' => $this->creado_por,
            'actualizado_por' => $this->actualizado_por,
            'sys_status' => $this->sys_status,
            'sys_creado_el' => $this->sys_creado_el,
            'sys_actualizado_el' => $this->sys_actualizado_el,
            'sys_finalizado_el' => $this->sys_finalizado_el,
            'contratista_id' => $this->contratista_id,
            'documento_registrado_id' => $this->documento_registrado_id,
        ]);

        $query->andFilterWhere(['like', 'tipo_relacion', $this->tipo_relacion]);

        return $dataProvider;
    }
}
