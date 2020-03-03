<?php

use yii\db\Migration;

/**
 * Class m200302_162411_create_ej2.
 */
class m200302_162411_create_ej2 extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('codpostales', [
          'id' => $this->decimal(5),
          'poblacion_id' => $this->bigInteger(),
        ]);

        $this->createTable('provincias', [
          'id' => $this->bigPrimaryKey(),
          'nombre' => $this->string()->notNull(),
        ]);

        $this->createTable('poblaciones', [
          // 'id' => $this->bigInteger(),
          'id' => $this->bigPrimaryKey(),
          'nombre' => $this->string(),
          'provincia_id' => $this->bigInteger(),
        ]);

        $this->addPrimaryKey(
            'pk_codpostales',
            'codpostales',
            'id'
        );

        // $this->addPrimaryKey('pk_poblaciones_id', 'poblaciones', 'id');
        $this->addForeignKey(
            'fk_codpostales_poblaciones',
            'codpostales',
            'poblacion_id',
            'poblaciones',
            'id'
        );

        $this->addForeignKey(
            'fk_poblaciones_provincias',
            'poblaciones',
            'provincia_id',
            'provincias',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_poblaciones_provincias', 'poblaciones');

        $this->dropTable('provincias');

        $this->dropForeignKey('fk_codpostales_poblaciones', 'codpostales');

        $this->dropTable('poblaciones');

        $this->dropTable('codpostales');

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200302_162411_create_ej2 cannot be reverted.\n";

        return false;
    }
    */
}
