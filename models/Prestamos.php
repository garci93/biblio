<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "prestamos".
 *
 * @property int $id
 * @property int $libro_id
 * @property int $lector_id
 * @property string $created_at
 * @property string|null $devolucion
 *
 * @property Lectores $lector
 * @property Libros $libro
 */
class Prestamos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'prestamos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['libro_id', 'lector_id'], 'required'],
            [['libro_id', 'lector_id'], 'default', 'value' => null],
            [['libro_id', 'lector_id'], 'integer'],
            [['created_at', 'devolucion'], 'safe'],
            [['libro_id', 'lector_id', 'created_at'], 'unique', 'targetAttribute' => ['libro_id', 'lector_id', 'created_at']],
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
            'libro_id' => 'Libro ID',
            'lector_id' => 'Lector ID',
            'created_at' => 'Created At',
            'devolucion' => 'Devolucion',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLector()
    {
        return $this->hasOne(Lectores::className(), ['id' => 'lector_id'])->inverseOf('prestamos');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLibro()
    {
        return $this->hasOne(Libros::className(), ['id' => 'libro_id'])->inverseOf('prestamos');
    }
}
