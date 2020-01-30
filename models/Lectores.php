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
 * @property string|null $poblacion
 * @property string|null $provincia
 * @property float|null $cod_postal
 * @property string|null $fecha_nac
 * @property string $created_at
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
            [['numero', 'nombre'], 'required'],
            [['cod_postal'], 'number'],
            [['fecha_nac', 'created_at'], 'safe'],
            [['numero'], 'string', 'max' => 9],
            [['nombre', 'direccion', 'poblacion', 'provincia'], 'string', 'max' => 255],
            [['numero'], 'unique'],
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
            'cod_postal' => 'Cod Postal',
            'fecha_nac' => 'Fecha Nac',
            'created_at' => 'Created At',
        ];
    }
}
