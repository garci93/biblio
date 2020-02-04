<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "libros".
 *
 * @property int $id
 * @property string $isbn
 * @property string $titulo
 * @property int|null $num_pags
 * @property int $genero_id
 * @property string $created_at
 *
 * @property Generos $genero
 */
class Libros extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'libros';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['isbn', 'titulo', 'genero_id'], 'required'],
            [['num_pags', 'genero_id'], 'default', 'value' => null],
            [['num_pags', 'genero_id'], 'integer'],
            [['created_at'], 'safe'],
            [['isbn'], 'string', 'max' => 13],
            [['titulo'], 'string', 'max' => 255],
            [['isbn'], 'unique'],
            [['genero_id'], 'exist', 'skipOnError' => true, 'targetClass' => Generos::className(), 'targetAttribute' => ['genero_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'isbn' => 'Isbn',
            'titulo' => 'Título',
            'num_pags' => 'Núm. Pags.',
            'genero_id' => 'Género ID',
            'created_at' => 'Fecha de alta',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGenero()
    {
        return $this->hasOne(Generos::className(), ['id' => 'genero_id'])->inverseOf('libros');
    }
}
