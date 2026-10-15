<?php

use yii\db\Migration;

class m241013_000002_create_jugador_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('jugador', [
            'id' => $this->primaryKey(),
            'equipo_id' => $this->integer()->notNull(),
            'nombres' => $this->string(100)->notNull(),
            'apellidos' => $this->string(100)->notNull(),
            'fecha_nacimiento' => $this->date()->notNull(),
            'fotografia' => $this->string(255)->notNull(),
            'created_at' => $this->dateTime()->defaultValue(new \yii\db\Expression('CURRENT_TIMESTAMP')),
        ]);

        $this->addForeignKey(
            'fk_jugador_equipo',
            'jugador',
            'equipo_id',
            'equipo',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk_jugador_equipo', 'jugador');
        $this->dropTable('jugador');
    }
}