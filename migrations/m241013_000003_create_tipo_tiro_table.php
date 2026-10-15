<?php

use yii\db\Migration;

class m241013_000003_create_tipo_tiro_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('tipo_tiro', [
            'id' => $this->primaryKey(),
            'nombre' => $this->string(50)->notNull(),
            'valor' => $this->integer()->notNull(),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('tipo_tiro');
    }
}