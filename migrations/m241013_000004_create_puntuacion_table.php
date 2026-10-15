<?php

use yii\db\Migration;

class m241013_000004_create_puntuacion_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('puntuacion', [
            'id' => $this->primaryKey(),
            'jugador_id' => $this->integer()->notNull(),
            'jornada' => $this->integer()->notNull(),
            'tipo_tiro_id' => $this->integer()->notNull(),
            'puntos' => $this->integer()->notNull(),
            'fecha_registro' => $this->dateTime()->defaultValue(new \yii\db\Expression('CURRENT_TIMESTAMP')),
        ]);

        $this->addForeignKey(
            'fk_puntuacion_jugador',
            'puntuacion',
            'jugador_id',
            'jugador',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk_puntuacion_tipo_tiro',
            'puntuacion',
            'tipo_tiro_id',
            'tipo_tiro',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk_puntuacion_tipo_tiro', 'puntuacion');
        $this->dropForeignKey('fk_puntuacion_jugador', 'puntuacion');
        $this->dropTable('puntuacion');
    }
}