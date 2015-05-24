<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\p\Certificados;

/**
 * CertificadosSearch represents the model behind the search form about `common\models\p\Certificados`.
 */
class CertificadosSearch extends Certificados
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'numero_asociacion', 'numero_aportacion', 'numero_rotativo', 'numero_inversion', 'documento_registrado_id', 'contratista_id', 'creado_por', 'actualizado_por'], 'integer'],
            [['valor_asociacion', 'valor_aportacion', 'valor_rotativo', 'valor_inversion', 'capital'], 'number'],
            [['tipo_certificado', 'sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['suscrito', 'sys_status'], 'boolean'],
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
        $query = Certificados::find();

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
            'numero_asociacion' => $this->numero_asociacion,
            'numero_aportacion' => $this->numero_aportacion,
            'numero_rotativo' => $this->numero_rotativo,
            'numero_inversion' => $this->numero_inversion,
            'valor_asociacion' => $this->valor_asociacion,
            'valor_aportacion' => $this->valor_aportacion,
            'valor_rotativo' => $this->valor_rotativo,
            'valor_inversion' => $this->valor_inversion,
            'suscrito' => $this->suscrito,
            'documento_registrado_id' => $this->documento_registrado_id,
            'contratista_id' => Yii::$app->user->identity->contratista_id,
            'creado_por' => $this->creado_por,
            'actualizado_por' => $this->actualizado_por,
            'sys_status' => $this->sys_status,
            'sys_creado_el' => $this->sys_creado_el,
            'sys_actualizado_el' => $this->sys_actualizado_el,
            'sys_finalizado_el' => $this->sys_finalizado_el,
            'capital' => $this->capital,
        ]);

        $query->andFilterWhere(['like', 'tipo_certificado', $this->tipo_certificado]);

        return $dataProvider;
    }
}
