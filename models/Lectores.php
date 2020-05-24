<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "lectores".
 *
 * @property int $id
 * @property string $numero
 * @property string $nombre
 * @property string|null $direccion
 * @property string $poblacion
 * @property string $provincia
 * @property float|null $codpostal_id
 * @property string|null $fecha_nac
 * @property string $created_at
 *
 * @property Codpostales $codpostal
 * @property Prestamos[] $prestamos
 * @property Usuarios[] $usuarios
 */
class Lectores extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'lectores';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['numero', 'nombre', 'poblacion', 'provincia'], 'required'],
            [['codpostal_id'], 'number'],
            [['fecha_nac', 'created_at'], 'safe'],
            [['numero'], 'string', 'max' => 9],
            [['nombre', 'direccion', 'poblacion', 'provincia'], 'string', 'max' => 255],
            [['numero'], 'unique'],
            [['codpostal_id'], 'exist', 'skipOnError' => true, 'targetClass' => Codpostales::className(), 'targetAttribute' => ['codpostal_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'numero' => 'Numero',
            'nombre' => 'Nombre',
            'direccion' => 'Direccion',
            'poblacion' => 'Poblacion',
            'provincia' => 'Provincia',
            'codpostal_id' => 'Codpostal ID',
            'fecha_nac' => 'Fecha Nac',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Gets query for [[Codpostal]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCodpostal()
    {
        return $this->hasOne(Codpostales::className(), ['id' => 'codpostal_id'])->inverseOf('lectores');
    }

    /**
     * Gets query for [[Prestamos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPrestamos()
    {
        return $this->hasMany(Prestamos::className(), ['lector_id' => 'id'])->inverseOf('lector');
    }

    /**
     * Gets query for [[Usuarios]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarios()
    {
        return $this->hasMany(Usuarios::className(), ['lector_id' => 'id'])->inverseOf('lector');
    }
}
