<?php

use yii\db\Migration;
use yii\db\pgsql\Schema;

/**
 * Class m200516_164844_create_lector_id
 */
class m200516_164844_create_lector_id extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%usuarios}}', 'lector_id', Schema::TYPE_BIGINT);
        $this->addForeignKey(
            'fk_usuarios_lectores',
            '{{%usuarios}}',
            'lector_id',
            'lectores',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_usuarios_lectores', '{{%usuarios}}');
        $this->dropColumn('{{%usuarios}}', 'lector_id');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200516_164844_create_lector_id cannot be reverted.\n";

        return false;
    }
    */
}
