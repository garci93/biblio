<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;

class GenerosSearch extends Generos
{
    public function rules()
    {
        return [
            [['denom'], 'string', 'max' => 255],
            [['created_at'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Generos::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 5,
            ],
            'sort' => [
                'attributes' => [
                    'denom' => [
                        'label' => 'Denominación',
                    ],
                ],
            ],
        ]);

        $this->load($params);
     
        if (!$this->validate()) {
            $query->where('1 = 0');
            return $dataProvider;
        }

        $query->andFilterWhere(['ilike', 'denom', $this->denom]);

        return $dataProvider;
    }
}
