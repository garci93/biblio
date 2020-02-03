<?php

namespace app\models;

use Yii;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "generos".
 *
 * @property int $id
 * @property string $denom
 * @property string $created_at
 *
 * @property Libros[] $libros
 */
class Generos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'generos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['denom'], 'required'],
            [['denom'], 'string', 'max' => 255],
            [['denom'], 'unique'],
            [['total'], 'safe'],
        ];
    }

    public function search($params)
    {
        $query = Generos::find()
            ->select(['generos.*', 'COUNT(l.id) AS total'])
            ->joinWith('libros l')
            ->groupBy('generos.id');

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

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'denom' => 'Denominación',
            'total' => 'Total',
            'created_at' => 'Fecha de creación',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLibros()
    {
        return $this->hasMany(Libros::className(), ['genero_id' => 'id'])->inverseOf('genero');
    }
}
