<?php

use yii\db\Migration;

class m241013_000001_create_equipo_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('equipo', [
            'id' => $this->primaryKey(),
            'nombre' => $this->string(100)->notNull(),
            'logo' => $this->string(255)->notNull(),
            'created_at' => $this->dateTime()->defaultValue(new \yii\db\Expression('CURRENT_TIMESTAMP')),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('equipo');
    }
}