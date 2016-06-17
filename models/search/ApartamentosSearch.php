<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Apartamentos;

/**
 * ApartamentosSearch represents the model behind the search form about `app\models\Apartamentos`.
 */
class ApartamentosSearch extends Apartamentos
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_apartamento', 'usuarios_id_usuario_pr', 'usuarios_id_usuario_in'], 'integer'],
            [['ubicacion', 'observaciones'], 'safe'],
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
        $query = Apartamentos::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_apartamento' => $this->id_apartamento,
            'usuarios_id_usuario_pr' => $this->usuarios_id_usuario,
            'usuarios_id_usuario_in' => $this->usuarios_id_usuario,
        ]);

        $query->andFilterWhere(['like', 'ubicacion', $this->ubicacion])
            ->andFilterWhere(['like', 'observaciones', $this->observaciones]);

        return $dataProvider;
    }
}
