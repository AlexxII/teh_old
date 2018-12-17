<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\teh\Photo;

/**
 * PhotoSearch represents the model behind the search form of `app\models\teh\Photo`.
 */
class PhotoSearch extends Photo
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'eq_id'], 'integer'],
            [['photo_path'], 'safe'],
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
        $query = Photo::find();

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
            'id' => $this->id,
            'eq_id' => $this->eq_id,
        ]);

        $query->andFilterWhere(['like', 'photo_path', $this->photo_path]);

        return $dataProvider;
    }
}
