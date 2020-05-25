<?php

use yii\db\Migration;

/**
 * Class m200525_201742_create_favoritos
 */
class m200525_201742_create_favoritos extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('favoritos', [
            'id' => $this->bigPrimaryKey(),
            'lector_id' => $this->bigInteger(),
            'libro_id' => $this->bigInteger(),
        ]);

        $this->addForeignKey(
            'fk_favoritos_lectores',
            'favoritos',
            'lector_id',
            'lectores',
            'id',
        );

        $this->addForeignKey(
            'fk_favoritos_libros',
            'favoritos',
            'libro_id',
            'libros',
            'id',
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_favoritos_libros', 'favoritos');
        $this->dropForeignKey('fk_favoritos_lectores', 'favoritos');
        $this->dropTable('favoritos');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200525_201742_create_favoritos cannot be reverted.\n";

        return false;
    }
    */
}
