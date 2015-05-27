<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\p\CertificacionesAportes;

/**
 * CertificacionesAportesSearch represents the model behind the search form about `common\models\p\CertificacionesAportes`.
 */
class CertificacionesAportesSearch extends CertificacionesAportes
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'creado_por', 'actualizado_por', 'documento_registrado_id', 'contratista_id'], 'integer'],
            [['colegiatura', 'tipo_profesion', 'fecha_informe', 'sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
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
        $query = CertificacionesAportes::find();

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
            'fecha_informe' => $this->fecha_informe,
            'creado_por' => $this->creado_por,
            'actualizado_por' => $this->actualizado_por,
            'sys_status' => $this->sys_status,
            'sys_creado_el' => $this->sys_creado_el,
            'sys_actualizado_el' => $this->sys_actualizado_el,
            'sys_finalizado_el' => $this->sys_finalizado_el,
            'documento_registrado_id' => $this->documento_registrado_id,
            'contratista_id' => $this->contratista_id,
        ]);

        $query->andFilterWhere(['like', 'colegiatura', $this->colegiatura])
            ->andFilterWhere(['like', 'tipo_profesion', $this->tipo_profesion]);

        return $dataProvider;
    }
}
