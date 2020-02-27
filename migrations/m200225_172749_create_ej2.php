<?php

use yii\db\Migration;

/**
 * Class m200225_172749_create_ej2
 */
class m200225_172749_create_ej2 extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('codpostales', [
            'id' => $this->primaryKey(),
            'codpostal' => $this->integer(5)->notNull(),
            'poblacion_id' => $this->bigInteger()->notNull(),
        ]);

        $this->createTable('poblaciones', [
            'id' => $this->primaryKey(),
            'nombre' => $this->string()->notNull(),
            'provincia_id' => $this->bigInteger()->notNull(),
        ]);

        $this->createTable('provincias', [
            'id' => $this->primaryKey(),
            'nombre' => $this->string()->notNull(),
        ]);

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

        $this->renameColumn('lectores', 'cod_postal', 'codpostal_id');

        $this->alterColumn('lectores', 'codpostal_id', 'integer');

        $this->addForeignKey(
            'fk_lectores_codpostales',
            'lectores',
            'codpostal_id',
            'codpostales',
            'id'
        );

        $this->createIndex(
            'idx_codpostales_poblacion_id',
            'codpostales',
            [
                'poblacion_id',
            ], true,
        );

        $this->createIndex(
            'idx_poblaciones_provincia_id',
            'poblaciones',
            [
                'provincia_id',
            ], true,
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex(
            'idx_poblaciones_provincia_id',
            'poblaciones'
        );
        $this->dropIndex(
            'idx_codpostales_poblacion_id',
            'codpostales'
        );
        $this->dropForeignKey('fk_lectores_codpostales', 'lectores');
        $this->alterColumn('lectores', 'codpostal_id', 'numeric(5)');
        $this->renameColumn('lectores', 'codpostal_id', 'cod_postal');
        $this->dropForeignKey('fk_poblaciones_provincias', 'poblaciones');
        $this->dropForeignKey('fk_codpostales_poblaciones', 'codpostales');
        $this->dropTable('provincias');
        $this->dropTable('poblaciones');
        $this->dropTable('codpostales');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200225_172749_create_ej2 cannot be reverted.\n";

        return false;
    }
    */
}
