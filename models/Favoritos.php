<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "favoritos".
 *
 * @property int $id
 * @property int|null $lector_id
 * @property int|null $libro_id
 *
 * @property Lectores $lector
 * @property Libros $libro
 */
class Favoritos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'favoritos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['lector_id', 'libro_id'], 'default', 'value' => null],
            [['lector_id', 'libro_id'], 'integer'],
            [['lector_id'], 'exist', 'skipOnError' => true, 'targetClass' => Lectores::className(), 'targetAttribute' => ['lector_id' => 'id']],
            [['libro_id'], 'exist', 'skipOnError' => true, 'targetClass' => Libros::className(), 'targetAttribute' => ['libro_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'lector_id' => 'Lector ID',
            'libro_id' => 'Libro ID',
        ];
    }

    /**
     * Gets query for [[Lector]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLector()
    {
        return $this->hasOne(Lectores::className(), ['id' => 'lector_id'])->inverseOf('favoritos');
    }

    /**
     * Gets query for [[Libro]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLibro()
    {
        return $this->hasOne(Libros::className(), ['id' => 'libro_id'])->inverseOf('favoritos');
    }
}
