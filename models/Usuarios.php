<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "usuarios".
 *
 * @property int $id
 * @property string $nombre
 * @property string $password
 * @property string|null $auth_key
 * @property string|null $telefono
 * @property string|null $poblacion
 * @property int|null $lector_id
 *
 * @property Lectores $lector
 */
class Usuarios extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'usuarios';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'password'], 'required'],
            [['lector_id'], 'default', 'value' => null],
            [['lector_id'], 'integer'],
            [['nombre', 'auth_key', 'telefono', 'poblacion'], 'string', 'max' => 255],
            [['password'], 'string', 'max' => 60],
            [['nombre'], 'unique'],
            [['lector_id'], 'exist', 'skipOnError' => true, 'targetClass' => Lectores::className(), 'targetAttribute' => ['lector_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
            'password' => 'Password',
            'auth_key' => 'Auth Key',
            'telefono' => 'Telefono',
            'poblacion' => 'Poblacion',
            'lector_id' => 'Lector ID',
        ];
    }

    /**
     * Gets query for [[Lector]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLector()
    {
        return $this->hasOne(Lectores::className(), ['id' => 'lector_id'])->inverseOf('usuarios');
    }
}
